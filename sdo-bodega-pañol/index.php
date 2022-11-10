<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Men&uacute; del Sistema</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/modelo.css">

    <script src="../dist/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../dist/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/sweetalert2/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="css/estilos.css">
</head>

<body class="hold-transition sidebar-mini dark-mode" id="body">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include '../sdo-templates/bodega-panol-sidebar.php';
        ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Men&uacute; del Sistema</h4>

                          
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                            </ol>
                            <br>
                            <br>
                            <div class="form-group">
                                        <div style="float: right;" class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="toggleDark()">
                                            <label class="custom-control-label" for="customSwitch3">Modo Claro</label>
                                        </div>
                                    </div>

                                    <script>
                                        function toggleDark() {
                                            // var element = document.getElementById("navBarPrincipal")
                                            // element.classList.toggle("dark-mode")

                                            document.body.classList.toggle("dark-mode");
                                            
                                        }
                                    </script>
                                    <br>
                                    <br>
                        </div>

                       
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <?php

            
            if (isset($_GET['loginExito'])) {
            ?>
                <script>
                    Swal.fire({
                        title: 'Ingreso Exitoso a la Plataforma.',
                        confirmButtonText: 'Cerrar',
                        icon: 'success',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        <?php
                        if ($obtenerSolicitudesCreadas > 0) {
                        ?>
                            Swal.fire({
                                title: 'Existen nuevas Solicitudes Creadas.',
                                confirmButtonText: 'Cerrar',
                                icon: 'info',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                <?php
                                if (isset($_GET['exitoCambioPassword'])) {
                                ?>

                                    Swal.fire(
                                        'Contrase&ntilde;a Modificada con Exito.',
                                        '',
                                        'success'
                                    )

                                <?php
                                }

                                ?>
                            })

                            <?php
                        } else {

                            if (isset($_GET['exitoCambioPassword'])) {
                            ?>

                                Swal.fire(
                                    'Contrase&ntilde;a Modificada con Exito.',
                                    '',
                                    'success'
                                )

                        <?php
                            }
                        }

                        ?>
                    })
                </script>
            <?php
            }


            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <h5><b>Bienvenido(a): </b><?php echo $nomUsuario; ?></h5>
                                    <h5><b>Departamento: </b><?php echo $rolUsuario2; ?></h5>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">


<h5><b>Herramientas</b></h5>
<br>
<div class="row">
    <div class="col-lg-3 col-12">
        <!-- small box -->
        <div class="small-box bg-primary">

            <div class="inner">

                <h4>Administrar</h4>
                <h4>Herramientas</h4>
                <br>
            </div>

            <div class="icon">
                <i class="nav-icon fas fa-tools"></i>

            </div>


            <a href="bodega-administrar.php" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>



        </div>

    </div>
    <div class="col-lg-3 col-12">
        <!-- small box -->
        <div class="small-box bg-secondary">

            <div class="inner">

                <h4>Arriendo </h4>
                <h4>Herramientas
                </h4>
                <br>
            </div>

            <div class="icon">
                <i class="nav-icon fas fa-door-open"></i>

            </div>


            <a href="arriendo-herramientas.php" class="small-box-footer">Arrendar <i class="fas fa-arrow-circle-right"></i></a>



        </div>

    </div>
    <!-- <div class="col-lg-3 col-12">
        
        <div class="small-box bg-warning">

            <div class="inner">

                <h4>Tickets</h4>
                <h4>Cancelados</h4>
                <br>
            </div>

            <div class="icon">
                <i class="nav-icon fas fa-list"></i>

            </div>


            <a href="solicitudes_canceladas.php" class="small-box-footer">Ingresar <i class="fas fa-arrow-circle-right"></i></a>



            
        </div>
    </div> -->
</div>

<hr>
<br>
<h5><b> Materiales</b></h5>
<br>

<div class="row">

    <div class="col-lg-3 col-12">
        <!-- small box -->
        <div class="small-box bg-info">

            <div class="inner">

                <h4>Administrar</h4>
                <h4>Materiales</h4>
                <br>
            </div>

            <div class="icon">
                <i class="nav-icon fas fa-box-open"></i>

            </div>


            <a href="materiales-administrar.php" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>



        </div>

    </div>
    <div class="col-lg-3 col-12">
        <!-- small box -->
        <div class="small-box bg-success">

            <div class="inner">

                <h4>Retiro</h4>
                <h4>Materiales</h4>
                <br>
            </div>

            <div class="icon">
                <i class="nav-icon fas fa-boxes"></i>

            </div>


            <a href="../sdo-bodega-pañol/error404/error.php" class="small-box-footer">Retirar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>


<hr>
<br>
<h5><b>Reservas Herramienta y/o Materiales por Solicitud Compra</b></h5>
<br>
<div class="row">
    <div class="col-lg-3 col-12">
        <!-- small box -->
        <div class="small-box bg-warning">

            <div class="inner">

                <h4>Administrar</h4>
                <h4>Reserva Herramientas y/o Materiales</h4>
                <br>
            </div>



            <div class="icon">
                <i class="nav-icon fas fa-door-closed"></i>

            </div>


            <a href="reserva-administrar.php" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>



        </div>

    </div>
    
    <!-- <div class="col-lg-3 col-12">
        
        <div class="small-box bg-warning">

            <div class="inner">

                <h4>Tickets</h4>
                <h4>Cancelados</h4>
                <br>
            </div>

            <div class="icon">
                <i class="nav-icon fas fa-list"></i>

            </div>


            <a href="solicitudes_canceladas.php" class="small-box-footer">Ingresar <i class="fas fa-arrow-circle-right"></i></a>



            
        </div>
    </div> -->
</div>


                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer id="copy" class="main-footer">
            <strong>Copyright &copy; 2022. Derechos Reservados.</strong>
        </footer>

        <script>

            const patito = document.getElementById('copy');

            patito.addEventListener('click', function(){
                Swal.fire({
                    title: 'No robar, derechos reservado... Te sacamos una foto, ojo!',
                    width: 400,
                    padding: '3em',
                    color: '#716add',
                    background: '#fff url(/images/trees.png)',
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://th.bing.com/th/id/R.83ccca24e417ccc34405f645cfbd70fd?rik=PPTivxLyssqHvg&riu=http%3a%2f%2fwww.canalgif.net%2fGifs-animados%2fSignos%2fCopyright%2fImagen-animada-Copyright-03.gif&ehk=mvGjnYet54lSZjaQ1z6zArj5qMzs4s3a%2bCjgh13BNQI%3d&risl=&pid=ImgRaw&r=0")
                        center right
                        repeat
                    
                    `
                    })
            })


            </script>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Page specific script -->

    
 
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "lengthMenu": "Visualizando _MENU_ Registros por P&aacute;gina",
                    "zeroRecords": "No se han encontrado Registros.",
                    "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
                    "infoEmpty": "No existen Registros.",
                    "infoFiltered": "(Filtrado desde _MAX_ Registros Totales)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
                }
            });
        });
    </script>
 

</body>

</html>