<?php
include "../fixed/cargarSesion.php";

?>
<!DOCTYPE html>
<html lang="en">
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
        <h2 class="page__title">Nuevo Cliente</h2>
        <div class="fieldset">
            <div class="form">
                <form id="Form" method="post" action="../controller/registrar-cliente.php">
                    <div class="form__row">
                        <label class="form__label">Apellidos y Nombres</label>
                        <input type="text" name="input-datos" placeholder="Datos de Contacto del Cliente" value="" class="form__input required"/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Nro Celular</label>
                        <input type="text" name="input-celular" placeholder="# celular" value="" class="form__input " maxlength="9"/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">email</label>
                        <input type="email" name="input-email" placeholder="correo electronico" value="" class="form__input "/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Nro RUC para facturas</label>
                        <input type="text" name="input-ruc" id="input-ruc" placeholder="Solo si requiere factura" class="form__input " maxlength="11" minlength="8"/>
                        <button class="button button--small button--secondary" type="button" id="button-addon1" onclick="validarRUC()">Obtener Razon Social</button>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Razon Social</label>
                        <input type="text" name="input-razon-social" id="input-razon-social" placeholder="solo si llenan RUC" value="" class="form__input required" readonly/>
                        <input type="hidden" id="input-direccion-ruc" name="input-direccion-ruc">
                    </div>
                    <div class="form__row">
                        <label class="form__label">Referencia</label>
                        <input type="text" name="input-referencia" id="input-referencia" placeholder="como ubicarlo" class="form__input required"/>
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
        function validarRUC() {
            var arraypost = {nrodocumento: $("#input-ruc").val().trim()};

            $.post("../../inputAjax/obtenerDatosInternet.php", arraypost, function (data) {
                var jsonresultado = JSON.parse(data);
                $("#input-razon-social").val(jsonresultado.datos)
                $("#input-direccion-ruc").val(jsonresultado.direccion)
                $("#input-referencia").focus();
            });
        }
    </script>
</body>
</html>