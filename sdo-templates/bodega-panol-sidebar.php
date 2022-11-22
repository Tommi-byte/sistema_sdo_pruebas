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
    if ($rolUsuario == 'Bodega Pañol') {
        $rolUsuario2 = 'Bodega del pañol';
    } else {
        header('Location: ../sdo-flujo/login.php?errorSesion=true');
    }

    if ($nomUsuario == '' || $nomUsuario == ' ' || empty($nomUsuario) || $userUsuario == '' || $userUsuario == ' ' || empty($userUsuario) || $idUsuario == '' || $idUsuario == ' ' || empty($idUsuario)  || $rolUsuario == '' || $rolUsuario == ' ' || empty($rolUsuario)) {
        header('Location: ../sdo-flujo/login.php?errorSesion=true');
    } else {
    }
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}


?>

 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="preloader  flex-column justify-content-center align-items-center">

            <img class="animation__shake" src="../dist/img/ssvq1.png" alt="logo">
            <br>
            <div class="spinner-border text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>

</div>

<nav class="main-header navbar navbar-expand navbar-white navbar-dark dark-mode ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../sdo-bodega-pañol/index.php" class="nav-link">Inicio</a>
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
                <a href="/TrabajarSDO_Pruebas/sdo-bodega-pañol/index.php" class="d-block"><?php echo $nomUsuario; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <!-- INICIO -->
                <li class="nav-item">
                    <a href="../sdo-bodega-pañol/index.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <!-- FIN INICIO -->
              

                

                <li class="nav-header"></li>
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../sdo-bodega-pañol/bodega-administrar.php" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Administrar Herramientas</p>
                    </a>
                </li>

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../sdo-bodega-pañol/arriendo-retiro-administrar.php" class="nav-link">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>Administrar Arriendo Herramientas y/o Retiro Materiales Ticket Trabajo </p>
                    </a>
                </li>

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../sdo-bodega-pañol/materiales-administrar.php" class="nav-link">
                    <i class="nav-icon fas fa-box-open"></i>
                        <p>Administrar Materiales</p>
                    </a>
                </li>

              
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../sdo-bodega-pañol/reserva-administrar.php" class="nav-link">
                    <i class="nav-icon fas fa-door-closed"></i>
                        <p>Administrar Reservas Herramientas y/o Materiales Solicitudes</p>
                    </a>
                </li>

                <!-- <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../sdo-mesa-ayuda/solicitudes_canceladas.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Tickets Cancelados</p>
                    </a>
                </li> -->

                <!-- <li class="nav-header"></li>
               
                <li class="nav-item">
                    <a href="../sdo-mesa-ayuda/soliCompra_administracion.php" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Solicitudes de Compra
                        </p>
                    </a>
                </li> -->




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
    <br>
    <br>
    <br>
   
        
     
   

        <footer>
            <p id="patito1" style="text-align:center; color: white; font-weight: bold"> Version: 0.2.8 Dev<br> Cueck!</p>           
        </footer>
    </div>
    <!-- /.sidebar -->

    <script>

        const patito = document.getElementById('patito1');

        patito.addEventListener('click', function(){
            Swal.fire({
                title: 'Cueck Cueck patito bailando... Version 0.2.8 Dev',
                width: 400,
                padding: '3em',
                color: '#716add',
                background: '#fff url(/images/trees.png)',
                backdrop: `
                    rgba(0,0,123,0.4)
                    url("https://media.tenor.com/images/1a64bbd8b628e16c336892fce892e0d8/tenor.gif")
                    center right
                    repeat
                
                `
                })
        })


    </script>
</aside>

