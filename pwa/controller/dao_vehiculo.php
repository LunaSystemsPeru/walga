<?php
require '../../models/Vehiculo.php';

$Vehiculo = new Vehiculo();

$accion = filter_input(INPUT_GET, 'accion');

if ($accion == 'listar') {
    $Vehiculo->setEmpresaId(filter_input(INPUT_POST, 'id_empresa'));
    echo $Vehiculo->verPlacasTrabajo(true);
}