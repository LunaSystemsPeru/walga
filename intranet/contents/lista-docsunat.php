<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:34:16 GMT -->
<head>
    <meta charset="utf-8"/>
    <title>Dastone - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
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
                                <h4 class="page-title">Lista de Documentos Sunat</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Configuracion</a></li>
                                    <li class="breadcrumb-item active">Documentos Sunat</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                                <a href="#" class="btn btn-sm btn-soft-primary" >
                                    <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                    Agregar Doc Sunat
                                </a>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <div class="card">

                    </div><!--end card-header-->
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalSignup">
                            Agregar Documento SUNAT
                        </button>
                        <!--start signup-->
                        <div class="modal fade" id="exampleModalSignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title m-0" id="exampleModalDefaultSignup">SignUp Modal</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div><!--end modal-header-->
                                    <div class="modal-body">
                                        <div class="auth-page">
                                            <div class="auth-card">
                                                <div class="">
                                                    <div class="px-3">
                                                        <div class="auth-logo-box text-center">
                                                            <a href="analytics-index.html" class="logo logo-admin"><img src="assets/images/logo-sm.png" height="40" alt="logo" class="auth-logo"></a>
                                                        </div><!--end auth-logo-box-->

                                                        <div class="text-center auth-logo-text">
                                                            <h4 class="mt-0 m2-3 mt-3">Free Register for Maxdot</h4>
                                                            <p class="text-muted mb-0">Get your free Maxdot account now.</p>
                                                        </div> <!--end auth-logo-text-->

                                                        <form class="form-horizontal auth-form my-4" action="index.html">

                                                            <div class="form-group">
                                                                <label for="username">Username</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                                                                </div>
                                                            </div><!--end form-group-->

                                                            <div class="form-group">
                                                                <label for="useremail">Email</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="email" class="form-control" id="useremail" placeholder="Enter Email">
                                                                </div>
                                                            </div><!--end form-group-->

                                                            <div class="form-group">
                                                                <label for="userpassword">Password</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                                                </div>
                                                            </div><!--end form-group-->

                                                            <div class="form-group">
                                                                <label for="conf_password">Confirm Password</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="password" class="form-control" id="conf_password" placeholder="Enter Confirm Password">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="mo_number">Mobile Number</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control" id="mo_number" placeholder="Enter Mobile Number">
                                                                    </div>
                                                                </div><!--end form-group-->
                                                            </div><!--end form-group-->

                                                            <div class="form-group row mt-4">
                                                                <div class="col-sm-12">
                                                                    <div class="custom-control custom-switch switch-success">
                                                                        <input type="checkbox" class="custom-control-input" id="customSwitchSuccess_Signup">
                                                                        <label class="custom-control-label text-muted" for="customSwitchSuccess_Signup">By registering you agree to the Frogetor <a href="#" class="text-primary">Terms of Use</a></label>
                                                                    </div>
                                                                </div><!--end col-->
                                                            </div><!--end form-group-->

                                                            <div class="form-group mb-0 row">
                                                                <div class="col-12 mt-2">
                                                                    <button class="btn btn-primary btn-rounded btn-block" type="submit">Register <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                                </div><!--end col-->
                                                            </div> <!--end form-group-->
                                                        </form><!--end form-->
                                                    </div><!--end /div-->

                                                    <div class="m-3 text-center text-muted">
                                                        <p class="">Already have an account ? <a href="auth-login.html" class="text-primary ms-2">Log in</a></p>
                                                    </div>
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                        </div><!--end auth-page-->
                                    </div><!--end modal-body-->

                                </div><!--end modal-content-->
                            </div><!--end modal-dialog-->
                        </div><!--end modal-->
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Comprobante </th>
                                    <th>Serie</th>
                                    <th>Numero</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Factura</td>
                                    <td>T</td>
                                    <td>0001</td>
                                    <td><span class="badge badge-boxed  badge-outline-success">Activo</span></td>
                                    <td><button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button></td>
                                </tr>
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
