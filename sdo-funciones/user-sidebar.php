<?php

session_start();

if (isset($_SESSION['nomUsuario']) && $_SESSION['userUsuario'] && $_SESSION['idUsuario'] && $_SESSION['rolUsuario']  && $_SESSION['departamentoPersonal']) {

    $nomUsuario = trim($_SESSION['nomUsuario']);

    $userUsuario = trim($_SESSION['userUsuario']);

    $idUsuario = trim($_SESSION['idUsuario']);

    $rolUsuario = trim($_SESSION['rolUsuario']);

    $departamentoPersonal = trim($_SESSION['departamentoPersonal']);

    if ($nomUsuario == '' || $nomUsuario == ' ' || empty($nomUsuario) || $userUsuario == '' || $userUsuario == ' ' || empty($userUsuario) || $idUsuario == '' || $idUsuario == ' ' || empty($idUsuario)  || $rolUsuario == '' || $rolUsuario == ' ' || empty($rolUsuario) || $departamentoPersonal == '' || $departamentoPersonal == ' ' || empty($departamentoPersonal)) {
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
                        <a href="index.php" class="d-block"><img src="../dist/img/simboloAdmin.jpg" class="img-circle elevation-2" alt="User Image"></a>
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

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-laptop-house"></i>
                                <p>
                                    Ordenes de Trabajo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a href="#" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Agregar Orden</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Listado de Ordenes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- SALIR -->
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