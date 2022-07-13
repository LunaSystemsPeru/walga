<?php
require '../tools/Zebra_Session.php';
require_once '../models/Conectar.php';
$conectar = Conectar::getInstancia();
$link = $conectar->getLink();
try {
    $zebra = new Zebra_Session($link, 'sEcUr1tY_c0dE');
    //print_r($_SESSION);
    if (!isset($_SESSION["usuario_id"])) {
        $zebra->stop();
        header("location:../contents/login.php");
    }
} catch (Exception $e) {
    echo $e;
}