<?php
require '../../models/ContratoPago.php';

$Pago = new ContratoPago();

$Pago->setId(filter_input(INPUT_GET, 'pagoid'));
$Pago->obtenerDatos();
$Pago->eliminarId();

header("Location: ../contents/detalle-contrato.php?id=" . $Pago->getContratoid());