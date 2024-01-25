<?php
include_once '../fixed/cargarSession.php';
require '../../models/VehiculoGasto.php';

$Gasto = new VehiculoGasto();
$placa = filter_input(INPUT_POST, 'input-placa');
$Gasto->setVehiculoid(0);
$Gasto->setUsuarioid(filter_input(INPUT_POST, 'input-usuario'));
$Gasto->setGastoid(25);
$Gasto->setMonto(filter_input(INPUT_POST, 'monto-cierre'));
$Gasto->setFecha(filter_input(INPUT_POST, 'fecha-cierre'));
$Gasto->setOrometro(0);
$Gasto->setObservacion(filter_input(INPUT_POST, 'input-observacion') . " - " . $placa   );

$Gasto->obtenerId();
echo $Gasto->insertar();
echo "<br>";

$Gasto->setVehiculoid(0);
$Gasto->setMonto(filter_input(INPUT_POST, 'monto-cierre') * -1);
$Gasto->setOrometro(0);
$Gasto->setUsuarioid($_SESSION['usuario_id']);

$Gasto->obtenerId();
echo $Gasto->insertar();

header("Location: ../contents/lista-gastos.php?placa=" . $Gasto->getVehiculoid() . "&fecha_inicio=" . $Gasto->getFecha() . "&fecha_final=" . $Gasto->getFecha());
