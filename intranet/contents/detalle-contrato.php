<?php
require '../../models/Contrato.php';
require '../../models/Cliente.php';
require '../../models/Entidad.php';

$Contrato = new Contrato();
$Cliente = new Cliente();
$Entidad = new Entidad();

$Contrato->setId(filter_input(INPUT_GET, 'id'));
if ($Contrato->getId()){
    $Contrato->obtenerDatos();
    $Cliente->setId($Contrato->getClienteid());
    $Cliente->obtenerDatos();
    $Entidad->setId($Cliente->getEntidadId());
    $Entidad->obtenerDatos();
}
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
                                <h4 class="page-title">Contrato</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Servicios</a></li>
                                    <li class="breadcrumb-item active">Detalle</li>
                                </ol>
                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media mb-3">
                                <div class="media-body align-self-center text-truncate ms-3">
                                    <h4 class="m-0 fw-semibold text-dark font-15">Detalle del Servicio</h4>
                                    <p class="text-muted  mb-0 font-13"><span class="text-dark">Cliente : </span><?php echo $Cliente->getDatos() ?></p>
                                </div><!--end media-body-->
                            </div>
                            <hr class="hr-dashed">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="fw-semibold m-0">Start : <span class="text-muted fw-normal"> 15 Nov 2020</span></h6>
                                <h6 class="fw-semibold m-0">Deadline : <span class="text-muted fw-normal"> 28 Fab 2021</span></h6>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <h5 class="font-16 m-0 fw-bold">$56,800</h5>
                                        <p class="mb-0 fw-semibold">Total Budget</p>
                                    </div>
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <h5 class="font-14 m-0 fw-bold">$22,100 <span class="font-12 text-muted fw-normal">Used Budget</span></h5>
                                </div><!--end col-->
                            </div><!--end row-->

                            <div>
                                <p class="text-muted mt-2 mb-1"><?php echo $Contrato->getServicio() . " DESDE " . $Contrato->getOrigen() . " HASTA " . $Contrato->getDestino() ?>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-semibold">All Hours : <span class="text-muted fw-normal"> 530 / 281:30</span></h6>
                                    <h6 class="fw-semibold">Today : <span class="text-muted fw-normal"> 2:45</span><span class="badge badge-soft-pink fw-semibold ms-2"><i class="far fa-fw fa-clock"></i> 35 days left</span></h6>
                                </div>
                                <p class="text-muted text-end mb-1">15% Complete</p>
                                <div class="progress mb-4" style="height: 4px;">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="img-group">
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="assets/images/users/user-6.jpg" alt="user" class="rounded-circle thumb-xxs">
                                        </a>
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="assets/images/users/user-2.jpg" alt="user" class="rounded-circle thumb-xxs">
                                        </a>
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="assets/images/users/user-3.jpg" alt="user" class="rounded-circle thumb-xxs">
                                        </a>
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle thumb-xxs">
                                        </a>
                                        <a href="" class="avatar-box thumb-xxs align-self-center">
                                            <span class="avatar-title bg-soft-info rounded-circle font-13 fw-normal">+6</span>
                                        </a>
                                    </div><!--end img-group-->
                                    <ul class="list-inline mb-0 align-self-center">
                                        <li class="list-item d-inline-block me-2">
                                            <a class="" href="#">
                                                <i class="mdi mdi-format-list-bulleted text-success font-15"></i>
                                                <span class="text-muted fw-bold">15/100</span>
                                            </a>
                                        </li>
                                        <li class="list-item d-inline-block">
                                            <a class="" href="#">
                                                <i class="mdi mdi-comment-outline text-primary font-15"></i>
                                                <span class="text-muted fw-bold">3</span>
                                            </a>
                                        </li>
                                        <li class="list-item d-inline-block">
                                            <a class="ms-2" href="#">
                                                <i class="mdi mdi-pencil-outline text-muted font-18"></i>
                                            </a>
                                        </li>
                                        <li class="list-item d-inline-block">
                                            <a class="" href="#">
                                                <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!--end task-box-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                </div>
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


<!-- App js -->
<script src="../assets/js/app.js"></script>

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
