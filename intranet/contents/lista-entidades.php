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
                                <h4 class="page-title">Lista de Entidades</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Configuracion</a></li>
                                    <li class="breadcrumb-item active">Entidades</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                                <button class="btn btn-sm btn-soft-primary" data-toggle="modal" data-target="#exampleModalSignup">
                                    <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                    Agregar Entidad - Empresa
                                </button>
                                <div class="modal fade" id="exampleModalSignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Registrar Entidad</h6>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <form class="form-horizontal auth-form my-4" action="../controller/registra-entidad.php">
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputPassword1">Nro Documento Cliente</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="exampleInputPassword1"
                                                                   placeholder="ingrese DNI o RUC" maxlength="11">
                                                            <button class="btn btn-secondary" type="button">Buscar Datos</button>
                                                        </div>
                                                    </div><!--end form-group-->
                                                    <div class="form-group">
                                                        <label class="form-label" for="exampleInputPassword1">Razon Social Cliente</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                                               placeholder="Escriba razon social o ruc">
                                                    </div><!--end form-group-->
                                                    <div class="form-group">
                                                            <label class="form-label" for="exampleInputPassword1">Direccion Cliente</label>
                                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                                   placeholder="Escriba razon social o ruc">
                                                    </div><!--end form-group-->
                                                </form><!--end form-->

                                            </div><!--end auth-page-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-soft-primary btn-sm">Guardar</button>
                                                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                            </div><!--end modal-footer-->
                                        </div><!--end modal-body-->
                                    </div><!--end modal-content-->
                                </div><!--end modal-dialog-->
                            </div>
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Razon Social</th>
                                        <th>Direccion</th>
                                        <th>Documento</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Luis Oyanguren</td>
                                        <td>Urb. Trapecio</td>
                                        <td>0001</td>
                                        <td><span class="badge badge-boxed  badge-outline-success">Activo</span></td>
                                        <td>
                                            <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
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
