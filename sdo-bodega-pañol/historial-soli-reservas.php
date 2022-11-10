<?php

include '../sdo-funciones/conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial Ingreso de Herramientas</title>

    <link rel="icon" href="../dist/img/ss-vina-quillota.png" type="image/icon type">
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
</head>

<body class="hold-transition sidebar-mini dark-mode">

    <div class="preloader  flex-column justify-content-center align-items-center">

        <img class="animation__shake" src="../dist/img/ssvq1.png" alt="logo">
        <br>
        <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>

    </div>

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
                            <h4>Historial Solicitudes Reservas Herramientas </h4>
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

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <a href="reserva-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                    <br>
                                    <br>
                                    <a href="reservar-soli-compra.php" style="float: right;" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar nueva solicitud</a>
                                    <br>

                                    <?php 
                                    
                                        if(isset($_GET['finalizado'])){
                                            
                                            ?>

                                            <script>
                                                Swal.fire({  
                                                    title: 'Solicitud de reserva finalizada con &Eacute;xito.',
                                                    body: 'Para agregar una nueva solicitud haga click en "Agregar nueva solicitud" en la parte superior',
                                                    confirmButtonText: 'Cerrar',
                                                    icon: 'success',
                                                    }
                                                )
                                            </script>
                                                                                        <?php
                                        }
                                    
                                    
                                    ?>


                                    <!-- <a href="ingreso-herramientas.php" style="float: right;" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Nueva Herramienta</a> -->

                                    <br>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive">
                                        <table style="font-size:90%" id="example2" class="table table-bordered table-hover">
                                            <thead class="bg-secondary">
                                                <tr>
                                                    <th style="vertical-align:middle;">
                                                        <center>N° Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitante</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Departamento</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitud Compra Referente</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Numero de Compra</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Fecha Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Fecha Finalización</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Email Contacto</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Estado Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Descargar Orden Compra</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Ver solicitud reserva</center>
                                                    </th>
                                                  
        
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "SELECT * FROM solicitudes_reserva_finalizadas ORDER BY fechaSoliReserva DESC";

                                                $res = mysqli_query($conexion, $query);

                                  

                                                $numSolicitud = 1;

                                                while ($row = $res->fetch_assoc()) {

                                                  $idReservado = $row['idSoliReserva'];
                                                  $pdf = $row['nomArchivo'];
                                                  $numCompra = $row['numeroCompra'];

                                               

                                                ?>
                                                    <tr>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <center>
                                                                <?php 
                                                                    $reserva = mb_strtoupper($row['numReserva']);
                                                                    echo $reserva;

                                                                ?>
                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php

                                                                $solicitante = mb_strtoupper($row['idPersonal']);

                                                                $query1 = "SELECT * FROM jefes_tecnicos WHERE idJefe = ${solicitante}";
                                                                $res1 = mysqli_query($conexion, $query1);

                                                                while($row1 = $res1->fetch_assoc()){

                                                                    $dato1 = [];
                                                                    $dato1['jefe'] = $row1['nomJefe'];

                                                                    $nomJefe = $dato1['jefe'];
                                                                }

                                                                echo $nomJefe;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php

                                                                $idDepartamento = mb_strtoupper($row['idDepartamento']);

                                                                $query2 = "SELECT * FROM departamentos WHERE idDepartamento = ${idDepartamento}";
                                                                $res2 = mysqli_query($conexion, $query2);

                                                                while($row2 = $res2->fetch_assoc()){

                                                                    $dato2 = [];
                                                                    $dato2['nomDepa'] = $row2['nomDepartamento'];

                                                                    $nomDepa = $dato2['nomDepa'];
                                                                }

                                                                echo $nomDepa;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php
                                                            $folioSoliCompra = mb_strtoupper($row['folioSoliCompra']);
                                                            echo $folioSoliCompra;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php
                                                            $numeroCompra = mb_strtoupper($row['numeroCompra']);
                                                            echo $numeroCompra;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <center>
                                                                <?php if ($row['fechaSoliReserva'] == 0) {
                                                                    echo "No registra fecha";
                                                                } else {

                                                                    $inicioFecha =  date('d/M/Y', (strtotime(str_replace('/', '-', $row['fechaSoliReserva']))));
                                                                    $inicioHora = date('H:i', strtotime($row['fechaSoliReserva']));

                                                                    echo $inicioFecha . '<br>' . $inicioHora;
                                                                } ?>
                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <center>
                                                                <?php if ($row['fechaSoliFinalizacion'] == 0) {
                                                                    echo "No registra fecha";
                                                                } else {

                                                                    $inicioFecha =  date('d/M/Y', (strtotime(str_replace('/', '-', $row['fechaSoliFinalizacion']))));
                                                                    $inicioHora = date('H:i', strtotime($row['fechaSoliFinalizacion']));

                                                                    echo $inicioFecha . '<br>' . $inicioHora;
                                                                } ?>
                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php
                                                            $email = mb_strtoupper($row['email']);
                                                            echo $email;

                                                            ?>
                                                        </td>
                                                     
                                                        
                                                        <td style="vertical-align:middle;">
                                                            <center>
                                                                <?php
                                                                    $estado = mb_strtoupper($row['estadoSoliReserva']);
                                                                    echo $estado;

                                                                    ?>

                                                                  
                                                                    <?php 
                                                                ?>

                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;">
                                                            <center>
                                                                <?php


                                                                ?>

                                                                
                                                                <a href="pdfs/<?php echo $pdf ?>" class="btn btn-success btn-block" download="Orden-Compra-<?php echo $numCompra ?>"><i class="fas fa-download"></i></a>
                                                                <!-- <button type="submit" target="_blanck" id="inputMozi" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></button> -->


                                                              
                                                                <?php
                                                                ?>


                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;">
                                                            <center>
                                                            <?php
                                                                  

                                                                  ?>
                                                                      <form action="visualizarReservaHis.php" method="POST" target="_blank" >
                                                                            <input type="hidden" name="idReserva" value="<?php echo $idReservado ;?>">
                                                                            <input type="hidden" value="<?php echo  $idDepartamento?>" name="idDepartamento">
                                                                            <input type="hidden" value="<?php echo  $folioSoliCompra?>" name="folioSoliCompra">
                                                                            <input type="hidden" value="<?php echo  $reserva?>" name="numSolicitud">
                                                                            <input type="hidden" value="<?php echo  $fechaSoliReserva?>" name="fechaSoliReserva">
                                                                            <input type="hidden" name="numReserva" value="<?php echo $reserva ;?>">
                                                                          <button type="submit" target="_blanck" id="inputMozi" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></button>

                                                                          
                                                                      </form>
                                                                  <?php 
                                                              ?>
                                                         

                                                            </center>
                                                        </td>
                                                        


                                                    <?php

                                                    $numSolicitud = $numSolicitud + 1;
                                                }
                                                    ?>

                                                    </tr>
                                            </tbody>
                                            <tfoot class="bg-secondary">
                                                <tr>
                                                     <th style="vertical-align:middle;">
                                                        <center>N° Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitante</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Departamento</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitud Compra Referente</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Numero de Compra</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Fecha Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Fecha Finalización</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Email Contacto</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Estado Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Descargar Orden Compra</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Ver solicitud reserva</center>
                                                    </th>
                                                   
                                                </tr>
                                            </tfoot>
                                        </table>

                                        </div>
                                    </div>
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
        <footer class="main-footer">
            <strong>Copyright &copy; 2022. Derechos Reservados.
        </footer>

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
                    "search": "Buscar:",
                    "infoFiltered": "(Filtrado desde _MAX_ Registros Totales)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
                }
            });
        });
    </script>
    <script src="js/color.js"></script>
</body>

</html>