<?php
include '../fixed/cargarSesion.php';
require '../../models/Contrato.php';
require '../../models/ClientePago.php';
require '../../models/ContratoPago.php';

$Contrato = new Contrato();
$PagoCliente = new ClientePago();
$ContratoPago = new ContratoPago();


$Contrato->setId(filter_input(INPUT_POST, 'input-id-contrato'));
$Contrato->obtenerDatos();

$Contrato->setHoratermino(filter_input(INPUT_POST, 'input-hora'));
$montobase = filter_input(INPUT_POST, 'input-monto');
$pagoefectivo = filter_input(INPUT_POST, 'input-pago-final');
$masigv = filter_input(INPUT_POST, 'input-masigv');
$quierefactura = filter_input(INPUT_POST, 'input-quierefactura');
$montofinal = 0;

if ($quierefactura == 1) {
    $Contrato->setComprobanteid(4);
    if ($masigv == 1) {
        $Contrato->setIncluyeigv(1);
        $montofinal = $montobase * 1.18;
    } else {
        $Contrato->setIncluyeigv(0);
        $montofinal = $montobase;
    }
}

$Contrato->setMontocontrato($montofinal);
$Contrato->setMontopagado($pagoefectivo);
$Contrato->setEstado(2);

$Contrato->modificar();

if ($Contrato->getMontopagado() > 0) {
    $PagoCliente->setMonto($Contrato->getMontopagado());
    $PagoCliente->setClienteid($Contrato->getClienteid());
    $PagoCliente->setUsuarioid($_SESSION['usuario_id']);
    $PagoCliente->setFechapago(date("Y-m-d"));
    $PagoCliente->obtenerId();
    $PagoCliente->insertar();

    $ContratoPago->setMonto($Contrato->getMontopagado());
    $ContratoPago->setFecha(date("Y-m-d"));
    $ContratoPago->setClientepagoid($PagoCliente->getId());
    $ContratoPago->setContratoid($Contrato->getId());
    $ContratoPago->obtenerId();
    $ContratoPago->insertar();
}

if ($quierefactura == 1) {
    header("Location: ../contents/factura-contrato.php?contrato=" . $Contrato->getId());
} else {
    header("Location: ../contents/contratos.php");
}
