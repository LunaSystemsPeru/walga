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

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all"/>

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
                                            <label class="form-label" for="input-descripcion">Descripcion del Servicio</label>
                                            <textarea class="form-control" rows="3" id="input-descripcion"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="select-unidad">Unidad Medida</label>
                                            <select class="form-control" aria-label="Default select example" id="select-unidad">
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
                                            <label class="form-label" for="input-precio-sinigv">Precio Unit s/IGV</label>
                                            <input type="number" class="form-control text-right" id="input-precio-sinigv"
                                                   placeholder="0.00" onkeyup="obtenerTotal()">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="input-precio-total">Precio Unit c/IGV</label>
                                            <input type="number" class="form-control text-right" id="input-precio-total"
                                                   placeholder="0.00" onkeyup="obtenerBase()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!--end card-body-->
                        <div class="card-footer">
                            <div class="col-auto align-self-center">
                                <button onclick="agregarServicio()" class="btn btn-sm btn-soft-primary">
                                    <i data-feather="plus" class="fas fa-plus mr-2"></i>
                                    Agregar Servicio a la lista
                                </button>
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
                                <tbody id="contenido-detalle">
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
                                            <label class="form-label" for="input-fecha">Fecha Comprobante</label>
                                            <input type="date" class="form-control" id="input-fecha" value="<?php echo date("Y-m-d") ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <label class="form-label" for="select-comprobante">Tipo Comprobante</label>
                                            <select class="form-control" id="select-comprobante">
                                                <option value="1">BOLETA</option>
                                                <option value="2">FACTURA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="input_datos_cliente">Buscar Cliente</label>
                                            <input type="text" class="form-control" id="input_datos_cliente"
                                                   placeholder="Escriba razon social o ruc">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="input_documento_cliente">Nro Documento Cliente</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="input_documento_cliente"
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

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
        integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY="
        crossorigin="anonymous"></script>

<!-- App js -->
<script src="../assets/js/app.js"></script>
<script>
    var arrayservicios = new Array();

    //buscar clientes
    $("#input_datos_cliente").autocomplete({
        source: "../../inputAjax/obtenerJsonEntidades.php",
        minLength: 3,
        select: function (event, ui) {
            event.preventDefault();
            $("#input_datos_cliente").val(ui.item.razonsocial);
            $("#input_emisor_id").val(ui.item.id);
            $("#input_documento_cliente").val(ui.item.documento);
            $("#input_documento_cliente").focus();
        }
    });

    //calcular monto sin igv
    function obtenerBase() {
        var montoTotal = $("#input-precio-total").val();
        var montoBase = montoTotal / 1.18;
        $("#input-precio-sinigv").val(montoBase.toFixed(2))
    }

    //calcular monto total
    function obtenerTotal() {
        var montoBase = $("#input-precio-sinigv").val();
        var montoTotal = montoBase * 1.18;
        $("#input-precio-total").val(montoTotal.toFixed(2))
    }

    //añadir servicio a un array
    function agregarServicio() {
        var item = (arrayservicios.length + 1);
        var descripcion = $("#input-descripcion").val();
        var preciototal = $("#input-precio-total").val();
        var unidadid = $("#select-unidad").val();
        var unidad_nombre = $("#select-unidad").find('option:selected').text();

        if (descripcion.length < 10) {
            alert("Falta descripcion del servicio")
            return false;
        }

        if (preciototal < 1) {
            alert("No ha especificado precio del servicio")
            return false
        }

        // se cargam los items en el array
        arrayservicios.push({"id": item, "descripcion": descripcion, "precio": preciototal, "unidadid": unidadid, "unidadnombre": unidad_nombre})
        mostrarItems()
        limpiarCampos()
    }

    function eliminarItem(item) {
        arrayservicios.forEach(function (car, index, object) {
            if (car.id == item) {
                object.splice(index, 1);
            }
        });

        mostrarItems();
    }

    function mostrarItems() {
        $("#contenido-detalle").html("");
        totalproductos = 0;
        var items = 1;
        for (var i = 0; i < arrayservicios.length; i++) {
            var totalitem = parseFloat(arrayservicios[i].precio);
            totalproductos += (arrayservicios[i].precio);

            $("#contenido-detalle").append('<tr>' +
                '<td class="text-center">' + items + '</td>' +
                '<td>' + arrayservicios[i].descripcion + '</td>' +
                '<td class="text-center">' + arrayservicios[i].unidadnombre + '</td>' +
                '<td class="text-end">'+ totalitem.toFixed(2) +'</td>' +
                '<td class="text-end">' +
                '<a href="#"><i class="las la-pen text-secondary font-16"></i></a>' +
                '<a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>' +
                '</td>' +
                '</tr>');

            items++;
        }

    }

    function limpiarCampos() {
        $("#input-descripcion").val("");
        $("#input-precio-total").val("");
        $("#input-precio-sinigv").val("");
        $("#input-descripcion").focus()
    }

    function validarDocumentoComprobante () {
        //SI ES RUC EL NRO DE DOCUMENTO NO DEBE SER DE 8 DIGITOS SOLO 11;
        var comprobanteid = $("#select-comprobante").val()
        var nrodocumento = $("#input_documento_cliente").val()
        if (nrodocumento.length != 11) {
            alert("Para emitir una factura debe ser un RUC")
            return false
        }
    }


</script>
</body>


<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
