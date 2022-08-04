<?php
require '../../models/Contrato.php';
require '../fixed/cargarSesion.php';

$Contrato = new Contrato();

$Contrato->setFecha(filter_input(INPUT_POST, 'input-fecha'));
$Contrato->setUsuarioid($_SESSION['usuario_id']);
$Contrato->setVehiculoid($_SESSION['vehiculo_id']);
$Contrato->setChoferid($_SESSION['chofer_id']);
$Contrato->setEmpresaid($_SESSION['empresa_id']);
$Contrato->setClienteid(filter_input(INPUT_POST, 'input-id-cliente'));
$Contrato->setTiposervicioid(filter_input(INPUT_POST, 'select-tipo-servicio'));
$Contrato->setServicio(filter_input(INPUT_POST, 'input-servicio'));
$Contrato->setOrigen(filter_input(INPUT_POST, 'input-origen'));
$Contrato->setDestino(filter_input(INPUT_POST, 'input-destino'));
$Contrato->setMontocontrato(filter_input(INPUT_POST, 'input-monto'));
$Contrato->setHorainicio(filter_input(INPUT_POST, 'input-hora'));
$Contrato->setHorasservicio(0);
$Contrato->setEstado(1);

$Contrato->obtenerId();
$Contrato->insertar();

//header("Location: ../contents/acepta-contrato.php?id=" . $Contrato->getId());

header("Location: ../contents/contratos.php");