<?php
require '../../models/Entidad.php';
require '../../models/DocumentoInternet.php';

$Entidad = new Entidad();
$CInternet = new DocumentoInternet();


$CInternet->setNroDocumento(filter_input(INPUT_POST, 'nrodocumento'));

$Entidad->setNrodocumento($CInternet->getNroDocumento());
$Entidad->validarDocumento();

$resultado = array();

//si documento existe cargar datos sino de frente a buscar
if ($Entidad->getId() > 0) {
    $Entidad->obtenerDatos();
}

//verificar que nro de documento sea ruc o dni
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
}

if (strlen($CInternet->getNroDocumento()) == 8) {
    $CInternet->setTipoDocumento(2);
    $respuesta = json_decode($CInternet->validar(), true);
    if (!$respuesta) {
        $resultado["success"] = "error";
        $resultado["documento"] = $CInternet->getNroDocumento();
        $resultado["datos"] = "error de documento";
        $resultado["direccion"] = "";
    } else {
        $resultado["success"] = "nuevo";
        $resultado["documento"] = $respuesta["dni"];
        $resultado["datos"] = $respuesta["nombre"];
        $resultado["direccion"] = "-";
    }
}


//grabar datos en db
$Entidad->setRazonsocial($resultado["datos"]);
$Entidad->setDireccion($resultado["direccion"]);
if ($resultado["success"] != "error") {
    if ($Entidad->getId() > 0) {
        $Entidad->actualizar();
    } else {
        $Entidad->obtenerId();
        $Entidad->insertar();
    }
    $resultado["id"] = $Entidad->getId();
} else {
    $resultado["id"] = 0;
}


echo json_encode($resultado);

