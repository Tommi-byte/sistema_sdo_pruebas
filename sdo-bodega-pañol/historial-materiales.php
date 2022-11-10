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
    <title>Historial Ingreso de Materiales</title>

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
                            <h4>Historial Ingreso de Materiales</h4>
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
                                    <a href="materiales-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                    <br>
                                    <br>
                                    <!-- <a href="ingreso-herramientas.php" style="float: right;" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Nueva Herramienta</a> -->

                                    <br>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th style="vertical-align:middle;">
                                                            <center>Codigo Material<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Nombre Material<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Categoria Material<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Marca Material<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Modelo Material<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Cantidad <center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Fecha Ingreso<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Fecha Vencimiento<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Actualización de ingreso/modificación  <center>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $query = 'SELECT * FROM pañol_materiales_historial GROUP BY idMaterial DESC;';

                                                    $res = mysqli_query($conexion, $query);

                                                    $numHerramienta = 1;

                                                    while ($row = $res->fetch_assoc()) {
                                                    ?>
                                                        <tr>
                                                            
                                                            <td nowrap="nowrap" style="vertical-align:middle;">
                                                                <center>
                                                                    <?php

                                                                    $codigo = mb_strtoupper($row['codMaterial']);
                                                                    echo $codigo;

                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td nowrap="nowrap" style="vertical-align:middle; text-align:justify;">
                                                                <center>
                                                                    <?php
                                                                    echo $row['nomMaterial'];
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td nowrap="nowrap" style="vertical-align:middle; text-align:justify;">
                                                                <center>
                                                                <?php
                                                                    $idCategoria = $row['idCategoria'];
                                                                    $query = 'SELECT * FROM categorias_material WHERE idCategoria = "' . $idCategoria. '"';
                                                                    $res1 = mysqli_query($conexion, $query);

                                                                    while($rowCategorias = $res1->fetch_assoc()){

                                                                        $nomCategoria = $rowCategorias['nomCategoria'];
                                                                        echo $nomCategoria;
                                                                    }
                                                                   
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td nowrap="nowrap" style="vertical-align:middle;">
                                                                <center>
                                                                    <?php echo mb_strtoupper($row['marcaMaterial']); ?>
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align:middle;">
                                                                <center>
                                                                    <?php
                                                                    // if ($row['fechaActa'] == 0) {
                                                                    //     echo "No registra fecha";
                                                                    // } else {
                                                                    //     $inicioFecha = date('d/m/Y', strtotime(str_replace('/', '-', $row['fechaActa'])));
                                                                    //     $inicioHora = date('H:i', strtotime($row['fechaActa']));
                                                                    //     echo $inicioFecha . '<br>' . $inicioHora;
                                                                    // }

                                                                    echo mb_strtoupper($row['modeloMaterial']); 
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align:middle; text-align:justify;">
                                                                <center>
                                                                    <?php
                                                                    echo mb_strtoupper($row['cantMaterial']);
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align:middle; text-align:justify;">
                                                                <center>
                                                                    <?php
                                                                    echo mb_strtoupper($row['fechaIngreso']);
                                                                    ?>
                                                                </center>
                                                            </td>     
                                                            <td style="vertical-align:middle; text-align:justify;">
                                                                <center>
                                                                    <?php
                                                                    echo mb_strtoupper($row['fechaVencimiento']);
                                                                    ?>
                                                                </center>
                                                            </td>                                
                                                            <td style="vertical-align:middle; text-align:justify;">
                                                                <center>
                                                                    <?php
                                                                    echo $row['descriptMaterial'];
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            
                                                            
                                                        </tr>
                                                    <?php

                                                        $numHerramienta++;
                                                    }


                                                    ?>



                                                </tbody>
                                                <tfoot class="bg-secondary">
                                                    <tr>
                                                        <th style="vertical-align:middle;">
                                                            <center>Codigo Herramienta<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Nombre Herramienta<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Categoria Herramienta<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Marca Herramienta<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Modelo Herramienta<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Cantidad<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Fecha Ingreso<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Fecha Vencimiento<center>
                                                        </th>                                           
                                                        <th style="vertical-align:middle;">
                                                            <center>Actualización de ingreso/modificación <center>
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
</body>

</html>