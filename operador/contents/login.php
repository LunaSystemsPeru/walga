<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
<title>MobioKit - Premium Mobile Template</title>
<link rel="stylesheet" href="../vendor/swiper/swiper.min.css">
<link rel="stylesheet" href="main/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet"> 
</head>
<body>
	
<div class="page page--login" data-page="login">

	<!-- HEADER -->
	<header class="header header--fixed">	
		<div class="header__inner">	
			<div class="header__icon"><a href="main/splash.html"><img src="../assets/images/icons/white/arrow-back.svg" alt="" title=""/></a></div>
                </div>
	</header>

        <div class="login">
		<div class="login__content">	
			<p class="login__text">Bienvenido Operador</p>
				<div class="login-form">
					<form id="LoginForm" method="post" action="main.php">
						<div class="login-form__row">
							<label class="login-form__label">Usuario</label>
							<input type="text" name="Username" value="" class="login-form__input required" />
						</div>
						<div class="login-form__row">
							<label class="login-form__label">Contraseña</label>
							<input type="password" name="password" value="" class="login-form__input required" />
						</div>
                        <div class="login-form__row">
                            <label class="login-form__label">Vehiculo</label>
                            <div class="form__select">
                                <select name="selectoptions" class="required">
                                    <option value="" disabled selected>Seleccionar Vehiculo</option>
                                    <option value="1">D2D744</option>
                                    <option value="2">BDO254</option>
                                </select>
                            </div>
                        </div>

						<div class="login-form__row">
							<input type="submit" name="submit" class="login-form__submit button button--main button--full" id="submit" value="Ingresar" />
						</div>
					</form>
				</div>
		</div>
        </div>
			  


</div>
<!-- PAGE END -->
   
<script src="../vendor/jquery/jquery-3.5.1.min.js"></script>
<script src="../vendor/jquery/jquery.validate.min.js" ></script>
<script src="../vendor/swiper/swiper.min.js"></script>
<script src="main/js/jquery.custom.js"></script>
</body>
</html>