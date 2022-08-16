<?php
include_once '../fixed/cargarSession.php';
require '../../models/VehiculoGasto.php';
require '../../models/Vehiculo.php';

$Vehiculo = new Vehiculo();
$Gasto = new VehiculoGasto();

$Vehiculo->setEmpresaid($_SESSION['empresa_id']);

$inicio = date("Y-m-d");
$fin = date("Y-m-d");
$placa = '';
if (filter_input(INPUT_GET, 'fecha_inicio')) {
    $inicio = filter_input(INPUT_GET, 'fecha_inicio');
    $fin = filter_input(INPUT_GET, 'fecha_final');
    $placa = filter_input(INPUT_GET, 'placa');
    $Gasto->setVehiculoid(filter_input(INPUT_GET, 'placa'));
    $Vehiculo->setId($Gasto->getVehiculoid());
    $Vehiculo->obtenerDatos();
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
                                <h4 class="page-title">Reporte de Dinero </h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Servicios</a></li>
                                    <li class="breadcrumb-item active">Gastos</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                                <button data-toggle="modal" data-target="#buscarFechas" class="btn btn-sm btn-soft-primary">
                                    <i data-feather="search" class="fas fa-plus mr-2"></i>
                                    Buscar Fechas
                                </button>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Vehiculo</th>
                                        <th>Descripcion</th>
                                        <th>Ingreso Efectivo</th>
                                        <th>Gasto Efectivo</th>
                                        <th>Saldo</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $arrayGastos = $Gasto->verGastos($inicio, $fin);
                                    $item = 1;
                                    $saldo = 0;
                                    $ingresos = 0;
                                    $egresos = 0;
                                    foreach ($arrayGastos as $fila) {
                                        $saldo = $saldo + $fila['ingreso'] - $fila['monto'];
                                        $ingresos = $ingresos + $fila['ingreso'];
                                        $egresos = $egresos - $fila['monto'];
                                        $valoringreso = $fila['ingreso'];
                                        $valoregreso = $fila['monto'];
                                        if ($valoregreso< 0) {
                                            $valoringreso = $valoregreso * -1;
                                            $valoregreso = 0;
                                        }
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $item ?></th>
                                            <td><?php echo $fila['fecha'] ?></td>
                                            <td><?php echo $fila['placa'] ?></td>
                                            <td><?php echo $fila['descripcion'] ?></td>
                                            <td class="text-right"><?php echo($valoringreso != 0 ? number_format($valoringreso, 2) : "") ?></td>
                                            <td class="text-right"><?php echo($valoregreso != 0 ? number_format($valoregreso, 2) : "") ?></td>
                                            <td class="text-right"><?php echo number_format($saldo, 2) ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                        $item++;
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td scope="row" colspan="4" class="text-right">Total</td>
                                        <td class="text-right"><?php echo number_format($ingresos, 2) ?></td>
                                        <td class="text-right"><?php echo number_format($egresos, 2) ?></td>
                                        <td class="text-right"></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                    <div class="card">
                        <div class="card-footer">
                            <div class="button-items">
                                <?php
                                if ($placa && $placa != "0") {
                                    ?>
                                    <button data-toggle="modal" data-target="#cuadrarDinero" class="btn btn-sm btn-soft-primary">
                                        <i data-feather="dollar-sign" class=" mr-2"></i>
                                        Cuadrar Dinero
                                    </button>
                                    <?php
                                }
                                if ($placa == "0") {
                                    ?>
                                    <button data-toggle="modal" data-target="#agregargasto" class="btn btn-sm btn-soft-success">
                                        <i data-feather="save" class=" mr-2"></i>
                                        Agregar Gasto
                                    </button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div><!-- container -->
    </div>
    <!-- end page content -->

    <div class="modal fade" id="buscarFechas" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Buscar Gastos entre Fechas</h6>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <form class="form-horizontal auth-form" action="lista-gastos.php" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Vehiculo</label>
                            <div class="input-group">
                                <select class="form-control" name="placa">
                                    <?php
                                    $aplacas = $Vehiculo->verFilas();
                                    foreach ($aplacas as $fila) {
                                        echo "<option value='" . $fila['id'] . "'>" . $fila['placa'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Fecha Inicio</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha-inicio" name="fecha_inicio" value="<?php echo date("Y-m-d") ?>" required>
                            </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Fecha Final</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha-final" name="fecha_final" value="<?php echo date("Y-m-d") ?>" required>
                            </div>
                        </div><!--end form-group-->
                    </div><!--end auth-page-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-soft-primary btn-sm"><i class="fa fa-search "></i> Buscar</button>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div><!--end modal-footer-->
                </form><!--end form-->
            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->

    <div class="modal fade" id="cuadrarDinero" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Cerrar Caja</h6>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <form class="form-horizontal auth-form" action="../controller/cerrarcaja.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Vehiculo</label>
                            <div class="input-group">
                                <input type="text" value="<?php echo $Vehiculo->getPlaca() ?>" class="form-control">
                                <input value="<?php echo $Gasto->getVehiculoid()?>" type="hidden" name="input-vehiculo">
                            </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Fecha</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha-cierre" name="fecha-cierre" value="<?php echo date("Y-m-d") ?>" required>
                            </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Monto</label>
                            <div class="input-group">
                                <input type="number" step="0.1" class="form-control" id="monto-cierre" name="monto-cierre" value="" required>
                            </div>
                        </div><!--end form-group-->
                    </div><!--end auth-page-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-soft-primary btn-sm"><i class="fa fa-save "></i> Grabar</button>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div><!--end modal-footer-->
                </form><!--end form-->
            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->

    <div class="modal fade" id="agregargasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLogin">nuevo Gasto</h6>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <form class="form-horizontal auth-form" action="../controller/registra-gasto.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Fecha</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha-cierre" name="fecha-cierre" value="<?php echo date("Y-m-d") ?>" required>
                            </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Motivo</label>
                            <div class="input-group">
                                <select></select>
                            </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Monto</label>
                            <div class="input-group">
                                <input type="number" step="0.1" class="form-control" id="monto-cierre" name="monto-cierre" value="" required>
                            </div>
                        </div><!--end form-group-->
                    </div><!--end auth-page-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-soft-primary btn-sm"><i class="fa fa-save "></i> Grabar</button>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div><!--end modal-footer-->
                </form><!--end form-->
            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
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

<script>
    function abrirModal() {
        $("#bd-example-modal-xl").modal("toggle");
    }
</script>

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
