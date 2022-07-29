<?php
require '../../models/Contrato.php';
require '../../models/ContratoPago.php';
require '../../models/ClientePago.php';

$Contrato = new Contrato();
$Pago = new ContratoPago();

$Contrato->setId(filter_input(INPUT_GET, 'contratoid'));

$Pago->setContratoid($Contrato->getId());
$Pago->eliminar();

$Contrato->eliminar();

header("Location: ../contents/lista-contratos.php");