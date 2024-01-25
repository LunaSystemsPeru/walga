<?php
require '../models/DocumentoInternet.php';

$CInternet = new DocumentoInternet();

$CInternet->setNroDocumento(filter_input(INPUT_POST, 'nrodocumento'));
$resultado = array();

if (strlen($CInternet->getNroDocumento()) == 11) {
    $CInternet->setTipoDocumento(1);
    $respuesta = json_decode($CInternet->validar(), true);
    if (!$respuesta) {
        $resultado["success"] = "error";
        $resultado["documento"] = $CInternet->getNroDocumento();
        $resultado["datos"] = "error de documento";
        $resultado["direccion"] = "";
    } else {
        $resultado["success"] = "nuevo";
        $resultado["documento"] = $respuesta["ruc"];
        $resultado["datos"] = $respuesta["razonSocial"];
        $resultado["direccion"] = $respuesta["direccion"];
    }
} else if (strlen($CInternet->getNroDocumento()) == 8) {
    $CInternet->setTipoDocumento(2);
    $respuesta = json_decode($CInternet->validar(), true);
    if (!$respuesta) {
        $resultado["success"] = "error";
        $resultado["documento"] = $CInternet->getNroDocumento();
        $resultado["datos"] = "error de documento";
        $resultado["direccion"] = "";
    } else {
        $resultado["success"] = "nuevo";
        $resultado["documento"] = $CInternet->getNroDocumento();
        $resultado["datos"] = $respuesta["apellidoPaterno"] . " " . $respuesta["apellidoMaterno"] . " " . $respuesta["nombres"];
        $resultado["direccion"] = "-";
    }
} else {
    $resultado["success"] = "error";
    $resultado["documento"] = $CInternet->getNroDocumento();
    $resultado["datos"] = "error de documento";
    $resultado["direccion"] = "";
}

echo json_encode($resultado);