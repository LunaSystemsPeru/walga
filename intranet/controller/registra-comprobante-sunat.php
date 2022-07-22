<?php
include '../fixed/cargarSession.php';
require '../../models/ComprobanteSunat.php';

$Comprobante = new ComprobanteSunat();

$Comprobante->setEmpresaid($_SESSION['empresa_id']);
$Comprobante->setComprobanteid(filter_input(INPUT_POST, 'select-comprobante'));
$Comprobante->setSerie(filter_input(INPUT_POST, 'input-serie'));
$Comprobante->setNumero(filter_input(INPUT_POST, 'input-numero'));

$Comprobante->obtenerId();
$Comprobante->insertar();

header("Location: ../contents/lista-docsunat.php");