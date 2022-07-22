<?php
include '../fixed/cargarSession.php';

require '../../models/Venta.php';
require '../../models/ComprobanteSunat.php';
require '../../models/VentaContrato.php';
require '../../models/VentaServicio.php';

$Comprobante = new ComprobanteSunat();
$Venta = new Venta();
$VentaContrato = new VentaContrato();
$VentaServicio = new VentaServicio();

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
$Venta->insertar();

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


