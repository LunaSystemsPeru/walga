<?php
require_once '../fixed/cargarSession.php';
require '../../models/Venta.php';
require '../../models/VentaSunat.php';

$Venta = new Venta();
$Hash = new VentaSunat();

$Venta->setId(filter_input(INPUT_GET, 'id'));
if (!$Venta->getId()) {
    //header("Location: lista-ventas.php");
}
$Hash->setVentaid($Venta->getId());
$Hash->obtenerDatos();
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
                                <h4 class="page-title">Visualizar PDF</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Facturacion</a></li>
                                    <li class="breadcrumb-item active">Visualizar</li>
                                </ol>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row ">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h6 class="text-white">Comprobante generado correctamente</h6>
                        </div>
                        <div class="card-body">
                            <embed src="../../reports/comprobante_venta_a4.php?id=<?php echo $Venta->getId() ?>" class="col-12 h-100 min-vh-100" >
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <p>Hash Generado: <?php echo $Hash->getHash()?></p>
                            <p>Nombre XML: <?php echo $Hash->getNombre()?></p>
                            <p>Enviado a SUNAT: <label class="badge badge-warning">NO</label></p>
                            <a href="../../public/xml/<?php echo $Hash->getNombre() ?>.xml" class="btn btn-info"><i class="ti ti-zip"></i> Descargar XML</a>
                        </div>
                        <div class="card-body">
                            <a href="lista-ventas.php" class="btn btn-primary"><i class="ti ti-arrow-left"></i> Regresar</a>
                        </div>
                    </div>

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
<script>
    function eliminarServicio(id) {
        if (confirm('Esta seguro de eliminar este servicio?')) {
            window.location.href = '../controller/elimina-servicio.php?contratoid=' + id;
        } else {
            alert("Cancelado")
        }
    }

    function eliminarPago(id) {
        if (confirm('Esta seguro de eliminar este pago?')) {
            window.location.href = '../controller/elimina-pago-contrato.php?pagoid=' + id;
        } else {
            alert("Cancelado")
        }
    }
</script>

</body>
<!-- Mirrored from mannatthemes.com/dastone/default/horizontal-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 20:35:01 GMT -->
</html>
