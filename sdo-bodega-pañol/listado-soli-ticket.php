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

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- DataTables -->
        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- AdminLTE css -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">

        <script src="../dist/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../dist/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="../dist/sweetalert2/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="css/estilos.css">

        <script src="../sdo-funciones/jquery-3.2.1.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                            <h4>Listado de solicitudes arriendo herramientas y/o retiro materiales ticket trabajo</h4>
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
                                    <a href="arriendo-retiro-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                    <br>
                                    <br>
                                    <a href="arriendo-retiro-ticket.php" style="float: right;" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Generar Nueva Solicitud</a>
                                    
                                    
                                    <h5>Colores para Identificar:</h5>
                                    <ul>
                                        <li>
                                            <i style="color : blue ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Pendiente  de asignación a ticket
                                        </li>
                                        <li>
                                            <i style="color : #DCE20E ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; En Curso
                                        </li>
                                        <li>
                                            <i style="color : #4BD30B ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Completada
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

                                        if(isset($_GET['errorEliminar'])){

                                            echo '<div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="fa fa-check"></i>&nbsp;Fallo la eliminación de la solicitud.</h5></div>';
    
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
                                                            <center>N° Solicitud<center>
                                                        </th>
                                                       
                                                        <th style="vertical-align:middle;">
                                                            <center>Fecha Ingreso<center>
                                                        </th>
                                                        <!-- <th style="vertical-align:middle;">
                                                            <center>Categoria Herramienta<center>
                                                        </th> -->
                                                        <th style="vertical-align:middle;">
                                                            <center>Personal Solicitante<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Departamento<center>
                                                        </th>
                                                       
                                                        <th style="vertical-align:middle;">
                                                            <center>Herramientas<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Materiales<center>
                                                        </th>

                                                        <th style="vertical-align:middle;">
                                                            <center>Estado<center>
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

                                                    $query = 'SELECT * FROM solicitudes_arriendo_retiro GROUP BY fechaSolicitud DESC;';

                                                    $res = mysqli_query($conexion, $query);

                                                    $numHerramienta = 1;

                                                    while ($row = $res->fetch_assoc()) {

                                                        $color = "";
                                                        $row['estadoSolicitud'];
                                                        $idSoli = $row['idSoli'];
                                                        if($row['estadoSolicitud'] == "En Curso"){

                                                            $color = "style=' background-color: #DCE20E; font-weight:bold;vertical-align:middle;color:black;'";
                                        
                                                        }else if($row['estadoSolicitud'] == "Completado"){
                                                            $color = "style=' background-color: #4BD30B;font-weight:bold;vertical-align:middle;color:black;'";

                                                        }else if($row['estadoSolicitud'] == "Pendiente"){
                                                            $color = "style=' background-color: blue;font-weight:bold;vertical-align:middle;color:black;'";

                                                        }
                                                    ?>
                                                        <tr >
                                                            
                                                            <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                <center>
                                                                    <?php

                                                                    $codSolicitud = mb_strtoupper($row['codSolicitud']);
                                                                    echo $codSolicitud;

                                                                    ?>
                                                                </center>
                                                            </td>
                                                       
                                                            <td nowrap="nowrap" style="vertical-align:middle; text-align:justify;font-weight:bold">
                                                                <center>
                                                                    <?php
                                                                     $fecha =  $row['fechaSolicitud'];
                                                                     echo $fecha;
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td nowrap="nowrap" style="vertical-align:middle; text-align:justify;font-weight:bold">
                                                                <center>
                                                                    <?php
                                                                               $idSolicitante = mb_strtoupper($row['idSolicitante']);                                                   
                                        
                                                                               $queryPersonal = "SELECT * FROM jefes_tecnicos WHERE idJefe  = ${idSolicitante}";
                                                                               $resPersonal = mysqli_query($conexion, $queryPersonal);
           
                                                                               while($rowPersonal = $resPersonal->fetch_assoc()){
           
                                                                                   $datos = [];
           
                                                                                   $datos['nomJefe'] = $rowPersonal['nomJefe'];
           
                                                                                   $nomJefe = $datos['nomJefe'];
           
           
                                                                               }
           
                                                                               echo mb_strtoupper($nomJefe);
           
                                                                               
           
                                                                               ?>
                                                                    
                                                                
                                                            <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                <center>
                                                                    <?php

                                                                    $idDepartamento = mb_strtoupper($row['idDepaSolicitante']);                                                   
                                        
                                                                    $queryDepa = "SELECT * FROM departamentos WHERE idDepartamento = ${idDepartamento}";
                                                                    $resDepa = mysqli_query($conexion, $queryDepa);

                                                                    while($rowDepa = $resDepa->fetch_assoc()){

                                                                        $datos = [];

                                                                        $datos['nomDepartamento'] = $rowDepa['nomDepartamento'];

                                                                        $nomDepartamento = $datos['nomDepartamento'];


                                                                    }

                                                                    echo mb_strtoupper($nomDepartamento);

                                                                    

                                                                    ?>
                                                                </center>
                                                            </td>                                     
                                                     
                                                            <td style="vertical-align: middle;font-weight:bold">
                                                                <center>    

                                                                    <?php 
                                                                    
                                                                    $queryHerramientas1 = "SELECT COUNT(*) total FROM herra_en_arriendo WHERE idSolicitud = ${idSoli}";
                                                                    $res4 = mysqli_query($conexion, $queryHerramientas1);

                                                                    $filas1 = mysqli_fetch_assoc($res4);

                                                                    
                                                                    if($filas1['total'] >= 1){

                                                                        ?>  
                                                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#herramientas<?php echo $idSoli ?>"><i class="fas fa-eye"></i></button>


                                                                        <?php


                                                                    }else{

                                                                        ?>

                                                                            <button title="SIN HERRAMIENTAS PARA MOSTRAR" disabled type="submit" class="btn btn-secondary" data-toggle="modal" data-target="#herramientas<?php echo $idSoli ?>"><i class="fas fa-eye"></i></button>



                                                                        <?php
                                                                        
                                                                    }
                                                                    
                                                                    
                                                                    ?>


                                                                    <div class="modal fade" id="herramientas<?php echo $idSoli ?>" name="herramientas<?php echo $idSoli ?>" tabindex="-1" role="dialog" aria-labelledby="EjemploModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="EjemploModalLabel">Listado Herramientas</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">×</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">

                                                                                            <table class="table">
                                                                                                <thead class="thead-light">
                                                                                                    <tr>
                                                                                                        
                                                                                                        <th scope="col" class="text-center">CÓDIGO</th>
                                                                                                        <th scope="col" class="text-center">NOMBRE</th>
                                                                                                        <th scope="col" class="text-center">IMAGEN</th>                                                                                                 
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <?php  

                                                                                                $queryHerramientas = "SELECT * FROM herra_en_arriendo WHERE idSolicitud = ${idSoli}";
                                                                                                $res1 = mysqli_query($conexion, $queryHerramientas);


                                                                                                foreach($res1 as $indice => $herramienta):
                                                                                                    
                                                                                                    
                                                                                                ?>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            
                                                                                                            <td class="text-center"><?php echo $herramienta['codHerramienta']?></td>
                                                                                                            <td class="text-center"><?php echo $herramienta['nomHerramienta']?></td>
                                                                                                            <td class="text-center"><?php echo $herramienta['cantidadHerramienta']?></td>
                                                                                                                                                                                                                     
                                                                                                        </tr>                                                          
                                                                                                    </tbody>

                                                                                                <?php
                                                                                                endforeach;
                                                                                                ?>
                                                                                            </table>


                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-success" data-dismiss="modal">Revisado!</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                    </div>

                                                                    
                                                                    
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align: middle;font-weight:bold">
                                                                <center>
                                                                    
                                                                    <?php 

                                                                        $queryMateriales = "SELECT COUNT(*) total FROM material_retirado WHERE idSolicitud = ${idSoli}";
                                                                        $res2 = mysqli_query($conexion, $queryMateriales);

                                                                        $filas = mysqli_fetch_assoc($res2);

                                                                        

                                                                        if($filas['total'] >= 1){

                                                                            ?>  
                                                                                    <button  class="btn btn-info" data-toggle="modal" data-target="#materiales<?php echo $idSoli ?>"><i class="fas fa-eye"></i></button>

                                                                            <?php


                                                                        }else{

                                                                            ?>

                                                                                    <button disabled title="SIN MATERIALES PARA MOSTRAR" class="btn btn-secondary" data-toggle="modal" data-target="#materiales<?php echo $idSoli ?>"><i class="fas fa-eye"></i></button>


                                                                            <?php
                                                                            
                                                                        }


                                                                    ?>
                                                                    

                                                                    <div class="modal fade" id="materiales<?php echo $idSoli ?>" name="materiales<?php echo $idSoli ?>" tabindex="-1" role="dialog" aria-labelledby="EjemploModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="EjemploModalLabel">Listado Materiales</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">×</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">

                                                                                        <?php  

                                                                                            $queryMateriales1 = "SELECT *  FROM material_retirado WHERE idSolicitud = ${idSoli}";
                                                                                            $res3 = mysqli_query($conexion, $queryMateriales1);
                                                                                            ?>

                                                                                            <table class="table">
                                                                                                <thead class="thead-light">
                                                                                                    <tr>
                                                                                                        
                                                                                                        <th scope="col" class="text-center">CÓDIGO</th>
                                                                                                        <th scope="col" class="text-center">NOMBRE</th>
                                                                                                        <th scope="col" class="text-center">IMAGEN</th>                                                                                                 
                                                                                                    </tr>
                                                                                                </thead>
                                                                                              
                                                                                            <?php
                                                                                            
                                                                                               
                                                                                                foreach($res3 as $indice => $material): 
                                                                                            ?>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            
                                                                                                            <td class="text-center"><?php echo $material['codMaterial']?></td>
                                                                                                            <td class="text-center"><?php echo $material['nomMaterial']?></td>
                                                                                                            <td class="text-center"><?php echo $material['cantidadMaterial']?></td>
                                                                                                                                                                                                                     
                                                                                                        </tr>                                                          
                                                                                                    </tbody>

                                                                                                <?php
                                                                                                endforeach;
                                                                                                     
                                                                                                      
                                                                                                ?>
                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-success" data-dismiss="modal">Revisado!</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                    </div>

                                                                    
                                                                </center>
                                                            </td>
                                                            <td <?php echo $color?>>
                                                                <center>

                                                                    <?php 

                                                                        $estado = mb_strtoupper($row['estadoSolicitud']);
                                                                        echo $estado;

                                                                        ?>

                                                                            <br>
                                                                            <button type="button" class="btn btn-xs  btn-success" data-toggle="modal" data-target="#idSoli<?php echo $idSoli ?>"><i class="nav-icon fa fa-edit"></i></button> 


                                                                            <div class="modal fade" id="idSoli<?php echo $idSoli ?>" name="idSoli<?php echo $idSoli ?>" tabindex="-1" role="dialog" aria-labelledby="EjemploModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="EjemploModalLabel">Modificar Estado</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">×</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div style="text-align:left;" class="form-group">
                                                                                                <label for="exampleInputBorder">Nuevo Estado: <code>*</code></label>
                                                                                                <select name="nuevoEstado" id="nuevoEstado" require class="form-control">
                                                                                                    <option value="" disabled selected>-- Seleccione --</option>
                                                                                                    <option value="En Proceso">En Proceso</option>
                                                                                                    <option value="En Pañol">En Pañol</option>
                                                                                                    <option value="Entregado">Entregado</option>
                                                                                                    <option value="Anulado">Anulado</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                            <input type="submit" class="btn btn-primary" value="Modificar" id="modificar"></input>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        <?php

                                                                    ?>
                                                                    
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align: middle;font-weight:bold">
                                                                <center>

                                                                <form action="">

                                                                    <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i></button>

                                                                </form>
                                                                    
                                                                </center>
                                                            </td>
                                                            <td style="vertical-align: middle;font-weight:bold">
                                                                <center>

                                                                    <form action="eliminar-arriendo-retiro.php" method="POST">

                                                                        <input type="hidden" name="idSoli" value="<?php echo $idSoli ?>"> 
                                                                        <input type="hidden" name="codigo" value="<?php echo $codSolicitud ?>">                                                                 
                                                                        <input type="hidden" name="idDepartamento" value="<?php echo $idDepartamento ?>"> 
                                                                        <input type="hidden" name="idSolicitante" value="<?php echo $idSolicitante ?>">  
                                                                        <input type="hidden" name="fechaIngreso" value="<?php echo $fecha ?>">  
                                                             


                                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

                                                                    </form>
                                                                    
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
                                                            <center>N° Solicitud<center>
                                                        </th>
                                                       
                                                        <th style="vertical-align:middle;">
                                                            <center>Fecha Ingreso<center>
                                                        </th>
                                                        <!-- <th style="vertical-align:middle;">
                                                            <center>Categoria Herramienta<center>
                                                        </th> -->
                                                        <th style="vertical-align:middle;">
                                                            <center>Personal Solicitante<center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Departamento<center>
                                                        </th>
                                                       
                                                        <th style="vertical-align:middle;">
                                                            <center>Herramientas <center>
                                                        </th>
                                                        <th style="vertical-align:middle;">
                                                            <center>Materiales <center>
                                                        </th>

                                                        <th style="vertical-align:middle;">
                                                            <center>Estado<center>
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