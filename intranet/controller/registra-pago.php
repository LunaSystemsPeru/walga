<?php
require_once '../fixed/cargarSession.php';
require '../../models/Contrato.php';
require '../../models/ContratoPago.php';
require '../../models/ClientePago.php';

$Contrato = new Contrato();
$ContratoPago = new ContratoPago();
$ClientePago = new ClientePago();

$Contrato->setId(filter_input(INPUT_POST, 'hidden-contrato-id'));
$Contrato->obtenerDatos();

$ClientePago->setClienteid($Contrato->getClienteid());
$ClientePago->setMonto(filter_input(INPUT_POST, 'input-monto'));
$ClientePago->setFechapago(filter_input(INPUT_POST, 'input-fecha'));
$ClientePago->setUsuarioid($_SESSION['usuario_id']);
$ClientePago->setTipopagoid(filter_input(INPUT_POST, 'input-tipo-pago'));
$ClientePago->obtenerId();
$ClientePago->insertar();

$ContratoPago->setTipopagoid($ClientePago->getTipopagoid());
$ContratoPago->setMonto($ClientePago->getMonto());
$ContratoPago->setFecha($ClientePago->getFechapago());
$ContratoPago->setClientepagoid($ClientePago->getId());
$ContratoPago->setContratoid($Contrato->getId());
$ContratoPago->obtenerId();
$ContratoPago->insertar();

header("Location: ../contents/detalle-contrato.php?id=" . $Contrato->getId());