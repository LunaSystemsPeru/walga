<?php

namespace Publics\Bot;

require '../vendor/autoload.php';
require '../../models/Empresa.php';

use Sunat\Bot\Bot;
use Sunat\Bot\Model\ClaveSol;

$user = new ClaveSol();
$Empresa = new \Empresa();
$Empresa->setId(filter_input(INPUT_POST, 'id'));
$Empresa->obtenerDatos();
if ($Empresa->getRuc()) {
    $user->ruc = $Empresa->getRuc();
    $user->user = $Empresa->getUsersunat();
    $user->password = $Empresa->getPasssunat();

    $bot = new Bot($user);
    $url = $bot->urlSUNAT();
    echo json_encode(["url" => $url]);
} else {
    echo json_encode(["url" => ""]);
}