<?php
require '../../models/Venta.php';
require '../../models/VentaServicio.php';
require '../../models/Entidad.php';
require '../../models/ComprobanteSunat.php';
require '../../models/VentaSunat.php';
require '../../models/DocumentoEnvio.php';
require '../../models/VentaAnulada.php';

$Venta = new Venta();
$accion = filter_input(INPUT_GET, 'accion');

if ($accion == 'listar') {
    $fecha = filter_input(INPUT_POST, 'fecha');
    $fecha = date('Y-m-d');
    $Venta->setSerie("LS3");
    $lista_ventas = $Venta->verVentasxSerieEntreFechas($fecha, $fecha);
    echo $lista_ventas;
}

if ($accion == 'registrar') {
    $Entidad = new Entidad();
    $Entidad->setNrodocumento(filter_input(INPUT_POST, 'cliente_documento'));
    if ($Entidad->getNrodocumento() == 0) {
        $Entidad->setNrodocumento('0');
        $Entidad->setRazonsocial("CLIENTE NO IDENTIFICADO");
    }

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
        $VentaServicio->setDescripcion($item->item_descripcion);
        $VentaServicio->setPrecio($item->item_precio);
        $VentaServicio->setUnidadid(12);
        $VentaServicio->obtenerId();
        $VentaServicio->insertar();
    }

    $DocumentoEnvioCurl = new DocumentoEnvio();
    echo $DocumentoEnvioCurl->enviarSunat($Venta->getComprobanteid(), $Venta->getId(), '');
}

if ($accion == 'detalle') {
    $Venta->setId(filter_input(INPUT_POST, 'id'));
    $json_venta = $Venta->getJsonDataVenta();

    $VentaServicio = new VentaServicio();
    $VentaServicio->setVentaid($Venta->getId());
    $lista_servicios = $VentaServicio->verFilas(1);

    $VentaSunat = new VentaSunat();
    $VentaSunat->setVentaid($Venta->getId());
    $VentaSunat->obtenerDatos();

    $array_detalle = json_decode($json_venta, true);
    $array_detalle["items"] = json_decode($lista_servicios);
    $array_detalle["qr_name"] = $VentaSunat->getNombre();
    $array_detalle["qr_hash"] = $VentaSunat->getHash();

    echo json_encode($array_detalle);
}

if ($accion == 'anular') {
    $Venta->setId(filter_input(INPUT_POST, 'id'));

    $VentaAnulada = new VentaAnulada();
    $VentaAnulada->setVentaId($Venta->getId());
    $VentaAnulada->setFechaAnulacion(date('Y-m-d'));
    $VentaAnulada->setMotivo("-");
    $VentaAnulada->insertar();

    //update estado venta
    $Venta->setEstado(2);
    $Venta->updateEstado();
}