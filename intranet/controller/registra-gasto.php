<?php
include_once '../fixed/cargarSession.php';
require '../../models/VehiculoGasto.php';

$Gasto = new VehiculoGasto();
$Gasto->setVehiculoid(filter_input(INPUT_POST, 'input-vehiculo'));
$Gasto->setUsuarioid($_SESSION['usuario_id']);
$Gasto->setGastoid(filter_input(INPUT_POST,'input-tipo-gasto'));
$Gasto->setMonto(filter_input(INPUT_POST, 'monto-gasto'));
$Gasto->setFecha(filter_input(INPUT_POST, 'fecha-gasto'));
$Gasto->setOrometro(0);
$Gasto->setObservacion(filter_input(INPUT_POST, 'input-observacion'));

$Gasto->obtenerId();
$Gasto->insertar();

header("Location: " . $_SERVER["HTTP_REFERER"]);
