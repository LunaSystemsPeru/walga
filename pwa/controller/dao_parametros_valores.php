<?php

require '../../models/ParametroValor.php';

$Detalle = new ParametroValor();

$accion = filter_input(INPUT_GET, 'accion');

if ($accion == "listar") {
    $Detalle->setParametroId(filter_input(INPUT_POST, 'parametro_id'));
    echo $Detalle->verFilas(true);
}