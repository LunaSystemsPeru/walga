<?php
require '../../models/Contrato.php';
require '../../models/Cliente.php';
require '../../models/Entidad.php';
require '../../models/ParametroValor.php';

$Contrato = new Contrato();
$Cliente = new Cliente();
$Entidad = new Entidad();
$Valor = new ParametroValor();

$Contrato->setId(filter_input(INPUT_GET, 'id'));
if ($Contrato->getId()) {
    $Contrato->obtenerDatos();
    $Cliente->setId($Contrato->getClienteid());
    $Cliente->obtenerDatos();
    $Entidad->setId($Cliente->getEntidadId());
    $Entidad->obtenerDatos();
    $Valor->setId($Contrato->getTiposervicioid());
    $Valor->obtenerDatos();
} else {
    header("Location: contratos.php");
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>Walga Transportes | Alquiler de Gruas y Logistica</title>
    <link rel="stylesheet" href="../vendor/swiper/swiper.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>
<body>

<!-- Overlay panel -->
<div class="body-overlay"></div>
<!-- Left panel -->
<div id="panel-left"></div>
<!-- Right panel -->
<div id="panel-right"></div>


<div class="page page--main" data-page="main">

    <!-- HEADER -->
    <header class="header header--page header--fixed">
        <div class="header__inner">
            <div class="header__icon header__icon--menu open-panel" data-panel="left"><span></span><span></span><span></span><span></span><span></span><span></span></a></div>
            <div class="header__logo header__logo--text"><a href="#">Walga<strong>Transportes</strong></a></div>
        </div>
    </header>


    <!-- PAGE CONTENT -->
    <div class="page__content page__content--with-header">
        <h2 class="page__title">Cierre de Contrato</h2>
        <div class="fieldset">
            <div class="form">
                <form id="Form" method="post" action="../controller/acepta-contrato.php">
                    <div class="form__row">
                        <label class="form__label">fecha</label>
                        <input type="date" name="input-fecha" placeholder="Buscar Cliente" value="<?php echo $Contrato->getFecha() ?>" class="form__input"/>
                        <input type="hidden" name="input-id-contrato" value="<?php echo $Contrato->getId() ?>">
                    </div>
                    <div class="form__row">
                        <label class="form__label">Cliente</label>
                        <input type="text" name="input-cliente" placeholder="Buscar Cliente" value="<?php echo $Cliente->getDatos() ?>" class="form__input " readonly/>
                        <input type="hidden" value="<?php echo $Entidad->getNrodocumento() . " | " . $Entidad->getRazonsocial() ?>" id="input-datos-facturacion">
                    </div>
                    <?php
                    $disabled = "";
                    if ($Contrato->getClienteid() == 0) {
                        $disabled = 'disabled';
                    } else {
                        $disabled = "";
                    }
                    ?>
                    <div class="form__row">
                        <label class="form__label">Desea Comprobante?</label>
                        <div class="form__select">
                            <select name="select-comprobante" id="select-comprobante" class="required" onchange="preguntarComprobante()" <?php echo $disabled ?>>
                                <option value="0">No</option>
                                <option value="4">Factura</option>
                            </select>
                        </div>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Aumentar IGV?</label>
                        <div class="form__select">
                            <select name="select-incluido" id="select-incluido" onchange="incluyeIGV()" <?php echo $disabled ?> >
                                <option value="0">NO</option>
                                <option value="1">SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form__row">
                        <label class="form__label">RUC a facturar</label>
                        <input type="text" name="input-datos-factura" id="input-datos-factura" placeholder="" value="" class="form__input required" readonly/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Servicio</label>
                        <textarea name="txt_servicio" class="form__textarea"><?php echo strtoupper($Valor->getDescripcion() . " | " . $Contrato->getServicio() . " - desde: " . $Contrato->getOrigen() . " hasta: " . $Contrato->getDestino()) ?></textarea>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Monto Pactado</label>
                        <input type="text" name="input-monto" id="input-monto" value="<?php echo $Contrato->getMontocontrato() ?>" class="form__input " readonly/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Adelanto</label>
                        <input type="number" name="input-pago" placeholder="ingrese monto adelanto sino 0" value="" class="form__input required" required/>
                    </div>
                    <hr>
                    <div class="form__row">
                        <label class="form__label">Hora Inicio</label>
                        <input type="time" name="input-hora" placeholder="0.00" value="" class="form__input required" required/>
                    </div>
                    <div class="form__row mt-40">
                        <input type="submit" name="submit" class="form__submit button button--main button--full" id="submit" value="Guardar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- PAGE END -->

<!-- Bottom navigation -->
<!--<div id="bottom-toolbar" class="bottom-toolbar"></div>-->

<!-- Social Icons Popup -->
<div id="popup-social"></div>

<!-- Alert -->
<div id="popup-alert"></div>

<!-- Notifications -->
<div id="popup-notifications"></div>

<script src="../vendor/jquery/jquery-3.5.1.min.js"></script>
<script src="../vendor/jquery/jquery.validate.min.js"></script>
<script src="../vendor/swiper/swiper.min.js"></script>
<script src="../assets/js/jquery.custom.js"></script>
<script>
    function preguntarComprobante() {
        var idopcion = $("#select-comprobante").val();
        var nrodocumento = $("#input-datos-facturacion").val();
        if (idopcion == "4") {
            $("#input-datos-factura").val(nrodocumento);
            $("#select-incluido").prop("disabled", false);
        } else {
            $("#input-datos-factura").val("");
            $("#select-incluido").prop("disabled", true);
            $("#select-incluido").val(0)
        }
    }

    function incluyeIGV() {
        var monto = <?php echo $Contrato->getMontocontrato()?>;
        var selectcincluye = $("#select-incluido").val()
        if (selectcincluye == 0) {
            $("#input-monto").val(monto.toFixed(2));
        } else {
            $("#input-monto").val((monto * 1.18).toFixed(2));
        }
    }
</script>
</body>
</html>