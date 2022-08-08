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
                    <input type="number" step="1" name="input-monto" id="input-monto" value="<?php echo ($Contrato->getMontocontrato() > 0 ? $Contrato->getMontocontrato() : "") ?>" class="form__input text-right required" required/>
                </div>
                <div class="form__row">
                    <div class="switch">
                        <label>Desea Factura?:</label>
                        <input type="checkbox" hidden="hidden" id="activa-factura" onchange="preguntarComprobante()">
                        <label class="switch__label" for="activa-factura"></label>
                    </div>
                </div>
                <div class="form__row">
                    <div class="switch">
                        <label>Aumentar IGV?:</label>
                        <input type="checkbox" hidden="hidden" id="aumenta-monto" onchange="aumentarIGV()" disabled>
                        <label class="switch__label" for="aumenta-monto"></label>
                    </div>
                </div>
                <h3 id="monto-factura"> Monto a Facturar: S/ <?php echo $Contrato->getMontocontrato() ?></h3>
                <hr>
                <div class="form__row">
                    <div class="switch">
                        <label>Pago Completo?:</label>
                        <input type="checkbox" hidden="hidden" id="pago-completo" onchange="especificarPago()">
                        <label class="switch__label" for="pago-completo"></label>
                    </div>
                </div>
                <div class="form__row">
                    <label class="form__label">Pago Final</label>
                    <input type="number" step="0.1" name="input-pago-final" id="input-pago-final" placeholder="ingrese pago restante sino 0" value="" class="form__input text-right required" required/>
                </div>
                <div class="form__row mt-40">
                    <input type="hidden" name="input-masigv" value="0" id="input-masigv" >
                    <input type="hidden" name="input-quierefactura" value="0" id="input-quierefactura" >
                    <input type="hidden" name="input-id-contrato" value="<?php echo $Contrato->getId()?>" >
                    <input type="submit" name="submit" class="form__submit button button--main button--full" id="submit" value="Finalizar"/>
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
        var checkfactura = document.getElementById("activa-factura").checked;
        if (checkfactura) {
            $("#aumenta-monto").prop("disabled", false)
            $("#submit").prop("value", "Escribir RUC");
            $("#input-quierefactura").val(1)
        } else {
            $("#aumenta-monto").prop("disabled", true)
            $("#submit").prop("value", "Finalizar");
            $("#input-quierefactura").val(0)
        }
        $("#aumenta-monto").prop("checked", false);
        aumentarIGV();
    }

    function aumentarIGV() {
        var checkigv = document.getElementById("aumenta-monto").checked;
        var montocontrato = document.getElementById("input-monto").value;
        var igv = montocontrato * 1.18;
        if (checkigv) {
            $("#monto-factura").html("Monto a Facturar: S/ " + igv.toFixed(2))
            $("#input-masigv").val(1)
        } else {
            $("#monto-factura").html("Monto a Facturar: S/ " + parseFloat(montocontrato).toFixed(2))
            $("#input-masigv").val(0)
        }
    }

    function especificarPago () {
        var opcionpago = document.getElementById("pago-completo").checked;
        var montocontrato = document.getElementById("input-monto").value;
        var montofinal = 0;
        var checkigv = document.getElementById("aumenta-monto").checked;
        if (checkigv) {
            montofinal = montocontrato * 1.18;
        } else {
            montofinal = montocontrato;
        }
        montofinal = parseFloat(montofinal).toFixed(2)
        if (opcionpago) {
            //llenar auto
            $("#input-pago-final").val(montofinal)
        } else {
            //colocar fous en inut y limpiar
            $("#input-pago-final").val("")
            $("#input-pago-final").focus()
        }
    }

    function enviar() {
        alert("enviado")
        $("#submit").prop("disabled", true);
    }
</script>
</body>
</html>