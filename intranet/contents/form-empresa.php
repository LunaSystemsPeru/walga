<?php
include '../fixed/cargarSession.php';
require '../../models/Empresa.php';

$Empresa = new Empresa();
$Empresa->setId($_SESSION['empresa_id']);
$Empresa->obtenerDatos();
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
                                <h4 class="page-title">Lista de Empresa</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Configuracion</a></li>
                                    <li class="breadcrumb-item active">Empresa</li>
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
                        <form method="post" action="../controller/actualiza-empresa.php">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="ruc">Ruc</label>
                                        <input type="text" class="form-control text-center" name="input-ruc" value="<?php echo $Empresa->getRuc()?>">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label" for="razonsocial">Razon Social</label>
                                        <input type="text" class="form-control" name="input-razonsocial"
                                               value="<?php echo $Empresa->getRazonsocial()?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label" for="codsunat">Codigo Sunat</label>
                                        <input type="text" class="form-control text-center" name="input-codsunat"
                                               value="<?php echo $Empresa->getCodsunat()?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="dirfiscal">Direccion Fiscal</label>
                                        <input type="text" class="form-control" name="input-dirfiscal"
                                               value="<?php echo $Empresa->getDirfiscal()?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label" for="ubigeo">Ubigeo</label>
                                        <input type="text" class="form-control text-center" name="input-ubigeo" value="<?php echo $Empresa->getUbigeo()?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="departamento">Departamento</label>
                                        <input type="text" class="form-control text-center" name="input-departamento"
                                               value="<?php echo $Empresa->getDepartamento()?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="provincia">Provincia</label>
                                        <input type="text" class="form-control text-center" name="input-provincia" value="<?php echo $Empresa->getProvincia()?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="distrito">Distrito</label>
                                        <input type="text" class="form-control text-center" name="input-distrito" value="<?php echo $Empresa->getDistrito()?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="usuario">Usuario SUNAT</label>
                                        <input type="text" class="form-control text-center" name="input-usuario" value="<?php echo $Empresa->getUsersunat()?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="input-clavesol">Clave SOL</label>
                                        <input type="text" class="form-control text-center" name="input-clavesol"
                                               value="<?php echo $Empresa->getPasssunat()?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <div class="col-auto align-self-center">

                            <button type="submit" class="btn btn-sm btn-soft-primary">
                                <i data-feather="save" class="fas fa-plus mr-2"></i>
                                Actualizar Datos de Empresa
                            </button>
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

<script src="../plugins/apex-charts/apexcharts.min.js"></script>
<script src="../assets/pages/jquery.analytics_dashboard.init.js"></script>

<!-- App js -->
<script src="../assets/js/app.js"></script>

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
