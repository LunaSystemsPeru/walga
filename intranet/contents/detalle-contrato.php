<?php
require '../../models/Contrato.php';
require '../../models/Cliente.php';
require '../../models/Entidad.php';
require '../../models/ContratoPago.php';
require '../../tools/Util.php';

$Contrato = new Contrato();
$Cliente = new Cliente();
$Entidad = new Entidad();
$Pago = new ContratoPago();

$Util = new Util();

$Contrato->setId(filter_input(INPUT_GET, 'id'));
$Contrato->obtenerDatos();
$Cliente->setId($Contrato->getClienteid());
$Cliente->obtenerDatos();
$Entidad->setId($Cliente->getEntidadId());
$Entidad->obtenerDatos();
$Pago->setContratoid($Contrato->getId());

$fechaUno = new DateTime($Contrato->getHorainicio());
$fechaDos = new DateTime($Contrato->getHoratermino());

$dateInterval = $fechaUno->diff($fechaDos);
$totalhoras = $dateInterval->format('%H horas %i minutos') . PHP_EOL;
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
                                <h4 class="page-title">Detalle del Contrato</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Servicios</a></li>
                                    <li class="breadcrumb-item active">Contrato</li>
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
                        <div class="card-header">
                            <h4 class="card-title">Descripcion de servicio</h4>
                        </div>
                        <div class="card-body">
                            <div class="media mb-3">
                                <div class="media-body align-self-center text-truncate ms-3">
                                    <!--<h4 class="m-0 fw-semibold text-dark font-15">Detalle del Servicio</h4>-->
                                    <p class="text-muted  mb-0 font-13"><span class="text-dark">Cliente : </span><?php echo $Cliente->getDatos() ?></p>
                                </div><!--end media-body-->
                            </div>
                            <hr class="hr-dashed">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="fw-semibold m-0">Fecha : <span class="text-muted fw-normal"> <?php echo $Util->fecha_mysql_web($Contrato->getFecha()) ?></span></h6>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <h5 class="font-16 m-0 fw-bold">S/ <?php echo number_format($Contrato->getMontocontrato(), 2) ?></h5>
                                        <p class="mb-0 fw-semibold">Total Aprobado</p>
                                    </div>
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <h5 class="font-14 m-0 fw-bold">S/ <?php echo number_format($Contrato->getMontocontrato() - $Contrato->getMontopagado(), 2) ?> <span class="font-12 text-muted fw-normal">por Cobrar</span></h5>
                                </div><!--end col-->
                            </div><!--end row-->

                            <div>
                                <p class="text-muted mt-2 mb-1"><?php echo strtoupper($Contrato->getServicio() . " DESDE " . $Contrato->getOrigen() . " HASTA " . $Contrato->getDestino()) ?>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-semibold">Horario : <span class="text-muted fw-normal"> <?php echo $Contrato->getHorainicio() . " hasta " . $Contrato->getHoratermino() ?></span></h6>
                                    <h6 class="fw-semibold">Total Horas <span class="text-muted fw-normal"> <?php echo $totalhoras ?></span></h6>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <ul class="list-inline mb-0 align-self-center">
                                        <li class="list-item d-inline-block">
                                            <button class="ms-2" data-toggle="modal"
                                                    data-target="#exampleModalSignup">
                                                <i class="mdi mdi-pencil-outline text-muted font-18"></i>
                                            </button>
                                        </li>
                                        <li class="list-item d-inline-block">
                                            <a class="" href="#">
                                                <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="modal fade" id="exampleModalSignup" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Modificar Contrato - Servicio</h6>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <form class="form-horizontal auth-form my-4" action="../controller/modifica-contrato.php" method="post">
                                                <div class="modal-body">
                                                    <div class="auth-page">
                                                        <div class="auth-card">
                                                            <div class="px-3">
                                                                <div class="form-group">
                                                                    <label for="serie">Descripcion del Contrato</label>
                                                                    <div class="input-group mb-3">
                                                                        <textarea class="form-control"><?php echo $Contrato->getServicio() ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="serie">Origen</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control" id="input-serie" name="input-serie" placeholder="Serie" maxlength="4">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="serie">Destino</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control" id="input-serie" name="input-serie" placeholder="Serie" maxlength="4">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="serie">Monto Aprobado</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" step="0.1" class="form-control" id="input-serie" name="input-serie" placeholder="Serie" maxlength="4">
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
                                                        <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                                    </div><!--end modal-footer-->
                                            </form><!--end form-->
                                        </div><!--end modal-body-->
                                    </div><!--end modal-content-->
                                </div><!--end modal-dialog-->
                            </div><!--end task-box-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pagos del servicio</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Item</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Destino</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $arrayPagos = $Pago->verFilas();
                                    $item = 1;
                                    foreach ($arrayPagos as $fila) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $item ?></th>
                                            <td><?php echo $Util->fecha_mysql_web($fila['fecha_pago']) ?></td>
                                            <td><?php echo number_format($fila['monto']) ?></td>
                                            <td>EFECTIVO</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm"><i class="ti ti-trash"></i></button>
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
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Comprobante de Venta Emitido</h4>
                            </div>
                            <div class="card-body">

                            </div><!--end /tableresponsive-->
                        </div><!--end card-body-->
                    </div><!--end card-->
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
