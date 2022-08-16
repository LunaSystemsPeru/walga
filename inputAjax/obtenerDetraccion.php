<?php
require '../models/ParametroValor.php';

$Parametro = new ParametroValor();
$Parametro->setId(filter_input(INPUT_GET, 'id'));
$Parametro->obtenerDatos();

echo json_encode(["porcentaje" => $Parametro->getValor1()]);