<?php
include_once '../fixed/cargarSession.php';
require '../../models/VehiculoGasto.php';

$Gasto = new VehiculoGasto();

$Gasto->setVehiculoid(filter_input(INPUT_POST, 'input-vehiculo'));
$Gasto->setUsuarioid($_SESSION['usuario_id']);
$Gasto->setGastoid(21);
$Gasto->setMonto(filter_input(INPUT_POST, 'monto-cierre'));
$Gasto->setFecha(filter_input(INPUT_POST, 'fecha-cierre'));
$Gasto->setOrometro(0);

$Gasto->obtenerId();
echo $Gasto->insertar();
echo "<br>";

$Gasto->setVehiculoid(0);
$Gasto->setMonto(filter_input(INPUT_POST, 'monto-cierre') * -1);
$Gasto->setOrometro(0);

$Gasto->obtenerId();
echo $Gasto->insertar();
