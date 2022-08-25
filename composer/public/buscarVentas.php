<?php

namespace Publics\Bot;

require '../vendor/autoload.php';

use Sunat\Bot\Bot;
use Sunat\Bot\Menu;
use Sunat\Bot\Model\ClaveSol;
use Sunat\Bot\Model\SaleResult;


$user = new ClaveSol();
$user->ruc = '20605715703';
$user->user = 'LLEABIDE';
$user->password = 'eneendump';

$bot = new Bot($user);
$bot->login();

//consultar ventas entre fechas - facturas
$bot->navigate([Menu::CONSULTA_SOL_FACTURA]);
$ventas = $bot->getVentas("01/07/2022", "31/07/2022");

foreach ($ventas as $item) {
    echo "fecha : " . $item->fechaEmisionDesc;
}