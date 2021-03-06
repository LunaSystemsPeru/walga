<?php
require '../fixed/cargarSession.php';
require '../../models/Venta.php';
require '../../tools/Util.php';

$Venta = new Venta();
$Util = new Util();

$Venta->setEmpresaid($_SESSION['empresa_id']);
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
                                $array_ventas = $Venta->verVentasdelMes();
                                foreach ($array_ventas as $fila) {
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
                                        <td><a href="" class="btn btn-info btn-sm"><i class="fa fa-file-pdf"></i></a></td>
                                        <td><a href="" class="btn btn-danger btn-sm"><i class="fa fa-file-archive"></i></a></td>
                                        <td><?php echo $fila['username'] ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
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
