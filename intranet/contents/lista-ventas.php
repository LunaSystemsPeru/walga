<?php
require '../fixed/cargarSession.php';
require '../../models/Venta.php';
require '../../tools/Util.php';

$Venta = new Venta();
$Util = new Util();

$Venta->setEmpresaid($_SESSION['empresa_id']);

$fechainicio = filter_input(INPUT_GET, 'fecha_inicio');
$fechafin = filter_input(INPUT_GET, 'fecha_final');
if ($fechainicio) {
    $array_ventas = $Venta->verVentasEntreFechas($fechainicio, $fechafin);
} else {
    $array_ventas = $Venta->verVentasdelMes();
}

$fecha_actual = date("Y-m-d");
$fecha_minima = date("Y-m-d", strtotime($fecha_actual . "- 6 days"));
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
                                <h4 class="page-title">Comprobantes de Ventas del mes</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ventas</a></li>
                                    <li class="breadcrumb-item active">Facturacion</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">

                                <a href="form-venta.php" class="btn btn-sm btn-soft-primary">
                                    <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                    Agregar Comprobante BOL/FAC
                                </a>
                                <a href="form-nota.php" class="btn btn-sm btn-soft-primary">
                                    <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                    Agregar Nota DEB/CRE
                                </a>

                                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#exampleModalSignup">
                                    <i data-feather="search" class="align-self-center icon-xs"></i> buscar x Fechas
                                </button>

                            </div><!--end col-->
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
                                        <th>Fecha</th>
                                        <th>Nro Documento</th>
                                        <th>Cliente</th>
                                        <th>Monto</th>
                                        <th>Estado Doc</th>
                                        <th>Enviado SUNAT</th>
                                        <th>PDF</th>
                                        <th>XML</th>
                                        <th>Emitido por</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($array_ventas as $fila) {
                                        $fechafactura = $fila['fecha'];

                                        $a = strtotime($fecha_minima);
                                        $b = strtotime($fechafactura);

                                        $label_estado = '<span class="badge badge-boxed  badge-outline-success">Activo</span>';
                                        if ($fila['estado'] == 2) {
                                            $label_estado = '<span class="badge badge-boxed  badge-outline-danger">Anulado</span>';
                                        }

                                        $label_enviado = '<span class="badge badge-boxed  badge-outline-success">SI</span>';
                                        if ($fila['enviado_sunat'] == 0) {
                                            if ($fila['comprobante_id'] == 4) {
                                                $label_enviado = '<span class="badge badge-boxed  badge-outline-danger">NO</span> ' .
                                                    '<button class="btn btn-sm btn-success"><i class="fa fa-paper-plane" title="Enviar Documento"></i></button>';
                                            }

                                            if ($fila['comprobante_id'] == 3) {
                                                $label_enviado = '<span class="badge badge-boxed  badge-outline-danger">NO</span>';
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><?php echo $Util->fecha_mysql_web($fila['fecha']) ?></td>
                                            <td><?php echo $fila['valor1'] . " | " . $fila['serie'] . "-" . $Util->zerofill($fila['numero'], 5) ?></td>
                                            <td><?php echo $fila['documento'] . " | " . $fila['razonsocial'] ?></td>
                                            <td><?php echo number_format($fila['total'], 2) ?></td>
                                            <td><?php echo $label_estado ?></td>
                                            <td><?php echo $label_enviado ?></td>
                                            <td><a href="<?php echo 'reporte-documento-venta.php?ventaid=' . $fila['id'] ?>" class="btn btn-info btn-sm"><i class="fa fa-file-pdf"></i></a></td>
                                            <td><a href="<?php echo '../../public/xml/' . $fila['nombre_documento'] . '.xml' ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-file-archive"></i></a></td>
                                            <td><?php echo $fila['username'] ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Enviar comprobante por correo"><i class="ti ti-email"></i></button>
                                                <?php
                                                //si esta dentro de los 4 dias anular
                                                if ($b >= $a) {
                                                    ?>
                                                    <button class="btn btn-danger btn-sm" title="Dar de baja el comprobante"><i class="ti ti-trash"></i></button>
                                                    <?php
                                                } else {
                                                    //sino emitir nota de credito
                                                }
                                                ?>

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
        </div><!-- container -->
    </div>
    <!-- end page content -->

    <div class="modal fade" id="exampleModalSignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Buscar Servicios entre Fechas</h6>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <form class="form-horizontal auth-form" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Fecha Inicio</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha-inicio" name="fecha_inicio">
                            </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                            <label class="form-label" for="input-documento">Fecha Final</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha-final" name="fecha_final">
                            </div>
                        </div><!--end form-group-->
                    </div><!--end auth-page-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-soft-primary btn-sm">Buscar</button>
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
