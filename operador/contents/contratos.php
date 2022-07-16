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
            if ($iestado == 0) {
                $label_estado = "Programado";
            }
            if ($iestado == 1) {
                $label_estado = "en  Proceso";
            }
            if ($iestado == 2) {
                $label_estado = "Finalizado";
            }
            ?>
            <div class="cards cards--11">
                <div class="card card--style-inline card--style-inline-bg card--style-round-corners">
                    <div class="card__details">
                        <h4 class="card__title"><?php echo strtoupper($fila['servicio']) ?> <p class="card__text"><?php echo $fila['origen'] . " - " . $fila['destino'] ?></p></h4>
                        <p class="card__text"><i></i> Cliente: <?php echo $fila['datos'] ?></p>
                        <p class="card__text">Programado para <?php echo $fila['fecha'] . " | " . $fila['hora_inicio'] ?></p>
                        <div class="caption__content">
                            <a class="caption__category" ><?php echo $label_estado ?></a>
                        </div>
                    </div>
                    <?php
                    $url = "";
                    if ($iestado == 0) {
                        $url = 'acepta-contrato.php?id='.$fila['id'];
                    } else {
                        $url = 'finaliza-contrato.php?id='.$fila['id'];
                    }
                    ?>
                    <div class="card__more">
                        <a href="<?php echo $url ?>">
                            <img src="../assets/images/icons/blue/more.svg" alt="" title=""/></a>
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