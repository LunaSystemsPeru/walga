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

$Contrato->setMontopagado(filter_input(INPUT_POST, 'input-pago-final'));
$Contrato->setHoratermino(filter_input(INPUT_POST, 'input-hora'));
$Contrato->setEstado(2);

$Contrato->modificar();

if ($Contrato->getMontopagado()>0) {
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

header("Location: ../contents/contratos.php");