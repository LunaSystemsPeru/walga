<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>MobioKit - Premium Mobile Template</title>
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
                <form id="Form" method="post" action="checkout.html">
                    <div class="form__row">
                        <label class="form__label">fecha</label>
                        <input type="date" name="Username" placeholder="Buscar Cliente" value="<?php echo date("Y-m-d")?>" class="form__input required"/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Cliente</label>
                        <input type="text" name="Username" placeholder="Buscar Cliente" value="" class="form__input required"/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Desea Comprobante?</label>
                        <div class="form__select">
                            <select name="selectoptions" class="required">
                                <option value="1">No</option>
                                <option value="2">Factura</option>
                            </select>
                        </div>
                    </div>
                    <div class="form__row">
                        <label class="form__label">RUC a facturar</label>
                        <input type="text" name="Username" placeholder="" value="" class="form__input required"/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Servicio</label>
                        <textarea name="txt_servicio" class="form__textarea"></textarea>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Monto Pactado</label>
                        <input type="text" name="Username" placeholder="Ref Origen" value="" class="form__input required"/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Adelanto</label>
                        <input type="text" name="Username" placeholder="Ref Punto Llegada" value="" class="form__input required"/>
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
</body>
</html>