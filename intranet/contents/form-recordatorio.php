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

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all"/>

</head>

<body data-layout="horizontal" class="">

<!-- Top Bar Start -->
<?php require '../fixed/top-bar.php' ?>
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
                                <h4 class="page-title">Registrar Recordatorio de Documentos</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Flota</a></li>
                                    <li class="breadcrumb-item active">Recordatorio de Documentos</li>
                                </ol>
                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <form method="post" action="../controller/registra-documentos-vehiculo.php" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="input_datos_emisor">Empresa que emite el documento (escribir para buscar, clic para seleccionar)</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="input_datos_emisor"
                                                       placeholder="buscar por Razon Social" maxlength="200">
                                                <a href="lista-entidades.php" target="_blank" class="btn btn-secondary" type="button"><i class="fas fa-plus"></i> Agregar Empresa Emisora</a>
                                            </div>
                                            <input type="hidden" id="input_emisor_id" name="input_emisor_id">
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
                                            <input type="file" class="form-control" id="uploadedFile" name="uploadedFile">
                                        </div>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                            <div class="card-footer">
                                <div class="col-auto align-self-center">
                                    <button type="submit" class="btn btn-sm btn-soft-primary">
                                        <i data-feather="save" class="fas fa-save mr-2"></i>
                                        Guardar Documento y Recordatorio
                                    </button>
                                </div><!--end col-->
                            </div>
                        </div><!--end card-->
                    </form>
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

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
        integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY="
        crossorigin="anonymous"></script>


<!-- App js -->
<script src="../assets/js/app.js"></script>

<script>
    //buscar clientes
    $("#input_datos_emisor").autocomplete({
        source: "../../inputAjax/obtenerJsonEntidades.php",
        minLength: 3,
        select: function (event, ui) {
            event.preventDefault();
            $("#input_datos_emisor").val(ui.item.razonsocial);
            $("#input_emisor_id").val(ui.item.id);
            $("#input_documento").focus();
        }
    });
</script>
</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
