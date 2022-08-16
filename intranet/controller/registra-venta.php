<?php
include '../fixed/cargarSession.php';

require '../../models/Venta.php';
require '../../models/ComprobanteSunat.php';
require '../../models/VentaContrato.php';
require '../../models/VentaServicio.php';
require '../../models/VentaCuota.php';

$Comprobante = new ComprobanteSunat();
$Venta = new Venta();
$VentaContrato = new VentaContrato();
$VentaServicio = new VentaServicio();
$VentaCuota = new VentaCuota();

$Comprobante->setComprobanteid(filter_input(INPUT_POST, 'inputTido'));
$Comprobante->setEmpresaid($_SESSION['empresa_id']);
$Comprobante->obtenerDatosVenta();

$Venta->setComprobanteid($Comprobante->getComprobanteid());
$Venta->setEmpresaid($Comprobante->getEmpresaid());
$Venta->setSerie($Comprobante->getSerie());
$Venta->setNumero($Comprobante->getNumero());
$Venta->setFecha(filter_input(INPUT_POST, 'inputFecha'));
$Venta->setUsuarioid($_SESSION['usuario_id']);
$Venta->setIgv(0);
$Venta->setTotal(filter_input(INPUT_POST, 'inputMonto'));
$Venta->setEntidadid(filter_input(INPUT_POST, 'inputClienteId'));
$Venta->setDetraccionid(filter_input(INPUT_POST, 'inputDetraccion'));

$Venta->obtenerId();
$venta_registrada = $Venta->insertar();

if (!$venta_registrada) {
    echo json_encode(["id" => 0, "respuesta" => false]);
    exit();
}

$VentaContrato->setContratoid(filter_input(INPUT_POST, 'inputContrato'));
$VentaContrato->setVentaid($Venta->getId());

if ($VentaContrato->getContratoid() ) {
    $VentaContrato->insertar();
}

$VentaServicio->setVentaid($Venta->getId());
$array_servicios = json_decode(filter_input(INPUT_POST, 'arrayServicios'),false);

foreach ($array_servicios as $fila) {
    $VentaServicio->setDescripcion($fila->descripcion);
    $VentaServicio->setUnidadid($fila->unidadid);
    $VentaServicio->setPrecio($fila->precio);
    $VentaServicio->obtenerId();
    $VentaServicio->insertar();
}

$VentaCuota->setVentaid($Venta->getId());

$array_cuotas = json_decode(filter_input(INPUT_POST, 'arrayCuotas'),false);
if ($array_cuotas) {
    foreach ($array_cuotas as $fila) {
        $VentaCuota->setFechaVencimiento($fila->fecha);
        $VentaCuota->setMonto($fila->cuota);
        $VentaCuota->obtenerId();
        $VentaCuota->insertar();
    }
}

$url = $_SERVER['REQUEST_SCHEME']  . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$rutabase = dirname(dirname(dirname($url))) . DIRECTORY_SEPARATOR;
$respuestaCurl = "";
if ($Venta->getComprobanteid() == 3 || $Venta->getComprobanteid() == 4) {
    $nombreXML = "factura";
    if ($Venta->getComprobanteid() == 3) {
        $nombreXML = "boleta";
    }
    //echo $rutabase . "composer/generateXML/" . $nombreXML . ".php?id=" . $Venta->getId();
    $ch = curl_init($rutabase . "composer/generateXML/" . $nombreXML . ".php?id=" . $Venta->getId());
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    $errorcurl = "";

    if ($result === false) {
        $erroremail = 'Curl error: ' . curl_error($ch);
        echo json_encode(["id" => $Venta->getId(), "respuesta" =>$erroremail]);
    } else {
        $respuestaCurl = $result;
        echo json_encode(["id" => $Venta->getId(), "respuesta" =>$respuestaCurl]);
    }
    curl_close($ch);


}

