<?php
include_once '../fixed/cargarSesion.php';
require '../../models/VehiculoGasto.php';

$Gasto = new VehiculoGasto();

$Gasto->setVehiculoid($_SESSION['vehiculo_id']);
$Gasto->setUsuarioid($_SESSION['usuario_id']);
$Gasto->setFecha(filter_input(INPUT_POST, 'input-fecha'));
$Gasto->limpiar();

$gastos = $_POST['input-gasto'];
$orometro = $_POST['input-orometro'];
$ids = $_POST['input-id'];
$contar = count($gastos);
for ($i = 0; $i < $contar; $i++) {
    echo $gastos[$i], "\n";
    $Gasto->setGastoid($ids[$i]);
    $Gasto->setMonto($gastos[$i]);
    $Gasto->setOrometro($orometro[$i]);
    $Gasto->obtenerId();
    $Gasto->insertar();
}

header("Location: ../contents/gastos-vehiculos.php");