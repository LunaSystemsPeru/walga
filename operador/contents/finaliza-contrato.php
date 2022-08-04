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
        <h2 class="page__title">Cierre de Contrato - Servicio</h2>
        <div class="form">
            <p class="form__label"> Fecha: <?php echo $Contrato->getFecha() ?></p>
            <p class="form__label"> Servicio: <?php echo strtoupper($Valor->getDescripcion() . " | " . $Contrato->getServicio() . " - desde: " . $Contrato->getOrigen() . " hasta: " . $Contrato->getDestino()) ?></p>

            <form id="FormFinalizar" method="post" action="../controller/finaliza-contrato.php">
                    <div class="form__row">
                        <label class="form__label">Hora Fin</label>
                        <input type="time" name="input-hora" placeholder="00:00" value="" class="form__input required" required/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Monto Pactado</label>
                        <input type="text" name="input-monto" value="<?php echo $Contrato->getMontocontrato() ?>" class="form__input text-right required" required/>
                    </div>
                <div class="form__row">
                    <label class="form__label">Pago Final</label>
                    <input type="number" name="input-pago-final" placeholder="ingrese pago restante sino 0" value="" class="form__input text-right required" required/>
                </div>
                <div class="form__row">
                    <div class="switch">
                        <label>Desea Factura?:</label>
                        <input type="checkbox" hidden="hidden" id="enable">
                        <label class="switch__label" for="enable"></label>
                    </div>
                </div>
                <div class="form__row mt-40">
                    <input type="submit" name="submit" class="form__submit button button--main button--full" id="submit" value="Guardar"/>
                </div>
            </form>
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
        } else {
            $("#input-datos-factura").val("");
        }
    }

    function enviar() {
        alert("enviado")
        $("#submit").prop("disabled", true);
    }
</script>
</body>
</html>