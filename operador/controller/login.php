<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../tools/Zebra_Session.php';
require_once '../../models/Conectar.php';

$conectar = Conectar::getInstancia();

$link = $conectar->getLink();
try {
    $zebra = new Zebra_Session($link, 'sEcUr1tY_c0dE');
    $activesession = $zebra->get_active_sessions();
} catch (Exception $e) {
    echo $e;
}

$_SESSION['tiendaid'] = $Usuario->getIdalmacen();
$_SESSION['empresaruc'] = $Empresa->getRuc();
$_SESSION['empresaid'] = $Empresa->getIdempresa();
$_SESSION['usuarioid'] = $Usuario->getIdusuario();
$_SESSION['tiendanombre'] = $Tienda->getNombre();
