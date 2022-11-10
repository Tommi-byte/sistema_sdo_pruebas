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
    <title>Listado de Herramientas</title>

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
    <link rel="stylesheet" href="css/estilos.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<body class="hold-transition sidebar-mini dark-mode" id="body">
    <div class="wrapper">

    <div class="preloader  flex-column justify-content-center align-items-center">

        <img class="animation__shake" src="../dist/img/ssvq1.png" alt="logo">
        <br>
        <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>

    </div>
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
                            <h4>Listado de Herramientas</h4>
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
                                    <a href="bodega-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                    <br>
                                    <br>
                                    <a href="ingreso-herramientas.php" style="float: right;" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Nueva Herramienta</a>
                                    
                                    
                                    <h5>Colores para Identificar:</h5>
                                    <ul>
                                        <li>
                                            <i style="color : #4BD30B ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Cantidad superior a 10 unidades
                                        </li>
                                        <li>
                                            <i style="color : #DCE20E ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Cantidad entre 3 y 10 unidades
                                        </li><li>
                                            <i style="color : #E05214 ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Cantidad inferior a 2 unidades
                                        </li>

                                    </ul>
                                    <br>
                                    <br>
                                    <?php

                                        if(isset($_GET['exitoCrearHerramienta'])){

                                            echo '<div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="fa fa-check"></i>&nbsp;Herramienta Guardada Correctamente.</h5></div>';

                                        }

                                        if(isset($_GET['eliminado'])){

                                            echo '<div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="fa fa-x"></i>&nbsp;Registro de la herramienta Eliminada.</h5></div>';
    
                                        }

                                        if(isset($_GET['modificacion'])){

                                            echo '<div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="fa fa-check"></i>&nbsp;Registro de la herramienta Modificada.</h5></div>';
    
                                        }
                                    ?>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th style="vertical-align:middle;">
                                                            <center>Codigo Herramienta<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Uso Departamento<center>
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
                                                            <center>Cantidad <center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Fecha Ingreso<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Descripción Herramienta <center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Modificar <center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Eliminar <center>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $query = 'SELECT * FROM pañol_herramientas GROUP BY idHerramienta DESC;';

                                                    $res = mysqli_query($conexion, $query);

                                                    $numHerramienta = 1;

                                                    while ($row = $res->fetch_assoc()) {


                                                        $color = "";
                                                        $cantidad = $row['cantHerramienta'];
                                                        if($cantidad >= 10){

                                                            $color = "style=' background-color: #4BD30B; font-weight:bold;vertical-align:middle;'";
                                        
                                                        }else if($cantidad <= 9 && $cantidad >= 3){
                                                            $color = "style=' background-color: #DCE20E;font-weight:bold;vertical-align:middle;'";

                                                        }else { 
                                                            $color = "style=' background-color: #E05214;font-weight:bold;vertical-align:middle;'";
                                                        }
                                                    ?>
                                                        <tr >
                                                            
                                                            <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                <center>
                                                                    <?php

                                                                    $codigo = mb_strtoupper($row['codHerramienta']);
                                                                    echo $codigo;

                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                <center>
                                                                    <?php

                                                                    $idDepartamento = mb_strtoupper($row['idDepartamento']);

                                                                    // $queryDepa = "SELECT * FROM departamentos WHERE idDepartamento = ${idDepartamento}";
                                                                    // $resDepa = mysqli_close($conexion, $queryDepa);

                                                                    

                                                                    

                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td nowrap="nowrap" style="vertical-align:middle; text-align:justify;font-weight:bold">
                                                                <center>
                                                                    <?php
                                                                    echo $row['nomHerramienta'];
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td nowrap="nowrap" style="vertical-align:middle; text-align:justify;font-weight:bold">
                                                                <center>
                                                                    <?php
                                                                    $idCategoria = $row['idCategoria'];
                                                                    $query = 'SELECT * FROM categorias_herramienta WHERE idCategoria = "' . $idCategoria. '"';
                                                                    $res1 = mysqli_query($conexion, $query);

                                                                    while($rowCategorias = $res1->fetch_assoc()){

                                                                        $nomCategoria = $rowCategorias['nomCategoria'];
                                                                        echo $nomCategoria;
                                                                    }
                                                                   
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td  nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                <center>
                                                                    <?php echo mb_strtoupper($row['marcaHerramienta']); ?>
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align:middle;font-weight:bold">
                                                                <center>
                                                                    <?php
                                                                    // if ($row['fechaActa'] == 0) {
                                                                    //     echo "No registra fecha";
                                                                    // } else {
                                                                    //     $inicioFecha = date('d/m/Y', strtotime(str_replace('/', '-', $row['fechaActa'])));
                                                                    //     $inicioHora = date('H:i', strtotime($row['fechaActa']));
                                                                    //     echo $inicioFecha . '<br>' . $inicioHora;
                                                                    // }

                                                                    echo mb_strtoupper($row['modeloHerramienta']); 
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td <?php echo $color ?> style="">
                                                                <center>
                                                                    <?php

                                                                    echo mb_strtoupper($row['cantHerramienta']);

                   
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align:middle; text-align:justify;font-weight:bold">
                                                                <center>
                                                                    <?php
                                                                    echo mb_strtoupper($row['fechaIngreso']);
                                                                    ?>
                                                                </center>
                                                            </td>                                     
                                                            <td style="vertical-align:middle; text-align:justify;font-weight:bold">
                                                                <center>
                                                                    <?php
                                                                    echo $row['descriptHerramienta'];
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align: middle;font-weight:bold">
                                                                <center>
                                                                    <?php 
                                                                    $idHerramienta = $row['idHerramienta'];
                                                                    $idHerramienta = trim($idHerramienta);
                                                                    if($idHerramienta == 0 || $idHerramienta == "" || $idHerramienta == " "|| $idHerramienta == "  "){
                                                                        ?>
                                                                        <center><?php echo "Error al cargar datos";?></center>
                                                                    <?php 
                                                                    } else{
                                                                        ?>
                                                                        <form action="herramientas-modificar-completo.php" method="POST" style="margin: 0;text-align:center;" class="">
                                                                    
                                                                            <input type="hidden" name="idHerramienta" value="<?php echo $idHerramienta ;?>">
                                                                           
                                                                            <button type="submit" id="inputMozi" class="btn btn-block btn-warning"><i class="fas fa-pen"></i></button>
                                                                        </form>

                                                                        <?php

                                                                    }
                                                                        ?>
                                                                    
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align: middle;font-weight:bold">
                                                                <center>
                                                                    <?php 
                                                                    $idHerramienta = $row['idHerramienta'];
                                                                    $idHerramienta = trim($idHerramienta);
                                                                    if($idHerramienta == 0 || $idHerramienta == "" || $idHerramienta == " "|| $idHerramienta == "  "){
                                                                        ?>
                                                                        <center><?php echo "Error al cargar datos";?></center>
                                                                    <?php 
                                                                    } else{
                                                                        ?>
                                                                        <form action="herramientas-eliminar.php" class="form-group" method="POST" id="eliminar" style="margin: 0;text-align:center;" class="">
                                                                    
                                                                            <input type="hidden" name="idHerramienta" value="<?php echo $idHerramienta ;?>">
                                                                            <button type="submit" onclick="confirmar(event, <?php echo $idHerramienta?>)" id="inputMozi" class="btn btn-block btn-danger"><i class="fas fa-trash"></i></button>
                                                                            
                                                                        </form>

                                                                        <?php

                                                                    }
                                                                        ?>

                                                                        <!-- REVISAR MAS ADELANTE-->
                                                                        <!-- <script type="text/javascript">

                                                                                form = document.getElementById('eliminar');

                                                                                function confirmar(event, id) {  
                                                                                    event.preventDefault();

                                                                                    Swal.fire({
                                                                                        title: '¿Estás seguro?',                
                                                                                        icon: 'warning',
                                                                                        showCancelButton: true,
                                                                                        cancelButtonColor: '#d33',
                                                                                        confirmButtonText: 'Si',
                                                                                        cancelButtonText: 'Cancelar'
                                                                                    }).then((result) => {
                                                                                        if (result.isConfirmed) {
                                                                                            
                                                                                            form.submit();
                                                                                            // $.ajax({
                                                                                                
                                                                                            //     type: 'POST',
                                                                                            //     url: 'herramientas-eliminar.php',
                                                                                            //     data: {id: idHerramienta},
                                                                                            //     success: function(data){
                                                                                            //         Swal.fire({
                                                                                            //             icon: success,
                                                                                            //             title: 'Herramienta eliminada Correctamente :)',
                                                                                            //             showConfirmButton: false,
                                                                                            //             timer: 1500,
                                                                                            //         })  
                                                                                            //     }
                                                                                            


                                                                                            // })
                                                                                        }
                                                                                    })
                                                                                }
                                                                           

                                                                            
                                                                        </script>  -->
                                                                    
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
                                                            <center>Uso Departamento<center>
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
                                                            <center>Descripción Herramienta<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Modificar<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Eliminar<center>
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