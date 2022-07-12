<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../tools/Zebra_Session.php';
require_once '../../models/Conectar.php';

require '../../models/Usuario.php';

$Usuario = new Usuario;

$conectar = Conectar::getInstancia();

$Usuario->setUsername(filter_input(INPUT_POST, 'inputUsuario'));
$password = filter_input(INPUT_POST, 'inputPassword');
$Usuario->validarUsuario();

//usuario existe
if ($Usuario->getIdusuario()) {
    //vcontrasrña correcta
    if ($password == $Usuario->getPassword()) {
        //verificar estado
        if ($Usuario->getEstado() == 1) {
            $Usuario->obtenerDatos();

            $link = $conectar->getLink();
            try {
                $zebra = new Zebra_Session($link, 'sEcUr1tY_c0dE');
                $activesession = $zebra->get_active_sessions();
            } catch (Exception $e) {
                echo $e;
            }

            $Tienda->setIdalmacen($Usuario->getIdalmacen());
            $Tienda->obtenerDatos();
            $Empresa->setIdempresa($Tienda->getIdempresa());
            $Empresa->obtenerDatos();

            $_SESSION['tiendaid'] = $Usuario->getIdalmacen();
            $_SESSION['empresaruc'] = $Empresa->getRuc();
            $_SESSION['empresaid'] = $Empresa->getIdempresa();
            $_SESSION['usuarioid'] = $Usuario->getIdusuario();
            $_SESSION['tiendanombre'] = $Tienda->getNombre();
            header("Location: ../contents/form-venta.php");
        } else {
            //usuario bloqueado
            header("Location: ../login.php?error=1");
            return false;
        }
    } else {
        //echo "contraseña incorrecta";
        header("Location: ../login.php?error=2");
        return false;
    }
} else {
    header("Location: ../login.php?error=3");
    return false;
}
