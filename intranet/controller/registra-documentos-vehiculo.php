<?php
include '../fixed/cargarSession.php';
require '../../models/Recordatorio.php';
$Documento = new Recordatorio();

$Documento->setNombre(filter_input(INPUT_POST, 'input_documento'));
$Documento->setFecEmision(filter_input(INPUT_POST, 'input_emision'));
$Documento->setFecVencimiento(filter_input(INPUT_POST, 'input_vencimiento'));
$Documento->setEmisorid(filter_input(INPUT_POST, 'input_emisor_id'));
$Documento->setEmpresaid($_SESSION['empresa_id']);

if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'pdf');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // directory in which the uploaded file will be moved
        $uploadFileDir = '../../public/uploaded_files/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $message = 'File is successfully uploaded.';
            $Documento->setNombrearchivo($newFileName);
        } else {
            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }
    }
}


$Documento->obtenerId();
$Documento->insertar();

header("Location: ../contents/lista-recordatorios.php");
