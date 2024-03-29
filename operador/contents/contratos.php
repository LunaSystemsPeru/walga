<?php
include "../fixed/cargarSesion.php";
require '../../models/Contrato.php';
$Contrato = new Contrato();
$Contrato->setVehiculoid($_SESSION['vehiculo_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>Walga Transportes | Alquiler de Gruas y Logistica</title>
    <link rel="stylesheet" href="../vendor/swiper/swiper.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../../landing/assets/img/logo/faviconwalga.png" type="image/x-icon">
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
            <a href="registra-contrato.php" data-popup="success" class="button button--main button--full open-popup">Nuevo Contrato</a>
        </div>

        <h4>Contratos Activos</h4>
        <?php
        $array_contratos = $Contrato->verContratosActivos();
        foreach ($array_contratos as $fila) {
            $iestado = $fila['estado_contrato'];
            $label_estado = "";
            $url = "";
            if ($iestado == 0) {
                $label_estado = "Programado";
                $url = 'acepta-contrato.php?id='.$fila['id'];
            }
            if ($iestado == 1) {
                $label_estado = "en  Proceso";
                $url = 'finaliza-contrato.php?id='.$fila['id'];
            }
            if ($iestado == 2) {
                $label_estado = "Finalizado";
            }
            ?>
            <div class="cards cards--11">
                <div class="card card--style-inline card--style-inline-bg card--style-round-corners">
                    <div class="card__details">

                        <p class="card__text"><img src="../assets/images/icons/red/home.svg" width="12px" alt="" title=""/> Origen: <?php echo $fila['origen'] ?></p>
                        <p class="card__text text-right">Hasta: <?php echo $fila['destino'] ?> <img src="../assets/images/icons/red/arrow-right.svg" width="12px" alt="" title=""/> </p>
                        <p class="card__text"><img src="../assets/images/icons/red/user.svg" width="12px" alt="" title=""/> Cliente: <?php echo $fila['datos'] ?></p>
                        <a href="<?php echo $url ?>" >
                        <h4 class="card__title"><?php echo strtoupper($fila['servicio']) ?></h4>
                        </a>
                        <p class="card__text"><img src="../assets/images/icons/red/card.svg" width="12px" alt="" title=""/>  Fecha: <?php echo $fila['fecha'] . " | " . $fila['hora_inicio'] ?></p>
                        <div class="caption__content">
                            <a class="caption__category" ><?php echo $label_estado ?></a>
                        </div>

                    </div>
                    <div class="card__more">
                        <a href="<?php echo $url ?>">
                            <img src="../assets/images/icons/blue/more.svg" alt="" title=""/>
                        </a>
                    </div>
                </div>
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