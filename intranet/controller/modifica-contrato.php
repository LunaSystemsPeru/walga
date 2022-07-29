<?php
require '../../models/Contrato.php';

$Contrato = new Contrato();
$Contrato->setId(filter_input(INPUT_POST, 'hidden_id'));
$Contrato->obtenerDatos();

$Contrato->setServicio(filter_input(INPUT_POST, 'input_servicio'));
$Contrato->setMontocontrato(filter_input(INPUT_POST, 'input_monto'));
$Contrato->modificar();

header("Location: ../contents/detalle-contrato.php?id=" . $Contrato->getId());