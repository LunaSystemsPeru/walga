<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../tools/Zebra_Session.php';
require_once '../../models/Conectar.php';
require '../../models/Usuario.php';
require '../../models/ParametroValor.php';
require '../../models/Vehiculo.php';

$Conectar = Conectar::getInstancia();
$Usuario = new Usuario();
$Valor = new ParametroValor();
$Vehiculo = new Vehiculo();

$password = filter_input(INPUT_POST, 'input-password');
$Usuario->setUsername(filter_input(INPUT_POST, 'input-usuario'));
$placa = filter_input(INPUT_POST, 'select-vehiculo');
$Usuario->validarUsername();
//echo "hola" . $Usuario->getId();

if ($Usuario->getId() > 0) {
    //usuario existe
    //verisifcar si esta activo
    $Usuario->obtenerDatos();
    if ($Usuario->getEstado() == 1) {
        $Valor->setId($Usuario->getTipousuarioId());
        $Valor->obtenerDatos();
        if ($Valor->getValor2() == "a") {
            //verificar contraseña :
            if ($Usuario->getPassword() == $password) {
                $link = $Conectar->getLink();
                try {
                    $zebra = new Zebra_Session($link, 'sEcUr1tY_c0dE');
                    $activesession = $zebra->get_active_sessions();
                } catch (Exception $e) {
                    echo $e;
                }

                $Vehiculo->setId($placa);
                $Vehiculo->obtenerDatos();

                $_SESSION['usuario_id'] = $Usuario->getId();
                $_SESSION['empresa_id'] = $Usuario->getEmpresaId();
                $_SESSION['vehiculo'] = $placa;
                $_SESSION['placa'] = $Vehiculo->getPlaca();
                header("Location: ../contents/contratos.php");
            } else {
                //contraseña incorrecta
                header("Location: ../contents/login.php?error=4");
            }
        } else {
            //usuario no tiene permiso para usar este sistema
            header("Location: ../contents/login.php?error=3");
        }
    } else {
        //usuario bloqueado
        header("Location: ../contents/login.php?error=2");
    }
} else {
    //usuario no existe
    header("Location: ../contents/login.php?error=1");
}




