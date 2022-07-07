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
        <div class="buttons buttons--centered mb-20">
            <a href="registra-contrato.php" data-popup="success" class="button button--main button--full open-popup">Nuevo Cliente</a>
            <a href="registra-contrato.php" data-popup="success" class="button button--secondary button--full open-popup">Buscar Cliente</a>
        </div>

        <h4>Lista de Clientes</h4>
        <div class="table table--5cols mb-20">
            <div class="table__inner">
                <div class="table__row">
                    <div class="table__section__id table__section--header">#</div>
                    <div class="table__section__email table__section--header">Datos</div>
                    <div class="table__section table__section--header">Celular</div>
                    <div class="table__section__email table__section--header">Email</div>
                    <div class="table__section table__section--header">Acciones</div>
                </div>
                <div class="table__row">
                    <div class="table__section__id">1</div>
                    <div class="table__section__email">Wilmer Alvarez Garcia</div>
                    <div class="table__section">949490436</div>
                    <div class="table__section__email">segebuco@gmail.com</div>
                    <div class="table__section"><a href="#" class="button button--main button--ex-small">Editar</a><a href="#" class="button button--main button--ex-small">ver Deuda</a></div>
                </div>
                <div class="table__row">
                    <div class="table__section__id">2</div>
                    <div class="table__section__email">Luis Oyanguren Giron</div>
                    <div class="table__section">936507153</div>
                    <div class="table__section__email">leog.1992@gmail.com</div>
                    <div class="table__section"><a href="#" class="button button--main button--ex-small">Editar</a></div>
                </div>

            </div>
        </div>


    </div>
    <!-- PAGE END -->

    <!-- Bottom navigation -->
    <div id="bottom-toolbar" class="bottom-toolbar"></div>

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