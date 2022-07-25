<?php
require '../../models/Entidad.php';

$Entidad = new Entidad();

$Entidad->setNrodocumento(filter_input(INPUT_POST, 'input-documento'));
$Entidad->validarDocumento();

$resultado = array();

//si documento existe cargar datos sino de frente a buscar
if ($Entidad->getId() > 0) {
    $Entidad->obtenerDatos();
}

//grabar datos en db
$Entidad->setRazonsocial(filter_input(INPUT_POST, 'input-razon'));
$Entidad->setDireccion(filter_input(INPUT_POST, 'input-direccion'));
if ($Entidad->getId() > 0) {
    $Entidad->actualizar();
} else {
    $Entidad->obtenerId();
    $Entidad->insertar();
}

header("Location: ../contents/lista-entidades.php");

