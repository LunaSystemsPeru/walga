<?php
require '../../models/Vehiculo.php' ;
$Vehiculo = new Vehiculo();
$Vehiculo->setEmpresaId(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>Walga Transportes | Alquiler de Gruas y Logistica</title>
    <link rel="stylesheet" href="../vendor/swiper/swiper.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
</head>
<body>

<div class="page page--login" data-page="login">

    <!-- HEADER -->
    <header class="header ">
        <div class="header__logo--intro">
                <img src="../../public/images/logowalga.png" style="width: 45%; height: auto">
        </div>
    </header>
    <div class="login">
        <div class="login__content">
            <div class="login-form">
                <form id="LoginForm" method="post" action="../controller/login.php">
                    <div class="login-form__row">
                        <label class="login-form__label">Usuario</label>
                        <input type="text" name="input-usuario" value="" class="login-form__input required" required/>
                    </div>
                    <div class="login-form__row">
                        <label class="login-form__label">Contraseña</label>
                        <input type="password" name="input-password" value="" class="login-form__input required" required/>
                    </div>
                    <div class="login-form__row">
                        <label class="login-form__label">Vehiculo</label>
                        <div class="form__select">
                            <select name="select-vehiculo" class="required" required>
                                <option value="" disabled selected>Seleccionar Vehiculo</option>
                                <?php
                                $array_vehiculos =$Vehiculo->verFilas();
                                foreach ($array_vehiculos as $fila) {
                                echo '<option value="'.$fila['id'] .'">'.$fila['placa'] .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="login-form__row">
                        <input type="submit" name="submit" class="login-form__submit button button--main button--full" id="submit" value="Ingresar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- PAGE END -->

<script src="../vendor/jquery/jquery-3.5.1.min.js"></script>
<script src="../vendor/jquery/jquery.validate.min.js"></script>
<script src="../vendor/swiper/swiper.min.js"></script>
<script src="main/js/jquery.custom.js"></script>
</body>
</html>