<?php
include '../fixed/cargarSession.php';
require '../../models/Recordatorio.php';
$Documento = new Recordatorio();

$Documento->setNombre(filter_input(INPUT_POST, 'input_documento'));
$Documento->setFecEmision(filter_input(INPUT_POST, 'input_emision'));
$Documento->setFecVencimiento(filter_input(INPUT_POST, 'input_vencimiento'));
$Documento->setEmisorid(filter_input(INPUT_POST, 'input_emisor_id'));
$Documento->setNombrearchivo(filter_input(INPUT_POST, 'input_archivo'));

$Documento->obtenerId();
$Documento->insertar();

header("Location: ../contents/lista-recordatorios.php");
