<?php
$servicio = filter_input(INPUT_POST, 'input-servicio');
$nombre = filter_input(INPUT_POST, 'input-contacto');
$tiposervicio = filter_input(INPUT_POST, 'select-servicio');

$texto = "Hola, mi nombre es " . $nombre . " y estoy interesado en " . $tiposervicio . " para " . $servicio;

header("Location: https://wa.me/+51949490436?text=" . $texto);