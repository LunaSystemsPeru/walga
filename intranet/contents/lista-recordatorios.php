<?php
include '../fixed/cargarSession.php';
require '../../models/Recordatorio.php';
require '../../tools/Util.php';
$Recordatorio = new Recordatorio();
$Util = new Util();
$Recordatorio->setEmpresaid($_SESSION['empresa_id']);
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
                                <h4 class="page-title">Lista Documentos de Vehiculos</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Flota</a></li>
                                    <li class="breadcrumb-item active">Recordatorios</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">

                                <a href="form-recordatorio.php" class="btn btn-sm btn-soft-primary">
                                    <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                    Agregar nuevo Recordatorio
                                </a>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="card">
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Dias a Vencer</th>
                                    <th>F. Vencimiento</th>
                                    <th>Nombre Documento</th>
                                    <th>F. Emision</th>
                                    <th>Estado</th>
                                    <th>Emisor</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $array_recordatorios = $Recordatorio->verFilas();
                                foreach ($array_recordatorios as $fila) {
                                 ?>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td class="text-center"><?php echo $fila['diasfaltantes'] ?></td>
                                        <td class="text-center"><?php echo $Util->fecha_mysql_web($fila['fec_vencimiento']) ?></td>
                                        <td><?php echo $fila['documento'] ?></td>
                                        <td class="text-center"><?php echo $Util->fecha_mysql_web($fila['fec_emision']) ?></td>
                                        <td class="text-center">
                                            <span class="badge badge-boxed  badge-outline-success">Activo</span>
                                        </td>
                                        <td><?php echo $fila['razonsocial'] ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm"><i class="ti ti-file"></i></button>
                                            <button class="btn btn-success btn-sm"><i class="ti ti-reddit"></i></button>
                                            <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                    </div><!--end card-body-->
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

<script src="../plugins/apex-charts/apexcharts.min.js"></script>
<script src="../assets/pages/jquery.analytics_dashboard.init.js"></script>

<!-- App js -->
<script src="../assets/js/app.js"></script>

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
