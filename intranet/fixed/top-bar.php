<?php
require_once '../../models/Recordatorio.php';
require_once '../../tools/Util.php';
$Recordar = new Recordatorio;
$Tools = new Util();

$Recordar->setEmpresaid($_SESSION['empresa_id']);
$array_vencimientos = $Recordar->verxVencer();
$contaritems = 0;
foreach ($array_vencimientos as $fila) {
    $contaritems++;
}
?>
<div class="topbar">
    <!-- LOGO -->
    <div class="brand">
        <a href="main.php" class="logo">
                    <span>
                        <img src="../assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                    </span>
            <span>
                        <img src="../assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                        <img src="../assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                    </span>
        </a>
    </div>
    <!--end logo-->
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">
            <!--
            <li class="creat-btn">
                <div class="nav-link">
                    <a class=" btn btn-sm btn-soft-primary" href="#" role="button"><i class="fas fa-plus mr-2"></i>New Task</a>
                </div>
            </li>
            <li class="dropdown hide-phone">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i data-feather="search" class="topbar-icon"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-lg p-0">
                    <div class="app-search-topbar">
                        <form action="#" method="get">
                            <input type="search" name="search" class="from-control top-search mb-0" placeholder="Type text...">
                            <button type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                </div>
            </li>
            -->

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i data-feather="bell" class="align-self-center topbar-icon"></i>
                    <span class="badge badge-danger badge-pill noti-icon-badge"><?php echo $contaritems ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">

                    <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                        Vencimientos <span class="badge badge-primary badge-pill"><?php echo $contaritems ?></span>
                    </h6>
                    <div class="notification-menu" data-simplebar>
                        <?php
                        foreach ($array_vencimientos as $fila) {
                            ?>
                            <!-- item-->
                            <a href="#" class="dropdown-item py-3">
                                <small class="float-right text-muted pl-2"><?php echo $fila['diasfaltantes'] ?> dias </small>
                                <div class="media">
                                    <div class="avatar-md bg-soft-primary">
                                        <i data-feather="alert-triangle" class="align-self-center icon-xs"></i>
                                    </div>
                                    <div class="media-body align-self-center ml-2 text-truncate">
                                        <h6 class="my-0 font-weight-normal text-dark"><?php echo $fila['documento'] ?></h6>
                                        <small class="text-muted mb-0">Vence el <?php echo $Tools->fecha_mysql_web($fila['fec_vencimiento']) ?></small>
                                    </div><!--end media-body-->
                                </div><!--end media-->
                            </a><!--end-item-->
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <span class="ml-1 nav-user-name hidden-sm">Salir</span>
                    <i data-feather="log-out" class="align-self-center topbar-icon"></i>
                </a>
            </li>
            <li class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link" id="mobileToggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a><!-- End mobile menu toggle-->
            </li> <!--end menu item-->
        </ul><!--end topbar-nav-->

        <div class="navbar-custom-menu">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="main.php">
                            <span><i data-feather="home" class="align-self-center hori-menu-icon"></i>Resumen General</span>
                        </a>
                    </li><!--end has-submenu-->

                    <li class="has-submenu">
                        <a href="#">
                            <span><i data-feather="dollar-sign" class="align-self-center hori-menu-icon"></i>Ventas</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="lista-ventas.php"><i class="ti ti-minus"></i>Facturacion</a></li>
                            <li><a href="lista-entidades.php"><i class="ti ti-minus"></i>Empresas</a></li>
                        </ul><!--end submenu-->
                    </li><!--end has-submenu-->

                    <li class="has-submenu">
                        <a href="#">
                            <span><i data-feather="grid" class="align-self-center hori-menu-icon"></i>Servicios</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="lista-gastos.php"><i class="ti ti-minus"></i>Gastos</a></li>
                            <li><a href="lista-contratos.php"><i class="ti ti-minus"></i>Contratos</a></li>
                            <li><a href="lista-clientes.php"><i class="ti ti-minus"></i>Clientes</a></li>
                            <li><a href="apps-contact-list.html"><i class="ti ti-minus"></i>Deuda por Cobrar</a></li>
                        </ul><!--end submenu-->
                    </li><!--end has-submenu-->

                    <li class="has-submenu">
                        <a href="#">
                            <span><i data-feather="box" class="align-self-center hori-menu-icon"></i>Flota</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="lista-vehiculos.php"><i class="ti ti-minus"></i>Vehiculos</a></li>
                            <li><a href="lista-choferes.php"><i class="ti ti-minus"></i>Choferes</a></li>
                            <li><a href="lista-recordatorios.php"><i class="ti ti-minus"></i>Vencimientos</a></li>
                        </ul><!--end submenu-->
                    </li><!--end has-submenu-->

                    <li class="has-submenu">
                        <a href="#">
                            <span><i data-feather="lock" class="align-self-center hori-menu-icon"></i>Configuracion</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="lista-usuarios.php"><i class="ti ti-minus"></i>Usuarios</a></li>
                            <li><a href="lista-docsunat.php"><i class="ti ti-minus"></i>Documentos SUNAT</a></li>
                            <li><a href="lista-parametros.php"><i class="ti ti-minus"></i>Parametros</a></li>
                            <li><a href="form-empresa.php"><i class="ti ti-minus"></i>Empresa</a></li>
                        </ul><!--end submenu-->
                    </li><!--end has-submenu-->


                </ul><!-- End navigation menu -->
            </div> <!-- end navigation -->
        </div>
        <!-- Navbar -->
    </nav>
    <!-- end navbar-->
</div>