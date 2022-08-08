<?php
require '../../models/Contrato.php';
require '../../models/Cliente.php';
require '../../models/ParametroValor.php';

$Contrato = new Contrato();
$Cliente = new Cliente();
$Valor = new ParametroValor();

$Contrato->setId(filter_input(INPUT_GET, 'contrato'));
if ($Contrato->getId()) {
    $Contrato->obtenerDatos();
    $Cliente->setId($Contrato->getClienteid());
    $Cliente->obtenerDatos();
    $Valor->setId($Contrato->getTiposervicioid());
    $Valor->obtenerDatos();
} else {
    header("Location: contratos.php");
}

if ($Contrato->getIncluyeigv() == 1) {
    $Contrato->setMontocontrato($Contrato->getMontocontrato() * 1.18);
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
        <h2 class="page__title">Datos para Facturacion del Servicio</h2>
        <div class="form">
            <p class="form__label"> Fecha: <?php echo $Contrato->getFecha() ?></p>
            <p class="form__label"> Servicio: <?php echo strtoupper($Valor->getDescripcion() . " | " . $Contrato->getServicio()) ?></p>
            <p class="form__label"> Monto a Facturar: S/ <?php echo $Contrato->getMontocontrato() ?></p>
            <form id="FormFinalizar" method="post" action="../controller/factura-contrato.php">
                <div class="form__row">
                    <label class="form__label">seleccionar Cliente</label>
                    <div class="form__select">
                        <select name="input-cliente" id="input-cliente" class="required" onchange="obtenerDatos()">
                            <option value="0">NUEVO CLIENTE</option>
                            <?php
                            $array_clientes = $Cliente->verFilas();
                            foreach ($array_clientes as $fila) {
                                echo ' <option value="' . $fila['id'] . '">' . $fila['datos'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form__row">
                    <label class="form__label">Apellidos y Nombres</label>
                    <input type="text" name="input-datos"  id="input-datos" placeholder="Datos de Contacto del Cliente" value="" class="form__input" required/>
                </div>
                <div class="form__row">
                    <label class="form__label">Nro Celular</label>
                    <input type="text" name="input-celular" id="input-celular" placeholder="# celular" value="" class="form__input " maxlength="9"/>
                </div>
                <div class="form__row">
                    <label class="form__label">email</label>
                    <input type="email" name="input-email" id="input-email" placeholder="correo electronico" value="" class="form__input" required/>
                </div>
                <div class="form__row">
                    <label class="form__label">Nro RUC para facturas</label>
                    <input type="text" name="input-ruc" id="input-ruc" placeholder="" class="form__input " maxlength="11" minlength="8" required/>
                    <button class="button button--small button--secondary" type="button" id="button-addon1" onclick="validarRUC()">Obtener Razon Social</button>
                </div>
                <div class="form__row">
                    <label class="form__label">Razon Social</label>
                    <input type="text" name="input-razon-social" id="input-razon-social" placeholder="solo si llenan RUC" value="" class="form__input required" readonly required/>
                    <input type="hidden" id="input-direccion-ruc" name="input-direccion-ruc">
                </div>
                <div class="form__row">
                    <label class="form__label">Referencia</label>
                    <input type="text" name="input-referencia" id="input-referencia" placeholder="como ubicarlo" class="form__input"/>
                </div>
                <div class="form__row mt-40">
                    <input type="hidden" name="input-id-contrato" value="<?php echo $Contrato->getId() ?>" id="input-id-contrato">
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
    function validarRUC() {
        var arraypost = {nrodocumento: $("#input-ruc").val().trim()};

        $.post("../../inputAjax/obtenerDatosInternet.php", arraypost, function (data) {
            var jsonresultado = JSON.parse(data);
            $("#input-razon-social").val(jsonresultado.datos)
            $("#input-direccion-ruc").val(jsonresultado.direccion)
            $("#input-referencia").focus();
        });
    }

    function obtenerDatos() {
        var idcliente = $("#input-cliente").val()
        if (idcliente == '0') {
            $("#input-datos").val("")
            $("#input-celular").val("")
            $("#input-email").val("")
            $("#input-ruc").val("")
            $("#input-razon-social").val("")
            $("#input-referencia").val("")
            $("#input-datos").focus()
        } else {
            var arraypost = {clienteid: idcliente.trim()};
            $.post("../../inputAjax/obtenerDatosCliente.php", arraypost, function (data) {
                var jsonresultado = JSON.parse(data);
                $("#input-datos").val(jsonresultado.datos)
                $("#input-celular").val(jsonresultado.celular)
                $("#input-email").val(jsonresultado.email)
                $("#input-ruc").val(jsonresultado.documento)
                $("#input-razon-social").val(jsonresultado.razonsocial)
                $("#input-referencia").val(jsonresultado.referencia)
            });
        }
    }
</script>
</body>
</html>