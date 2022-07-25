<?php
include "../fixed/cargarSesion.php";

?>
<div class="panel panel--left">
                  <!-- Slider -->
                 <div class="panel__navigation">
                    <div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="user-details">
					<div class="user-details__thumb"><img src="../../public/images/logowalga.png" alt="" title=""/></div>
					<div class="user-details__title"><?php echo $_SESSION['placa'] ?></div>
				</div>
				<nav class="main-nav">
					<ul>
						<li><a href="contratos.php"><img src="../assets/images/icons/blue/home.svg" alt="" title="" /><span>Contratos</span></a></li>
						<li><a href="clientes.php"><img src="../assets/images/icons/blue/user.svg" alt="" title="" /><span>Clientes</span></a></li>
						<li class="divider"></li>
						<li><a href="gastos-vehiculos.php"><img src="../assets/images/icons/blue/slider.svg" alt="" title="" /><span>Gastos Vehiculo</span></a></li>
                        <li><a href="vencimientos.php"><img src="../assets/images/icons/blue/alert.svg" alt="" title="" /><span>Vencimientos</span></a></li>
						<li class="divider"></li>
						<li><a href="cuenta.php"><img src="../assets/images/icons/blue/settings.svg" alt="" title="" /><span>Mis Datos</span></a></li>
						<li><a href="../controller/logout.php"><img src="../assets/images/icons/blue/logout.svg" alt="" title="" /><span>Salir</span></a></li>
					</ul>
				</nav>
		</div>
</div>