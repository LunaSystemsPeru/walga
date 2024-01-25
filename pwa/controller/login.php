<?php
require '../../models/Usuario.php';

$Usuario = new Usuario();

$Usuario->setUsername(filter_input(INPUT_POST, 'login_username'));
$password = filter_input(INPUT_POST, 'login_pass');

$Usuario->validarUsername();
$error_mensaje = "";
$proceso_aceptado = false;

if ($Usuario->getId() == 0) {
    $error_mensaje = "Usuario no existe";
    echo json_encode(["success" => $proceso_aceptado, "mensaje" => $error_mensaje]);
    return;
}
$Usuario->obtenerDatos();

if ($Usuario->getPassword() != $password) {
    $error_mensaje = "Contraseña Incorrecta";
    echo json_encode(["success" => $proceso_aceptado, "mensaje" => $error_mensaje]);
    return;
}

$error_mensaje = "";
$proceso_aceptado = true;
echo json_encode(["success" => $proceso_aceptado, "mensaje" => $error_mensaje, "id_usuario" => $Usuario->getId(), "id_empresa" => $Usuario->getEmpresaId()]);