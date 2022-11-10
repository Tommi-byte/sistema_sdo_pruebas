<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['nomUsuario']) && $_SESSION['userUsuario'] && $_SESSION['idUsuario'] && $_SESSION['rolUsuario']) {

    $nomUsuario = trim($_SESSION['nomUsuario']);

    $userUsuario = trim($_SESSION['userUsuario']);

    $idUsuario = trim($_SESSION['idUsuario']);

    $rolUsuario = trim($_SESSION['rolUsuario']);

    $rolUsuario2 = '';
    if ($rolUsuario == 'directiva' || $rolUsuario == 'DIRECTIVA' || $rolUsuario == 'Directiva') {
        $rolUsuario2 = 'Direcci&oacute;n SDO';
    } else {
        $rolUsuario2 = $rolUsuario;
    }

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
            <a href="../sdo-directiva/index.php" class="nav-link">Inicio</a>
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
                    <a href="../sdo-directiva/index.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <!-- FIN INICIO -->

                <li class="nav-header"></li>
                <li class="nav-header"></li>

                <li class="nav-item">
                    <a href="../sdo-directiva/reportes-visualizar.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Reportes de Eventos Relevantes</p>
                    </a>
                </li>

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../sdo-directiva/ordenes-visualizar.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Recepciones de Trabajo</p>
                    </a>
                </li>

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Funcionarios SDO
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../sdo-directiva/jefes-listado.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Encargados de Departamento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../sdo-directiva/profesionales-listado.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profesionales de Departamento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../sdo-directiva/tecnicos-listado.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Tecnicos de Departamento</p>
                            </a>
                        </li>
                    </ul>
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