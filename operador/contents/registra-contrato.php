<?php
include "../fixed/cargarSesion.php";
require '../../models/ParametroValor.php';
require '../../models/Cliente.php';

$Valor = new ParametroValor();
$Cliente = new Cliente();
$Cliente->setEmpresaId($_SESSION['empresa_id']);
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
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all"/>
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
        <h2 class="page__title">Nuevo Contrato Servicio</h2>
        <div class="fieldset">
            <div class="form">
                <form id="Form" method="post" action="../controller/registra-contrato.php">
                    <div class="form__row">
                        <label class="form__label">fecha</label>
                        <input type="date" name="input-fecha" placeholder="Buscar Cliente" value="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d") ?>" min="<?php echo date("Y-m-d") ?>" class="form__input required"/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Servicio</label>
                        <textarea class="form__textarea" id="text-servicio" name="input-servicio"></textarea>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Tipo Servicio</label>
                        <div class="form__select">
                            <select name="select-tipo-servicio" id="select-tipo-servicio" class="required">
                                <?php
                                $Valor->setParametroId(2);
                                $array_servicios = $Valor->verFilas();
                                foreach ($array_servicios as $fila) {
                                    echo ' <option value="' . $fila['id'] . '">' . $fila['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Origen</label>
                        <input type="text" name="input-origen" placeholder="Ref Origen" value="" class="form__input required" required/>
                    </div>
                    <div class="form__row">
                        <label class="form__label">Destino</label>
                        <input type="text" name="input-destino" placeholder="Ref Punto Llegada" value="" class="form__input required" required/>
                        <input type="hidden" name="input-id-cliente" value="0">
                        <input type="hidden" name="input-monto" value="0">
                    </div>
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

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
        integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY="
        crossorigin="anonymous"></script>

<script>
    //buscar clientes
    $("#input-cliente").autocomplete({
        source: "../../inputAjax/obtenerJsonClientes.php",
        minLength: 3,
        select: function (event, ui) {
            event.preventDefault();
            $("#input-cliente").val(ui.item.datos);
            $("#input-id-cliente").val(ui.item.id);
            $("#text-servicio").focus();
        }
    });

    function seleccionarCliente() {
        var idcliente = $("#input-cliente").val();
        $("#input-id-cliente").val(idcliente)
    }

    function esclienteExpress() {
        var tienecliente = $("#select-tiene-cliente").val()
        if (tienecliente == 1) {
            $("#input-cliente").prop("disabled", true);
            $("#href-cliente").prop("disabled", true);
            $("#input-cliente").val(0)
            $("#input-id-cliente").val(0)
            $("#text-servicio").focus();
        } else {
            $("#href-cliente").prop("disabled", false);
            $("#input-cliente").prop("disabled", false);
            $("#input-id-cliente").val("")
            $("#input-cliente").focus();
        }
    }

    function agregarCliente() {
        window.location.href = "registra-cliente.php";
    }
</script>
</body>
</html>
