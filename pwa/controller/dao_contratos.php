<?php
require '../../models/Contrato.php';

$Contrato = new Contrato();

$accion = filter_input(INPUT_GET, 'accion');

if ($accion == "listar") {
    $Contrato->setFecha(filter_input(INPUT_POST, 'fecha'));
    $Contrato->setVehiculoid(filter_input(INPUT_POST, 'vehiculo_id'));
    echo $Contrato->verContratosActivos(true);
}