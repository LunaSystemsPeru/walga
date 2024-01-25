<?php
include_once '../fixed/cargarSession.php';
require '../../models/Empresa.php';
$Empresa = new Empresa();
$Empresa->setUsuarioid($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:34:16 GMT -->
<head>
    <meta charset="utf-8"/>
    <title>BOT Asistente Contable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="BOT Asistente Contable" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css"/>
    <link href="../plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css"/>

    <!-- DataTables -->
    <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>

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
                                <h4 class="page-title">Revisar Notificaciones (ultimos 7 dias)</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Servicios</a></li>
                                    <li class="breadcrumb-item active">Notificaciones SUNAT</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                                <button class="btn btn-sm btn-soft-success" onclick="llamarRUC()">
                                    <i data-feather="search" class="fas fa-plus mr-2"></i>
                                    Buscar Notificaciones SUNAT
                                </button>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row" id="grid-notificaciones">
            </div> <!-- end row -->
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

<!-- Required datatable js -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="../plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- App js -->
<script src="../assets/js/app.js"></script>

<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            order: [[1, 'desc']],
        })
    })

    function abrirModal() {
        $("#bd-example-modal-xl").modal("toggle");
    }

    function llamarRUC() {
        $("#grid-notificaciones").html("")
        toastr.info('Solicitando a SUNAT, espere pronto se mostraran los resultados')
        var urlRUCs = '../../httpRequest/obtenerEmpresas.php'
        $.get(urlRUCs, {}, function (data) {
            var items = JSON.parse(data)
            leerRUCs(items)
        })
    }

    function leerRUCs(items) {
        var nroitems = items.length
        for (let x = 0; x < nroitems; x++) {
            llamarNotificaciones(items[x].id, items[x].razon, items[x].ruc, items[x].csunat, items[x].usunat)
        }
        setTimeout(console.log("ya termine de leer"))

    }

    function llamarNotificaciones(id, razon, ruc, clave, usuario) {
        //llamar a la funcion obtenernotificaciones
        var urlRUCs = '../../composer/public/buscarNotificaciones.php'
        $.post(urlRUCs, {"id": id, "razon": razon, "ruc": ruc, "clave": clave, "usuario": usuario}, function (data) {
            if (data) {
                console.log(data);
                var arrayData = JSON.parse(data);
                $("#grid-notificaciones").append('<div class="col-lg-3">' +
                    '<div class="list-group-item align-items-center d-flex justify-content-between">' +
                    '<div class="media">' +
                    '<div class="media-body align-self-center">' +
                    '<h6 class="m-0">RUC: ' + arrayData.ruc + '</h6>' +
                    '<a href="#" class="font-12 text-primary">' + arrayData.razon + '</a>' +
                    '</div>' +
                    '</div>' +
                    '<div class="align-self-center">' +
                    '<span class="text-muted mb-n2">' + arrayData.nromensajes + '</span>' +
                    '<div class="apexchart-wrapper w-30 align-self-center">' +
                    '<div id="dash_spark_1" class="chart-gutters"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>')
            }
        })
    }
</script>

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
