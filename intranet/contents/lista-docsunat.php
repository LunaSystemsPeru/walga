<?php
include '../fixed/cargarSession.php';
require '../../models/ComprobanteSunat.php';
require '../../models/ParametroValor.php';
require '../../tools/Util.php';

$Valor = new ParametroValor();
$Comprobante = new ComprobanteSunat();
$Util = new Util();

$Comprobante->setEmpresaid($_SESSION['empresa_id']);

$Valor->setParametroId(1);

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
                                <h4 class="page-title">Lista de Documentos Sunat</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Configuracion</a></li>
                                    <li class="breadcrumb-item active">Documentos Sunat</li>
                                </ol>
                            </div><!--end col-->
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#exampleModalSignup">
                                Agregar Documento SUNAT
                            </button>
                            <!--start signup-->
                            <div class="modal fade" id="exampleModalSignup" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Registrar
                                                Documento SUNAT</h6>
                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div><!--end modal-header-->
                                        <form class="form-horizontal auth-form my-4" action="../controller/registra-comprobante-sunat.php" method="post">
                                            <div class="modal-body">
                                                <div class="auth-page">
                                                    <div class="auth-card">
                                                        <div class="px-3">
                                                            <div class="form-group">
                                                                <label for="select-comprobante">Seleccionar
                                                                    Comprobante</label>
                                                                <select class="form-control mb-3" style="width: 100%; height:36px;" name="select-comprobante" id="select-comprobante">
                                                                    <?php
                                                                    $arraycomprobantes = $Valor->verFilas();
                                                                    foreach ($arraycomprobantes as $fila) {
                                                                        echo '<option value="' . $fila['id'] . '">' . $fila['descripcion'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div><!--end form-group-->
                                                            <div class="form-group">
                                                                <label for="serie">Serie</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control" id="input-serie" name="input-serie" placeholder="Serie" maxlength="4">
                                                                </div>
                                                            </div><!--end form-group-->
                                                            <div class="form-group">
                                                                <label for="input-numero">Numero</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="number" class="form-control" id="input-numero" name="input-numero" placeholder="Numero" maxlength="7">
                                                                </div>
                                                            </div><!--end form-group-->

                                                        </div><!--end /div-->
                                                    </div><!--end card-->
                                                </div><!--end auth-page-->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-soft-primary btn-sm">Guardar</button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                </div><!--end modal-footer-->
                                        </form><!--end form-->
                                    </div><!--end modal-body-->
                                </div><!--end modal-content-->
                            </div><!--end modal-dialog-->
                        </div><!--end modal-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Comprobante</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Numero</th>
                                    <th class="text-center">Abreviatura</th>
                                    <th class="text-center">Cod SUNAT</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $arrayDocumentos = $Comprobante->verFilas();
                                $item = 1;
                                foreach ($arrayDocumentos as $fila) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $item ?></th>
                                        <td><?php echo $fila['descripcion'] ?></td>
                                        <td class="text-center"><?php echo $fila['serie'] ?></td>
                                        <td class="text-center"><?php echo $Util->zerofill($fila['numero'], 7) ?></td>
                                        <td class="text-center"><?php echo $fila['valor1'] ?></td>
                                        <td class="text-center"><?php echo $fila['valor2'] ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-sm"><i class="ti ti-pencil"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                    $item++;
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
