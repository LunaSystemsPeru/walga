<?php
require '../../models/Contrato.php';

$Contrato = new Contrato();

$Contrato->setId(filter_input(INPUT_POST, 'input-id-contrato'));
$Contrato->obtenerDatos();

$desea_comprobante = filter_input(INPUT_POST, 'select-comprobante');
if ($desea_comprobante == 14) {
    $Contrato->setComprobanteid($desea_comprobante);
}

$Contrato->setMontopagado(filter_input(INPUT_POST, 'input-pago'));
$Contrato->setHorainicio(filter_input(INPUT_POST, 'input-hora'));

$Contrato->modificar();

header("Location: ../contents/contratos.php");