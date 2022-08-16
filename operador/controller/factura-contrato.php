<?php
include '../fixed/cargarSesion.php';
require '../../models/Contrato.php';
require '../../models/Cliente.php';
require '../../models/Entidad.php';

$Contrato = new Contrato();
$Cliente = new Cliente();
$Entidad = new Entidad();

$Contrato->setId(filter_input(INPUT_POST, 'input-id-contrato'));
$Contrato->obtenerDatos();

$Entidad->setNrodocumento(filter_input(INPUT_POST, 'input-ruc'));
$Entidad->setRazonsocial(filter_input(INPUT_POST, 'input-razon-social'));
$Entidad->setDireccion(filter_input(INPUT_POST, 'input-direccion-ruc'));
$Entidad->validarDocumento();

if (!$Entidad->getId()) {
    $Entidad->obtenerId();
    $Entidad->insertar();
}

$Cliente->setId(filter_input(INPUT_POST, 'input-cliente'));
$Cliente->setDatos(filter_input(INPUT_POST, 'input-datos'));
$Cliente->setEmail(filter_input(INPUT_POST, 'input-email'));
$Cliente->setCelular(filter_input(INPUT_POST, 'input-celular'));
$Cliente->setReferencia(filter_input(INPUT_POST, 'input-referencia'));
$Cliente->setEntidadId($Entidad->getId());
$Cliente->setEmpresaId($_SESSION['empresa_id']);
if ($Cliente->getId() > 0) {
    $Cliente->modificar();
} else {
    $Cliente->obtenerId();
    $Cliente->insertar();
}

$Contrato->setClienteid($Cliente->getId());
$Contrato->modificar();


header("Location: ../contents/contratos.php");
