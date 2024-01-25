<?php

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\SaleDetail;

require __DIR__ . '/../vendor/autoload.php';
require '../src/Config.php';

require '../../models/Venta.php';
require '../../models/VentaServicio.php';
require '../../models/Entidad.php';
require '../../models/Empresa.php';
require '../../tools/NumerosaLetras.php';

require '../functions/Comprobante_Sunat.php';

$NumeroLetras = new NumerosaLetras();

$ventaid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$Venta = new Venta();
$Venta->setId($ventaid);
$Venta->obtenerDatos();

$SunatVenta = new VentaSunat();
$SunatVenta->setVentaid($Venta->getId());
$SunatVenta->setFecha(date("Y-m-d"));

$Empresa = new Empresa();
$Empresa->setId($Venta->getEmpresaid());
$Empresa->obtenerDatos();

$VentaServicio = new VentaServicio();
$VentaServicio->setVentaid($Venta->getId());

$Cliente = new Entidad();
$Cliente->setId($Venta->getEntidadid());
$Cliente->obtenerDatos();

// Cliente
$client = (new Client())
    ->setTipoDoc('6')
    ->setNumDoc($Cliente->getNrodocumento())
    ->setRznSocial($Cliente->getRazonsocial());

// Emisor
$address = (new Address())
    ->setUbigueo($Empresa->getUbigeo())
    ->setDepartamento($Empresa->getDepartamento())
    ->setProvincia($Empresa->getProvincia())
    ->setDistrito($Empresa->getDistrito())
    ->setUrbanizacion('-')
    ->setDireccion($Empresa->getDirfiscal())
    ->setCodLocal($Empresa->getCodsunat()); // Codigo de establecimiento asignado por SUNAT, 0000 por defecto.

$company = (new Company())
    ->setRuc($Empresa->getRuc())
    ->setRazonSocial($Empresa->getRazonsocial())
    ->setNombreComercial($Empresa->getRazonsocial())
    ->setAddress($address);

//lista de productos
$arrayServicios = $VentaServicio->verFilas();
$arrayItems = array();
$totalBaseIGV = 0;
$totalBase = 0;
$totalGeneral = 0;
foreach ($arrayServicios as $item) {
    $itemProducto = (new SaleDetail());

    $itemProducto
        ->setCodProducto($item['id'])
        ->setUnidad($item['unidad']) // Unidad - Catalog. 03
        ->setCantidad(1)
        ->setDescripcion(htmlentities($item['descripcion']));

    $itemSinIGV = $item['precio_venta'] / 1.18;
    $itemProducto
        ->setPorcentajeIgv(18.00) // 18%
        ->setIgv(number_format($itemSinIGV * 0.18, 2))
        ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
        ->setTotalImpuestos(number_format($itemSinIGV * 0.18, 2)) // Suma de impuestos en el detalle
        ->setMtoPrecioUnitario(number_format($itemSinIGV * 1.18, 2));

    $itemProducto
        ->setMtoValorUnitario($itemSinIGV)
        ->setMtoBaseIgv($itemSinIGV)
        ->setMtoValorVenta($itemSinIGV);

    $totalBaseIGV = $totalBaseIGV + $itemSinIGV;

    array_push($arrayItems, $itemProducto);
}

$totalGeneral = ($totalBaseIGV * 1.18) + $totalBase;

// Venta
$invoice = (new Invoice())
    ->setUblVersion('2.1')
    ->setTipoOperacion('0101') // Venta - Catalog. 51
    ->setTipoDoc('03') // Factura - Catalog. 01
    ->setSerie($Venta->getSerie())
    ->setCorrelativo($Venta->getNumero())
    ->setFechaEmision(\DateTime::createFromFormat('Y-m-d', $Venta->getFecha())) // Zona horaria: Lima
    ->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
    ->setTipoMoneda('PEN') // Sol - Catalog. 02
    ->setCompany($company)
    ->setClient($client)
    ->setMtoOperGravadas($totalBaseIGV)
    ->setMtoOperExoneradas($totalBase)
    ->setMtoIGV(number_format($totalBaseIGV * 0.18, 2))
    ->setTotalImpuestos(number_format($totalBaseIGV * 0.18, 2))
    ->setValorVenta($totalBaseIGV + $totalBase)
    ->setSubTotal($totalGeneral)
    ->setMtoImpVenta($totalGeneral);

$legend = (new Legend())
    ->setCode('1000') // Monto en letras - Catalog. 52
    ->setValue($NumeroLetras->to_word($totalGeneral, "PEN"));

$invoice->setDetails($arrayItems)
    ->setLegends([$legend]);

$igv = number_format($totalBaseIGV * 0.18, 2);
$totalGeneral = number_format($totalGeneral, 2);

$nombre_archivo = $invoice->getName();
$tipoDoc = 1;

//boletas no se envian xml a sunat
$ComprobanteSunatCPE = new Comprobante_Sunat();
$ComprobanteSunatCPE->setConfig($Empresa);
$json_response = $ComprobanteSunatCPE->envioSunat(false, $invoice, $Venta->getId());

echo $json_response;