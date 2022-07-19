<?php
include_once '../fixed/cargarSesion.php';
require '../../models/VehiculoGasto.php';

$Gasto = new VehiculoGasto();

$Gasto->setVehiculoid($_SESSION['vehiculo_id']);
$Gasto->setUsuarioid($_SESSION['usuario_id']);
$Gasto->setFecha(filter_input(INPUT_POST, 'input-fecha'));
$Gasto->setDescripcion(filter_input(INPUT_POST, 'input-descripcion'));
$Gasto->setMonto(filter_input(INPUT_POST, 'input-monto'));
$Gasto->setOrometro(filter_input(INPUT_POST, 'input-orometro'));

$Gasto->obtenerId();
$Gasto->insertar();

header("Location: ../contents/gastos-vehiculos.php");