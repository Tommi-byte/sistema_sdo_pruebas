<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['nomUsuario']) && $_SESSION['userUsuario'] && $_SESSION['idUsuario'] && $_SESSION['rolUsuario']) {

    $nomUsuario = trim($_SESSION['nomUsuario']);

    $userUsuario = trim($_SESSION['userUsuario']);

    $idUsuario = trim($_SESSION['idUsuario']);

    $rolUsuario = trim($_SESSION['rolUsuario']);

    $cargoUsuario = trim($_SESSION['cargoUsuario']);

    if ($cargoUsuario == '' || empty($cargoUsuario) || $nomUsuario == '' || $nomUsuario == ' ' || empty($nomUsuario) || $userUsuario == '' || $userUsuario == ' ' || empty($userUsuario) || $idUsuario == '' || $idUsuario == ' ' || empty($idUsuario)  || $rolUsuario == '' || $rolUsuario == ' ' || empty($rolUsuario)) {
        header('Location: ../sdo-flujo/login.php?errorSesion=true');
    } else {
    }
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

?>

<nav class="main-header navbar navbar-expand navbar-light" style="background-color: #e3f2fd;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../sdo-administrador/index.php" class="nav-link">Inicio</a>
        </li>
    </ul>

</nav>


<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">

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
        <nav class="">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <!-- INICIO -->
                <li class="nav-item">
                    <a href="../sdo-administrador/index.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-header"></li>
                <li class="nav-header"></li>
                <!-- FIN INICIO -->
                <li class="nav-item">
                    <a href="../sdo-administrador/reportes-administrar.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Reportes</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                </li>
                <li class="nav-header"></li>

                <li class="nav-item">
                    <a href="../sdo-administrador/ordenes-administrar.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Recepciones de Trabajo</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                </li>
                <li class="nav-header"></li>
                <!-- INICIO -->
                <li class="nav-item">
                    <a href="bitacora-listado.php" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Bitacora
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>
                            Sistemas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="sistemas-listado.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Listado de Sistemas</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="forzados-listado.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Listado de Equipos Forzados</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="sistemas-observaciones.php" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>Observaciones</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header"></li>
                <!-- INICIO -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>
                            Levantamientos BMS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="controladores-maestros-listado.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Servidor BMS
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="controladores-esclavos-listado.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Controladores BMS
                                </p>
                            </a>
                        </li>
                        <!-- INICIO -->
                        <li class="nav-item">
                            <a href="detalle_controladores_bms.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Detalle Controladores BMS
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header"></li>
                <!-- USUARIOS -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Listado de Usuarios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="../sdo-administrador/jefes-administrar.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Listado de Encargados de Departamento
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../sdo-administrador/profesionales-administrar.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Listado de Profesionales de Departamento
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../sdo-administrador/personal-administrar.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Listado de Tecnicos de Departamento
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- USUARIOS -->

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
                            <a href="../sdo-administrador/solicitudes_recibidas.php" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Tickets Recibidos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="solicitudes_finalizadas.php" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Tickets Finalizados
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../sdo-administrador/solicitudes_canceladas.php" class="nav-link">
                                <i class="nav-icon fas fa-times-circle"></i>
                                <p>
                                    Tickets Cancelados
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- SOLICITUDES -->
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
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Control de Acceso y Parking
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../sdo-administrador/control-acceso.php" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Listado de Control de Acceso</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../sdo-administrador/parking-acceso.php" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Listado de Parking</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>
                            Actas de Activaci&oacute;n de Tarjeta
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="actas-formulario.php" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Generar Acta</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="actas-administrar.php" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>Listado de Actas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>
                            Actas de Activaci&oacute;n de Tarjeta
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="actas-formulario.php" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Generar Acta</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="actas-administrar.php" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>Listado de Actas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header"></li>
                <!-- INICIO -->
                <li class="nav-item">
                    <a href="soliCompra_administracion.php" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            Solicitudes de Compra
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-header"></li>
                <!-- INICIO -->
                <li class="nav-item">
                    <a href="../sdo-administrador/buscar-password.php" class="nav-link">
                        <i class="nav-icon fas fa-unlock"></i>
                        <p>
                            Búsqueda de 
                            Contraseñas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-header"></li>
                <!--INICIO -->     
                    <li class="nav-item">
                    <a href="../sdo-pdf/tcpdf_pruebas.php" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                        Pruebas
                            <i class="right fas fa-angle-left"></i>
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
</aside>