<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['nomUsuario']) && $_SESSION['userUsuario'] && $_SESSION['idUsuario'] && $_SESSION['rolUsuario']) {

    $nomUsuario = trim($_SESSION['nomUsuario']);

    $userUsuario = trim($_SESSION['userUsuario']);

    $idUsuario = trim($_SESSION['idUsuario']);

    $idDepartamento = trim($_SESSION['idDepartamento']);



    if ($idDepartamento > 0) {
    } else {
        header('Location: ../sdo-flujo/login.php?errorSesion=true');
    }

    $nomDepartamento = getNomDepartamento($idDepartamento);

    $rolUsuario = trim($_SESSION['rolUsuario']);

    if ($nomUsuario == '' || $nomUsuario == ' ' || empty($nomUsuario) || $userUsuario == '' || $userUsuario == ' ' || empty($userUsuario) || $idUsuario == '' || $idUsuario == ' ' || empty($idUsuario)  || $rolUsuario == '' || $rolUsuario == ' ' || empty($rolUsuario)) {
        header('Location: ../sdo-flujo/login.php?errorSesion=true');
    } else {
    }
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../sdo-admtec/index.php" class="nav-link">Inicio</a>
        </li>
    </ul>

</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/ss-vina-quillota.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $nomUsuario; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <!-- INICIO -->
                <li class="nav-item">
                    <a href="../sdo-admtec/index.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <!-- FIN INICIO -->

                <?php
                if ($nomDepartamento == "Instrumentación") {
                ?>
                    <li class="nav-header"></li>

                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="../sdo-admtec/control-acceso.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Listado de Control de Acceso
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>
                    <!-- FIN CONTROL ACCESO -->

                    <!-- ACCESO A PARKING -->
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="../sdo-admtec/parking-acceso.php" class="nav-link">
                            <i class="nav-icon fas fa-parking"></i>
                            <p>
                                Listado de Acceso a Parking
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>
                    <!-- FIN ACCESO A PARKING -->

                    <!-- SISTEMA DE ACTAS -->
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="../sdo-admtec/actas-formulario.php" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Crear Acta de Activaci&oacute;n
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="../sdo-admtec/actas-listado.php" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Listado de Actas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>
                    <!-- FIN SISTEMA DE ACTAS -->

                    <!-- REPORTES DE EVENTOS -->
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="../sdo-admtec/reportes-listado.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Reportes de Eventos Relevantes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>
                    <!-- FIN REPORTES DE EVENTOS -->

                    <li class="nav-header"></li>
                    <!-- INICIO -->
                    <li class="nav-item">
                        <a href="llaves_entregadas.php" class="nav-link">
                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                Llaves Entregadas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                    <!-- BITACORA -->
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="../sdo-admtec/bitacora-listado.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Bitacora
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>
                    <!-- FIN BITACORA -->

                <?php
                }
                ?>
                
                <li class="nav-header"></li>
                <li class="nav-header"></li>
                <!-- SOLICITUDES -->
                <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Tickets
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="solicitudes_recibidas.php" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Tickets Recibidos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="solicitudes_finalizadas.php" class="nav-link">
                                    <i class="nav-icon fas fa-check"></i>
                                    <p>
                                        Tickets Finalizados
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="solicitudes_canceladas.php" class="nav-link">
                                    <i class="nav-icon fas fa-times-circle"></i>
                                    <p>
                                        Tickets Cancelados
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <!-- SOLICITUDES -->
                    
                <!-- INICIO -->
                <li class="nav-item">
                    <a href="soliCompra_administracion.php" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Solicitudes de Compra
                        </p>
                    </a>
                </li>

                <!-- SALIR -->
                <li class="nav-header"></li>
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../sdo-flujo/login.php?cerrarSesion=true" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Salir
                        </p>
                    </a>
                </li>
                <!-- FIN SALIR -->


            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>