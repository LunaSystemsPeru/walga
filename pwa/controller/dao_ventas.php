<?php
require '../../models/Venta.php';
require '../../models/VentaServicio.php';
require '../../models/Entidad.php';
require '../../models/ComprobanteSunat.php';

$Venta = new Venta();
$accion = filter_input(INPUT_GET, 'accion');

if ($accion == 'listar') {
    $fecha = filter_input(INPUT_POST, 'fecha');
    $Venta->setSerie("C03");
    $lista_ventas = $Venta->verVentasxSerieEntreFechas($fecha, $fecha);
    echo $lista_ventas;
}

if ($accion == 'registrar') {
    $Entidad = new Entidad();
    $Entidad->setNrodocumento(filter_input(INPUT_POST, 'cliente_documento'));
    $Entidad->validarDocumento();

    if ($Entidad->getId() == 0) {
        $Entidad->setRazonsocial(filter_input(INPUT_POST, 'cliente_datos'));
        $Entidad->obtenerId();
        $Entidad->insertar();
    }

    $Comprobante = new ComprobanteSunat();
    $Comprobante->setEmpresaid(filter_input(INPUT_POST, 'venta_empresa'));
    $Comprobante->setSerie(filter_input(INPUT_POST, 'comprobante_serie'));
    $Comprobante->setComprobanteid(filter_input(INPUT_POST, 'comprobante_id'));
    $Comprobante->obtenerNro();

    $Venta->setEntidadid($Entidad->getId());
    $Venta->setFecha(filter_input(INPUT_POST, 'venta_fecha'));
    if ($Venta->getFecha() == '') {
        $Venta->setFecha(date('Y-m-d'));
    }
    $Venta->setComprobanteid($Comprobante->getComprobanteid());
    $Venta->setSerie($Comprobante->getSerie());
    $Venta->setNumero($Comprobante->getNumero());
    $Venta->setEmpresaid($Comprobante->getEmpresaid());
    $Venta->setUsuarioid(filter_input(INPUT_POST, 'venta_usuario'));
    $Venta->setTotal(filter_input(INPUT_POST, 'venta_total'));
    $Venta->setIgv($Venta->getTotal() / 1.18 * 0.18);
    $Venta->setDetraccionid(15);
    $Venta->obtenerId();
    $Venta->insertar();

    $VentaServicio = new VentaServicio();
    $VentaServicio->setVentaid($Venta->getId());
    $lista_servicios = json_decode(filter_input(INPUT_POST, 'venta_items'));
    foreach ($lista_servicios as $item) {
        $VentaServicio->setDescripcion($item['item_descripcion']);
        $VentaServicio->setPrecio($item['item_precio']);
        $VentaServicio->setUnidadid(12);
        $VentaServicio->obtenerId();
        $VentaServicio->insertar();
    }
}