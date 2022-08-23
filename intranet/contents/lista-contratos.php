<?php
/*
error_reporting(-1);
error_reporting(0);
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
*/
include '../fixed/cargarSession.php';
require '../../models/Contrato.php';

$Contrato = new Contrato();
$Contrato->setFecha(date("Y-m-d"));

$array_contratos = array();
if (filter_input(INPUT_GET, 'fecha_inicio')) {
    $fechainicio = filter_input(INPUT_GET, 'fecha_inicio');
    $fechafin = filter_input(INPUT_GET, 'fecha_final');
    $array_contratos = $Contrato->verContratosxFecha($fechainicio, $fechafin);
} else {
    $array_contratos = $Contrato->verContratosdelDia();
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
                                <h4 class="page-title">Contratos</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Servicios</a></li>
                                    <li class="breadcrumb-item active">Contratos</li>
                                </ol>
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#exampleModalSignup">
                                    <i data-feather="search" class="align-self-center icon-xs"></i> buscar x Fechas
                                </button>
                                <!--<a href="form-contrato.php" class="btn btn-sm btn-outline-primary">
                                    <i data-feather="plus" class="align-self-center icon-xs"></i> Agregar Nuevo Contrato
                                </a>-->
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
                                        <th width="10%">Fecha</th>
                                        <th>Vehiculo</th>
                                        <th>Servicio</th>
                                        <th>Cliente</th>
                                        <th>Comprobante?</th>
                                        <th>Emitido?</th>
                                        <th>Monto Aprobado</th>
                                        <th>Deuda</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $item = 1;
                                    foreach ($array_contratos as $fila) {
                                        $iestado = $fila['estado_contrato'];
                                        $label_estado = "";
                                        $monto = $fila['monto'];
                                        if ($fila['incluye_igv'] == 1) {
                                          //  $monto = $fila['monto'] * 1.18;
                                        }
                                        $deuda = $monto - $fila['monto_pagado'];
                                        if ($iestado == 0) {
                                            $label_estado = '<span class="badge badge-boxed  badge-outline-warning">Programado</span>';
                                        }
                                        if ($iestado == 1) {
                                            $label_estado = '<span class="badge badge-boxed  badge-outline-info">en Proceso</span>';
                                        }
                                        if ($iestado == 2) {
                                            $label_estado = '<span class="badge badge-boxed  badge-outline-dark">Finalizado</span>';
                                        }
                                        $botoncomprobante = '<i data-feather="check"></i>';
                                        if ($fila['comprobante_id'] == 11) {
                                            $botoncomprobante = '<i data-feather="check"></i>';
                                        } else {
                                            if ($fila['estado_comprobante'] == 0) {
                                                $botoncomprobante = '<a href="form-venta.php?contratoid=' . $fila['id'] . '" type="button" class="btn btn-info btn-sm"><i class="ti ti-plus"></i></a>';
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $item ?></th>
                                            <td class="text-center"><?php echo $fila['fecha'] ?></td>
                                            <td class="text-center"><?php echo $fila['placa'] ?></td>
                                            <td><?php echo strtoupper($fila['tiposervicio'] . " | O. " . $fila['origen'] . " - D. " . $fila['destino'] . " | " . $fila['servicio']) ?></td>
                                            <td><?php echo $fila['datos'] ?></td>
                                            <td class="text-center"><span class="badge badge-boxed  badge-outline-success"><?php echo ucwords(strtolower($fila['comprobante'])) ?></span></td>
                                            <td class="text-center"><?php echo $botoncomprobante ?></td>
                                            <td class="text-right"><?php echo number_format($monto, 2) ?></td>
                                            <td class="text-right"><?php echo number_format($deuda) ?></td>
                                            <td class="text-center"><?php echo $label_estado ?></td>
                                            <td class="text-center">
                                                <a href="detalle-contrato.php?id=<?php echo $fila['id'] ?>" class="btn btn-info btn-sm"><i class="ti ti-eye"></i></a>
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
            </div><!-- row -->
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
                <form class="form-horizontal auth-form" action="lista-contratos.php" method="get">
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
                                <input type="date" class="form-control" id="fecha-final" name="fecha_final" value="<?php echo date("Y-m-d")?>">
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

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
