<?php
require '../../models/ParametroValor.php';
$Parametro = new ParametroValor();
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
                                <h4 class="page-title">Registrar Usuario</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Configuracion</a></li>
                                    <li class="breadcrumb-item active">Usuario</li>
                                </ol>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Añadir Items </h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="apellidosynombres">Descripcion del Servicio</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="usuario">Unidad Medida</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <?php
                                                $Parametro->setParametroId(6);
                                                $array_medidas = $Parametro->verFilas();
                                                foreach ($array_medidas as $fila) {
                                                    echo '<option value="' . $fila['id'] . '">' . $fila['descripcion'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputPassword1">Precio Unit c/IGV</label>
                                            <input type="number" class="form-control text-right" id="exampleInputPassword1"
                                                   placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputPassword1">Precio Unit s/IGV</label>
                                            <input type="number" class="form-control text-right" id="exampleInputPassword1"
                                                   placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!--end card-body-->
                        <div class="card-footer">
                            <div class="col-auto align-self-center">
                                <a href="#" class="btn btn-sm btn-soft-primary">
                                    <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                    Agregar Servicio a la lista
                                </a>
                            </div><!--end col-->
                        </div>
                    </div><!--end card-->

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lista de Servicios del Comprobante</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Servicio</th>
                                    <th>Und. Med</th>
                                    <th>P.Unit. +IGV</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>ALQUILER DE CAMION GRUA PARA TRASLADO DE TANQUE DE FIERRO DE 2TON DESDE COISHCO HASTA AV PARDO</td>
                                    <td class="text-center">SERVICIO</td>
                                    <td class="text-end">250.00</td>
                                    <td class="text-end">
                                        <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                        <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end card-body-->
                    </div>

                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detalle del Comprobante de Venta</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label" for="apellidosynombres">Fecha Comprobante</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <label class="form-label" for="usuario">Tipo Comprobante</label>
                                            <select class="form-control">
                                                <option value="1">BOLETA</option>
                                                <option value="2">FACTURA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputPassword1">Buscar Cliente</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                   placeholder="Escriba razon social o ruc">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputPassword1">Nro Documento Cliente</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="exampleInputPassword1"
                                                       placeholder="ingrese DNI o RUC" maxlength="11">
                                                <button class="btn btn-secondary" type="button">Buscar Datos</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="usuario">Tipo Detraccion</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <?php
                                                $Parametro->setParametroId(7);
                                                $array_medidas = $Parametro->verFilas();
                                                foreach ($array_medidas as $fila) {
                                                    echo '<option value="' . $fila['id'] . '">' . $fila['descripcion'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="usuario">Forma de Pago</label>
                                            <div class="input-group">
                                                <select class="form-control" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                    <option value="1">CONTADO</option>
                                                    <option value="2">CREDITO</option>
                                                </select>
                                                <button class="btn btn-secondary" type="button">Agregar Cuotas</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!--end card-body-->
                        <div class="card-footer">
                            <div class="col-auto align-self-center">
                                <a href="#" class="btn btn-sm btn-soft-primary">
                                    <i data-feather="save" class="fas fa-save mr-2"></i>
                                    Generar Comprobante
                                </a>
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


<!-- App js -->
<script src="../assets/js/app.js"></script>

</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
