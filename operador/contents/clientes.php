<?php
include "../fixed/cargarSesion.php";
require '../../models/Cliente.php';
$Cliente = new Cliente();
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
        <div class="buttons buttons--centered mb-20">
            <!--<a href="registra-cliente.php" data-popup="success" class="button button--main button--full open-popup">Nuevo Cliente</a>
            <a href="registra-contrato.php" data-popup="success" class="button button--secondary button--full open-popup">Buscar Cliente</a>-->
        </div>

        <h4>Lista de Clientes</h4>
        <div class="cards cards--11">
            <?php
            $array_clientes = $Cliente->ultimos50Clientes();
            foreach ($array_clientes as $fila) {
                ?>
                <div class="card card--style-inline card--style-inline-bg card--style-round-corners">
                    <div class="card__icon">
                        <a href="tel:+51<?php echo $fila['celular'] ?>" target="_blank">
                        <img src="../assets/images/icons/blue/mobile.svg" alt="" title=""/>
                        </a>
                    </div>
                    <div class="card__details">
                        <h4 class="card__title"><?php echo $fila['datos'] ?></h4>
                        <p class="card__text"><?php echo $fila['email'] ?></p>
                    </div>
                    <div class="card__more"><a target="_blank" href="https://wa.me/+51<?php echo $fila['celular'] ?>?text=Hola, te escribo de WALGA Inversiones EIRL " ><img src="../assets/images/icons/blue/more.svg" alt="" title=""/></a></div>
                </div>
            <?php
            }
            ?>

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