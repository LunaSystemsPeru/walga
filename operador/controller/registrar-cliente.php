<?php
require_once '../fixed/cargarSesion.php';
require '../../models/Cliente.php';
require '../../models/Entidad.php';
$Cliente = new Cliente();
$Entidad = new Entidad();

$Entidad->setNrodocumento(filter_input(INPUT_POST, 'input-ruc'));
$Entidad->setRazonsocial(filter_input(INPUT_POST, 'input-razon-social'));
$Entidad->setDireccion(filter_input(INPUT_POST, 'input-direccion-ruc'));

if ($Entidad->getRazonsocial()) {
    $Entidad->validarDocumento();
    if ($Entidad->getId() > 0) {
        $Entidad->actualizar();
    } else {
        $Entidad->obtenerId();
        $Entidad->insertar();
    }
} else {
    $Entidad->setId(0);
}

$Cliente->setDatos(filter_input(INPUT_POST, 'input-datos'));
$Cliente->setCelular(filter_input(INPUT_POST, 'input-celular'));
$Cliente->setEmail(filter_input(INPUT_POST, 'input-email'));
$Cliente->setReferencia(filter_input(INPUT_POST, 'input-referencia'));
$Cliente->setEmpresaId($_SESSION['empresa_id']);
$Cliente->setEntidadId($Entidad->getId());
$Cliente->obtenerId();
$Cliente->insertar();

header("Location: ../contents/registra-contrato.php");