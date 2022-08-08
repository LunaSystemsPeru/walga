<?php
require '../models/Cliente.php';
$Cliente = new Cliente();

$Cliente->setId(filter_input(INPUT_POST, 'clienteid'));
echo $Cliente->obtenerEntidad();