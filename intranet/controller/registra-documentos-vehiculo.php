<?php
include '../fixed/cargarSession.php';
require '../../models/VehiculoDocumento.php';
$Documento = new VehiculoDocumento();

$Documento->setVehiculoid(filter_input(INPUT_POST, 'select_vehiculo'));
$Documento->setNombre(filter_input(INPUT_POST, 'input-documento'));
$Documento->setFecEmision(filter_input(INPUT_POST, 'input_emision'));
$Documento->setFecVencimiento(filter_input(INPUT_POST, 'input_vencimiento'));
$Documento->setEmisorid(filter_input(INPUT_POST, 'input_emisor_id'));
$Documento->setNombrearchivo(filter_input(INPUT_POST, 'input_archivo'));

$Documento->obtenerId();
$Documento->insertar();
