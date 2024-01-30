<?php

use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;

require __DIR__ . '/../vendor/autoload.php';

require_once '../../models/Venta.php';
require '../../models/VentaServicio.php';

require '../functions/SunatCPE.php';

$ventaid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$Venta = new Venta();
$Venta->setId($ventaid);
$Venta->obtenerDatos();

$ComprobanteSunatCPE = new _SunatCPE($Venta);

$VentaServicio = new VentaServicio();
$VentaServicio->setVentaid($Venta->getId());

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
    ->setTipoDoc('01') // Factura - Catalog. 01
    ->setSerie($Venta->getSerie())
    ->setCorrelativo($Venta->getNumero())
    ->setFechaEmision(\DateTime::createFromFormat('Y-m-d', $Venta->getFecha())) // Zona horaria: Lima
    ->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
    ->setTipoMoneda('PEN') // Sol - Catalog. 02
    ->setCompany($ComprobanteSunatCPE->getCompany())
    ->setClient($ComprobanteSunatCPE->getClient())
    ->setMtoOperGravadas($totalBaseIGV)
    ->setMtoOperExoneradas($totalBase)
    ->setMtoIGV(number_format($totalBaseIGV * 0.18, 2))
    ->setTotalImpuestos(number_format($totalBaseIGV * 0.18, 2))
    ->setValorVenta($totalBaseIGV + $totalBase)
    ->setSubTotal($totalGeneral)
    ->setMtoImpVenta($totalGeneral);

$invoice->setDetails($arrayItems)
    ->setLegends([$ComprobanteSunatCPE->getLegend($totalGeneral)]);

$json_response = $ComprobanteSunatCPE->envioSunat(true, $invoice);

echo $json_response;