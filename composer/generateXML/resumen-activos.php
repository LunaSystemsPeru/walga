<?php
declare(strict_types=1);

use Greenter\Model\Response\SummaryResult;
use Greenter\Model\Sale\Document;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;
use Greenter\Model\Summary\SummaryPerception;
use Greenter\Ws\Services\SunatEndpoints;

require __DIR__ . '/../vendor/autoload.php';

require '../../models/Venta.php';
require '../../models/ResumenDiario.php';

require '../../tools/Util.php';

require '../functions/SunatCPE.php';

$Util = new Util();

$Resumen = new ResumenDiario();

$Venta = new Venta();
$Venta->setFecha(filter_input(INPUT_GET, 'fecha'));
$Venta->setEmpresaid(filter_input(INPUT_GET, 'empresa_id'));

$ComprobanteSUNAT = new _SunatCPE($Venta);

$arrayBoletas = $Venta->verBoletasActivas();

$arrayDetalle = array();
$nroitems = 0;
// Summary
foreach ($arrayBoletas as $fila) {
    $nroitems++;
    $doccliente = $fila['documento'];
    $tipocliente = "1";
    if (strlen($doccliente) == "8") {
        if (strpos($doccliente, "SD") == 0) {
            $doccliente = '00000000';
            $tipocliente = "0";
        } else {
            $tipocliente = "1";
        }
    } else if (strlen($doccliente) == 11) {
        $tipocliente = "6";
    } else {
        $tipocliente = "0";
        $doccliente = '00000000';
    }
    $total = $fila['total'];
    $igv = $fila['igv'];
    $base = $igv / 0.18;
    $exonerado = $total - $base - $igv;
    $detalle = new SummaryDetail();
    $detalle->setTipoDoc($Util->zerofill($fila['cod_sunat'], 2))
        ->setSerieNro($fila['serie'] . "-" . $fila['numero'])
        ->setEstado('1')
        ->setClienteTipo($tipocliente)
        ->setClienteNro($doccliente)
        ->setTotal(floatval($total))
        ->setMtoOperGravadas($base)
        ->setMtoOperInafectas(0)
        ->setMtoOperExoneradas($exonerado)
        ->setMtoOperExportacion(0)
        ->setMtoOtrosCargos(0)
        ->setMtoIGV(floatval($igv));

    if ($fila['id_tido'] == 6) {
        $Nota = new VentaNota();
        $Nota->setNotaid($fila['id_ventas']);
        $Nota->obtenerDatos();
        $VReferencia = new Venta();
        $VReferencia->setIdventa($Nota->getReferenciaid());
        $VReferencia->obtenerDatos();

        $detalle->setDocReferencia((new Document())
            ->setTipoDoc('03')
            ->setNroDoc($VReferencia->getSerie() . "-" . $VReferencia->getNumero()));
    }

    array_push($arrayDetalle, $detalle);
}

if ($nroitems > 0) {

    $sum = new Summary();
// Fecha Generacion menor que Fecha Resumen
    $sum->setFecGeneracion(\DateTime::createFromFormat('Y-m-d', $fecha))
        ->setFecResumen(\DateTime::createFromFormat('Y-m-d', $fecha))
        ->setCorrelativo('001')
        ->setCompany($company)
        ->setDetails($arrayDetalle);

    // Envio a SUNAT.
    $res = $see->send($sum);
// Guardar XML firmado digitalmente.
    file_put_contents("../../public/xml/" . $sum->getName() . '.xml',
        $see->getFactory()->getLastXml());
    $Resumen->setEstado(1);

    if (!$res->isSuccess()) {
        $Resumen->setEstado(0);
        echo "<br> error al enviar ";
        print_r($res->getError());
        //  return;
    }

    /**@var $res SummaryResult */
    $ticket = $res->getTicket();
    echo '<br>Ticket :<strong>' . $ticket . '</strong><br>';

    $Resumen->setIdempresa($Empresa->getIdempresa());
    $Resumen->setNombre($sum->getName());
    $Resumen->setFechaenvio(date("Y-m-d"));
    $Resumen->setTikect($ticket);
    $Resumen->setTipo(1); //activos
    $Resumen->setCantidad($nroitems);
    $Resumen->obtenerId();

    $Resumen->insertar();
    if ($Resumen->getEstado() == 0) {
        return;
    }

    $res = $see->getStatus($ticket);
    if (!$res->isSuccess()) {
        echo "<br> error al obtener estado de ticket ";
        print_r($res->getError());
        $Resumen->setEstado(0);
        return;
    }

    $cdr = $res->getCdrResponse();
    //$util->writeCdr($sum, $res->getCdrZip());
    // Guardamos el CDR
    file_put_contents("../../public/cdr/" . 'R-' . $sum->getName() . '.zip', $res->getCdrZip());
    //$util->showResponse($sum, $cdr);
}