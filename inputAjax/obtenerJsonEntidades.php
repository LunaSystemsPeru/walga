<?php
require '../models/Entidad.php';

$Entidad = new Entidad();

$searchTerm = filter_input(INPUT_GET, 'term');
$array_entidades = $Entidad->buscarEntidad($searchTerm);

$array_resultado = array();
foreach ($array_entidades as $fila) {
    $array_fila['value'] = trim($fila['razonsocial'] . " - " . $fila['documento']);
    $array_fila['id'] = $fila['id'];
    $array_fila['razonsocial'] = $fila['razonsocial'];
    $array_fila['documento'] = $fila['documento'];
    $array_fila['direccion'] = $fila['direccion'];
    array_push($array_resultado, $array_fila);
}

echo json_encode($array_resultado);

