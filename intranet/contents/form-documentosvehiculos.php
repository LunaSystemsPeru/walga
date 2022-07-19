<?php
include '../fixed/cargarSession.php';
require '../../models/Vehiculo.php';
$Vehiculo = new Vehiculo();
$Vehiculo->setEmpresaId($_SESSION['empresa_id']);
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:34:16 GMT -->
<head>
    <meta charset="utf-8"/>
    <title>Walga Inversiones | Transporte y Alquiler de Gruas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Walga Inversiones | Transporte y Alquiler de Gruas" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/faviconwalga.ico">

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css"/>
    <link href="../plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css"/>

</head>

<body data-layout="horizontal" class="">

<!-- Top Bar Start -->
<?php require '../fixed/tob-bar.php' ?>
<!-- Top Bar End -->
<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Registrar Documentos de Vehiculo</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Flota</a></li>
                                    <li class="breadcrumb-item active">Documentos de Vehiculos</li>
                                </ol>
                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form method="post" action="../controller/registra-documentos-vehiculo.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="select_vehiculo">Seleccionar Vehiculo</label>
                                        <select class="form-control" aria-label="Default select example" name="select_vehiculo" id="select_vehiculo">
                                            <option selected>Abrir para seleccionar</option>
                                            <?php
                                            $array_vehiculos = $Vehiculo->verFilas();
                                            foreach ($array_vehiculos as $fila) {
                                                echo '<option value="'.$fila['id'] .'">'.$fila['placa'] .'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="input-datos-vehiculo">Marca | Modelo | Año</label>
                                        <input type="text" class="form-control" id="input-datos-vehiculo" name="input-datos-vehiculo" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="input_documento">Descripcion del documento</label>
                                        <input type="text" class="form-control" id="input_documento" name="input_documento" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="input_datos_emisor">Empresa que emite el documento (escribir para buscar, clic para seleccionar)</label>
                                        <input type="text" class="form-control" id="input_datos_emisor" >
                                        <input type="hidden" id="input_emisor_id" name="input_emisor_id" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="input_emision">Fec. Emision</label>
                                        <input type="date" class="form-control" id="input_emision" name="input_emision" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="input_vencimiento">Fec. Vencimiento</label>
                                        <input type="date" class="form-control" id="input_vencimiento" name="input_vencimiento" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="usuario">Cargar PDF</label>
                                        <input type="file" class="form-control" id="usuario" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <div class="col-auto align-self-center">

                            <a href="#" class="btn btn-sm btn-soft-primary">
                                <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                Guardar Documento
                            </a>
                        </div><!--end col-->
                    </div>
                </div><!--end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!--end row-->


</div><!-- container -->
</div>
<!-- end page content -->
</div>
<!-- end page-wrapper -->
<?php
include('../fixed/footer.php');
?>


<!-- jQuery  -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/metismenu.min.js"></script>
<script src="../assets/js/waves.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/js/simplebar.min.js"></script>
<script src="../assets/js/moment.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>


<!-- App js -->
<script src="../assets/js/app.js"></script>

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
