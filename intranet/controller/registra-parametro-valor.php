<?php
require '../../models/ParametroValor.php';
$Valor = new ParametroValor();

$Valor->setDescripcion(filter_input(INPUT_POST, 'input-descripcion'));
$Valor->setValor1(filter_input(INPUT_POST, 'input-valor1'));
$Valor->setValor2(filter_input(INPUT_POST, 'input-valor2'));
$Valor->setParametroId(filter_input(INPUT_POST, 'input-parametro-id'));
$Valor->obtenerId();
$Valor->insertar();
header("Location: ../contents/lista-parametros.php?tipo=" . $Valor->getParametroId());