<?php
require_once 'cargarSesion.php';
require '../models/Cliente.php';

$Cliente = new Cliente();
$Cliente->setEmpresaId($_SESSION['empresa_id']);

$searchTerm = filter_input(INPUT_GET, 'term');

$array_clientes = $Cliente->buscarClientes($searchTerm);
$array_resultado = array();
foreach ($array_clientes as $fila) {
    $array_fila['value'] = trim($fila['datos'] . " - " . $fila['referencia']);
    $array_fila['id'] = $fila['id'];
    $array_fila['datos'] = $fila['datos'];
    $array_fila['email'] = $fila['email'];
    $array_fila['entidad_id'] = $fila['entidad_id'];
    $array_fila['referencia'] = $fila['referencia'];
    array_push($array_resultado, $array_fila);
}

echo json_encode($array_resultado);

