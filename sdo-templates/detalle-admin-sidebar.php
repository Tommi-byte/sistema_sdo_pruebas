<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../lic-admin/index.php" class="nav-link">Inicio</a>
        </li>
    </ul>

</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/simboloAdmin.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Administrador</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <!-- INICIO -->
                <li class="nav-item">
                    <a href="../lic-admin/index.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <!-- FIN INICIO -->

                <!-- LICITACIONES -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop-house"></i>
                        <p>
                            Licitaciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../lic-admin/licitacion-agregar.php" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Agregar Licitaciones</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../lic-admin/licitaciones-listado.php" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Listado de Licitaciones</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- FIN LICITACIONES -->

                <!-- VISITAS -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop-house"></i>
                        <p>
                            Visitas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../lic-admin/visitas-agregar.php" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Agregar Visitas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../lic-admin/visitas-listado.php" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Listado de Visitas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- FIN VISITAS -->

                <!-- PROPONENTES -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Proponentes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../lic-admin/proponentes-completo.php" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Todos los Proponentes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../lic-admin/proponentes-licitacion.php" class="nav-link">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Seg&uacute;n Licitaci&oacute;n</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../lic-admin/proponentes-visitas.php" class="nav-link">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Seg&uacute;n Visita</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- FIN PROPONENTES -->

                <!-- FOCAL POINTS -->
                <li class="nav-item">
                    <a href="../lic-admin/focalpoint-listado.php" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Focal Points</p>
                    </a>
                </li>
                <!-- FIN FOCAL POINTS -->


                <!-- PREGUNTAS -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Preguntas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../index.html" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Agregar Pregunta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index2.html" class="nav-link">
                                <i class="fa fa-cog nav-icon"></i>
                                <p>Modificar Pregunta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index2.html" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Listado de Preguntas</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- FIN PREGUNTAS -->

                <!-- EQUIPOS -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-mobile-alt"></i>
                        <p>
                            Equipos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../index.html" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Agregar Equipos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index2.html" class="nav-link">
                                <i class="fa fa-cog nav-icon"></i>
                                <p>Modificar Equipos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../index2.html" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Listado de Equipos</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- FIN EQUIPOS -->

                <!-- SALIR -->
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="../lic-flujo/index.php?cerrarSesion=true" class="nav-link">
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