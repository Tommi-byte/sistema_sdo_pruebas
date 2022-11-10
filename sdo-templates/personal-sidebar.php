<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['nomUsuario']) && $_SESSION['userUsuario'] && $_SESSION['idUsuario'] && $_SESSION['rolUsuario']  && $_SESSION['departamentoPersonal']) {

    $nomUsuario = trim($_SESSION['nomUsuario']);

    $userUsuario = trim($_SESSION['userUsuario']);

    $idUsuario = trim($_SESSION['idUsuario']);

    $rolUsuario = trim($_SESSION['rolUsuario']);

    $cargoPersonal = getCargoPersonal($idUsuario);

    $departamentoPersonal = trim($_SESSION['departamentoPersonal']);

    $idDepartamento = trim($_SESSION['idDepartamento']);

    $idSubDepartamento = trim($_SESSION['idSubDepartamento']);

    if ($nomUsuario == '' || $nomUsuario == ' ' || empty($nomUsuario) || $userUsuario == '' || $userUsuario == ' ' || empty($userUsuario) || $idUsuario == '' || $idUsuario == ' ' || empty($idUsuario)  || $rolUsuario == '' || $rolUsuario == ' ' || empty($rolUsuario) || $departamentoPersonal == '' || $departamentoPersonal == ' ' || empty($departamentoPersonal) || $idDepartamento == '' || $idDepartamento == ' ' || empty($idDepartamento)) {
        header('Location: ../sdo-flujo/login.php?errorSesion=true');
    } else {

?>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="index.php" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../sdo-personal/index.php" class="nav-link">Inicio</a>
                </li>
            </ul>

        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <a href="index.php" class="d-block">
                            <img src="../dist/img/ss-vina-quillota.png" class="img-circle elevation-2" alt="User Image">
                        </a>
                    </div>
                    <div class="info">
                        <a href="index.php" class="d-block"><?php echo $nomUsuario; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <!-- INICIO -->
                        <li class="nav-item">
                            <a href="../sdo-personal/index.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li class="nav-header"></li>
                        <li class="nav-header"></li>
                        <li class="nav-header"></li>
                        <!-- FIN INICIO -->

                        <?php

                        if ($_SESSION['departamentoPersonal'] == "Instrumentación") {
                        ?>
                            <!-- INICIO -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-laptop-house"></i>
                                    <p>
                                        Reportes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../sdo-personal/reportes-formulario.php" class="nav-link">
                                            <i class="nav-icon fas fa-file"></i>
                                            <p>Crear Reportes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../sdo-personal/reportes-listado.php" class="nav-link">
                                            <i class="nav-icon fas fa-book"></i>
                                            <p>Listado de Reportes</p>
                                        </a>
                                </ul>
                            </li>

                            <!-- FIN INICIO -->
                        <?php
                        } else {
                        }

                        ?>
                        <li class="nav-header"></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-laptop-house"></i>
                                <p>
                                    Recepciones de Trabajo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../sdo-personal/ordenes-formulario.php" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Agregar Recepci&oacute;n</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="../sdo-personal/ordenes-listado.php" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Listado de Recepciones de Trabajo</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-header"></li>
                        <?php

                        if ($_SESSION['departamentoPersonal'] == "Instrumentación") {
                        ?>
                            <!-- INICIO -->
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
                                        <a href="../sdo-personal/sistemas-listado.php" class="nav-link">
                                            <i class="nav-icon fas fa-book"></i>
                                            <p>Listado de Sistemas</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../sdo-personal/forzados-listado.php" class="nav-link">
                                            <i class="nav-icon fas fa-book"></i>
                                            <p>Listado de Equipos Forzados</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../sdo-personal/sistemas-observaciones.php" class="nav-link">
                                            <i class="nav-icon fas fa-list-ul"></i>
                                            <p>Observaciones</p>
                                        </a>
                                    </li>
                                </ul>
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
                            <!-- LEVANTAMIENTO BMS -->
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
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="controladores-esclavos-listado.php" class="nav-link">
                                            <i class="nav-icon fas fa-list"></i>
                                            <p>
                                                Controladores BMS
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                    </li>
                                    <!-- INICIO -->
                                    <li class="nav-item">
                                        <a href="detalle_controladores_bms.php" class="nav-link">
                                            <i class="nav-icon fas fa-list"></i>
                                            <p>
                                                Detalle Controladores BMS
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- LEVANTAMIENTO BMS -->

                            <li class="nav-header"></li>

                            <li class="nav-item">
                                <a href="salas_electricas_listado.php" class="nav-link">
                                    <i class="nav-icon fa fa-laptop"></i>
                                    <p>
                                        Salas Electricas y Comunicaci&oacute;n HBQP
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header"></li>
                            <!-- CONTROL DE ACCESO Y PARKING -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-laptop"></i>
                                    <p>
                                        Control de Acceso y Parking
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="personal-controlAcceso.php" class="nav-link">
                                            <i class="nav-icon fas fa-list-ul"></i>
                                            <p>
                                                Listado de Control de Acceso
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="parking-acceso.php" class="nav-link">
                                            <i class="nav-icon fas fa-parking"></i>
                                            <p>
                                                Listado de Acceso a Parking
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- CONTROL DE ACCESO Y PARKING -->

                        <?php
                        }
                        ?>
                        <li class="nav-header"></li>
                        <!-- SOLICITUDES -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Solicitudes
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

                        <?php

                        if ($_SESSION['departamentoPersonal'] == "Instrumentación") {
                        ?>


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
                            <!-- INICIO -->
                            <li class="nav-item">
                                <a href="actas-administrar.php" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Sistema de Actas
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            </li>
                            

                            

                            <!-- FIN INICIO -->
                        <?php
                        } else {
                        }

                        ?>


                        <!-- SALIR -->
                        <li class="nav-header"></li>
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
<?php
    }
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

?>