<?php
include '../sdo-funciones/conexion.php';

include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


date_default_timezone_set('America/Santiago');


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Men&uacute; Arriendo Herramientas</title>

        <!-- Google Font: Source Sans Pro -->
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


        <script type="text/javascript">
            $(document).ready(function() {
                recargarSubDepartamento();
                recargarNomDepartamento();
                recargarListTecnicos();

                $('#departamentoSolicitante').change(function() {
                    recargarSubDepartamento();
                    recargarListTecnicos();
                });

                $('#servicioOrden').change(function() {
                    recargarNomDepartamento();
                });


                function recargarSubDepartamento() {

                    $.ajax({
                        type: "POST",
                        url: "sdo-datos-departamentos/mostrarSubDepartamentos.php",
                        data: "idDepartamento=" + $('#departamentoSolicitante').val(),
                        success: function(r) {
                            $('#visualizarSubDepartamento').html(r);


                        }
                    });

                };

                function recargarNomDepartamento() {

                    $.ajax({
                        type: "POST",
                        url: "sdo-datos-servicios/habilitarIngresoServicio.php",
                        data: "idServicio=" + $('#servicioOrden').val(),
                        success: function(r) {
                            $('#visualizarNomServicio').html(r);


                        }
                    });

                };


                function recargarListTecnicos() {

                    $.ajax({
                        type: "POST",
                        url: "sdo-datos-tecnicos/cargarTecnicos3.php",
                        data: "idDepartamento=" + $('#departamentoSolicitante').val(),
                        success: function(r) {

                            if (r == 0) {

                                var cadena = "";

                                cadena = cadena + '<div class="input-group-prepend">';

                                cadena = cadena + '<span class="input-group-text"><i class="fas fa-user"></i></span>';

                                cadena = cadena + '<span class="input-group-text w-100">No Existen Tecnicos en este Departamento.</span>';

                                cadena = cadena + '</div>';

                                $('#htmlSelect').html(cadena);

                                var btnDelCentral = document.getElementById("guardarRecepcion");

                                btnDelCentral.removeAttribute("enabled", "");

                                btnDelCentral.setAttribute("disabled", "");

                            } else if (r == "error" || r == "ERROR" || r == "Error") {

                                var cadena = "";

                                cadena = cadena + '<div class="input-group-prepend">';

                                cadena = cadena + '<span class="input-group-text"><i class="fas fa-user"></i></span>';

                                cadena = cadena + '<span class="input-group-text w-100">Error al Obtener Datos.</span>';

                                cadena = cadena + '</div>';

                                $('#htmlSelect').html(cadena);

                                var btnDelCentral = document.getElementById("guardarRecepcion");

                                btnDelCentral.removeAttribute("enabled", "");

                                btnDelCentral.setAttribute("disabled", "");

                            } else {
                                $('#htmlSelect').html(r);

                                var btnDelCentral = document.getElementById("guardarRecepcion");

                                btnDelCentral.removeAttribute("disabled", "");

                                btnDelCentral.setAttribute("enabled", "");

                            }

                        }
                    });

                    };
                });
        </script>
        
        <script>
            $(document).ready(function() {


                // Show div by removing inline display none style rule
                $(".show-realizar").click(function() {
                    $("#rowMenu2").show();
                    $("#rowMenu1").hide();
                    $("#listarSC").show();
                    $("#realizarSC").hide();
                });

                // Show div by removing inline display none style rule
                $(".show-listar").click(function() {
                    $("#rowMenu2").hide();
                    $("#rowMenu1").show();
                    $("#listarSC").hide();
                    $("#realizarSC").show();
                });
            });
        </script>
        <script>
            function DoCheckUncheckDisplay(d, dchecked, dunchecked) {
                if (d.checked == true) {
                    document.getElementById(dchecked).style.display = "block";
                    document.getElementById(dunchecked).style.display = "none";
                } else {
                    document.getElementById(dchecked).style.display = "none";
                    document.getElementById(dunchecked).style.display = "block";
                }
            }
        </script>
        <script type="text/javascript">
            window.addEventListener("load", function() {
                let tabs = document.querySelectorAll(".nav-tabs a");

                let nextTab = document.getElementById("siguiente");

                let i = 0;

                nextTab.addEventListener("click", function() {

                    i = (i == (tabs.length - 1)) ? 0 : i + 1;
                    tabs[i].click();

                }, false);
            }, false);
        </script>
        <script type="text/javascript">

            

            function cambiar(){

                var departamentoSolicitante = document.getElementById('departamentoSolicitante');
                var nomTecnicoRecepcionador = document.getElementById('nomTecnicoRecepcionador');

                var selected = departamentoSolicitante.options[departamentoSolicitante.selectedIndex].text;
                var selected1 = nomTecnicoRecepcionador.options[nomTecnicoRecepcionador.selectedIndex].text;

                var departamento = document.getElementById('departamento');
                departamento.value = selected;

                var personal = document.getElementById('personal');
                personal.value = selected1;

            }                                                        

        </script>
    </head>
    <body class="hold-transition sidebar-mini dark-mode">
        
        <!-- Site  wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
                <?php include '../sdo-templates/bodega-panol-sidebar.php'?>
            <!-- .navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h4>Arriendo herramientas y/o retiro materiales por ticket de trabajo</h4>

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
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Alertas Sweet Alert 2-->

                <?php 
                
                
                
                
                
                ?>
                
                <!-- Main Content -->
                <section class="content">
                    <div class="container-fluid">

                    <!-- general form elements -->
                   <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Información Solicitud Arriendo o Retiro Materiales Ticket de Trabajo</h3>
                        </div>

                        
                            
                        <div class="row">

                            <!-- left column -->
                            <div class="col-md-12">

                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <a href="bodega-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                        <br>
                                        <br>

                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            
                                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="font-weight: 900;"> Solicitante</a>
                                            
                                            
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="font-weight: 900;">Herramientas</a>
                                           
                                            
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false" style="font-weight: 900;">Materiales</a>
                                            
                                            
                                                <a class="nav-link" id="pills-resumen-tab" data-toggle="pill" href="#pills-resumen" role="tab" aria-controls="pills-contact" aria-selected="false" style="font-weight: 900;">Resumen </a>
                                        
                                        </div>

                                        <form action="guardar-arriendo-retiro.php" method="post" enctype="multipart/form-data">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                    
                                            
                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Información Personal:</legend>

                                                <div class="form-row">
                                                <div class="form-group col-md-6">

                                                <label for="departamentoSolicitante">Departamento: <code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                    </div>

                                                    <select required name="departamentoSolicitante" id="departamentoSolicitante" class="form-control" onchange="cambiar()">
                                                        <option value="" disabled selected> -- Seleccione --</option>
                                                        <?php

                                                        $queryPersonal = "SELECT * FROM departamentos";
                                                        $res = mysqli_query($conexion, $queryPersonal);

                                                        while ($row = $res->fetch_assoc()) {
                                                            if ($row['idDepartamento'] == $idDepartamento) {
                                                        ?>



                                                                <option value="<?php echo   $row['idDepartamento']; ?>">
                                                                    <?php echo $row['nomDepartamento']; ?>

                                                                </option>


                                                            <?php
                                                            } else {

                                                            ?>
                                                                <option value="<?php echo $row['idDepartamento'] ?>">
                                                                    <?php echo $row['nomDepartamento'] ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }


                                                        ?>
                                                    </select>
                                                    <!-- <input id="codigo" style="resize:none;" required name="codigo" class="form-control"  placeholder="Código Soli. Compra"> -->

                                                    </div>
                                                </div>

                                                    <div class="form-group col-md-6">
                                                        <label >Personal Solicitante:<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <!-- <span class="input-group-text"><i class="fas fa-user"></i></span> -->
                                                            </div>
                                                            <div style="width: 100%;" id="htmlSelect" name="htmlSelect"></div>
                                                            <!-- <select name="personalSolicita" id="personal" name="personalSolicita" class="form-control">
                                                                <option value="" selected>-- Seleccione --</option>
                                                                <?php

                                                                /*$queryPersonal = "SELECT * FROM jefes_tecnicos";

                                                                    $res = mysqli_query($conexion, $queryPersonal);

                                                                    while($row = $res->fetch_assoc()){

                                                                        ?>

                                                                            <option value="<?php echo $row['idJefe'];?>">
                                                                                <?php  echo $row['nomJefe'] . ' - ' .$row['cargoJefe']; ?>
                                                                                
                                                                            </option>
                                                                            

                                                                        <?php 




                                                                    }*/


                                                                ?>    
                                                            </select> -->

                                                            <!-- <input  readonly id="codigo" style="resize:none;" required name="codigo" class="form-control"  placeholder="N° de reserva"> -->



                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputNomTarjeta">Fecha Ingreso:<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="far fa-calendar-times"></i></span>
                                                            </div>
                                                            
                                                            <input disabled  type="text" required style="text-transform:capitalize" class="form-control" id="rutTarjeta" name="ingreso" value="<?php echo date('Y/m/d'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                            </fieldset>

                                            
    
                                            
                        
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Herramientas Disponibles:</legend>
                                                                    
                                                <div class="table-responsive">
                                                    <table style="font-size: 90%;" id="example2" class="table table-bordered table-hover">
                                                        <thead class="bg-secondary">
                                                        <tr>
                                                                <th style="vertical-align: middle;">
                                                                    <center>N°</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Imagen</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Código</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Nombre</center>  
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>En Stock</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Agregar</center> 
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php 

                                                            $queryHerramientas = "SELECT * FROM pañol_herramientas ORDER BY idHerramienta  DESC";
                                                            $resHerramientas = mysqli_query($conexion, $queryHerramientas);

                                                            while($rowHerramientas = $resHerramientas->fetch_assoc()){

                                                                $datos = [];

                                                                $datos['idHerramienta'] = $rowHerramientas['idHerramienta'];
                                                                $datos['codHerramienta'] = $rowHerramientas['codHerramienta'];
                                                                $datos['nomHerramienta'] = $rowHerramientas['nomHerramienta'];
                                                                $datos['cantHerramienta'] = $rowHerramientas['cantHerramienta'];

                                                            

                                                                ?>
                                                                
                                                                <tr>
                                                                    <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                        <center>
                                                                            <?php

                                                                            $idHerramienta = mb_strtoupper($rowHerramientas['idHerramienta']);
                                                                            echo $idHerramienta;

                                                                            ?>
                                                                        </center>
                                                                    </td>
                                                                    <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                        <center>
                                                                            <?php

                                                                                echo "<i class='fas fa-tools'></i>";

                                                                            ?>
                                                                        </center>
                                                                    </td>
                                                                    <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                        <center>
                                                                            <?php

                                                                            $codHerramienta = mb_strtoupper($rowHerramientas['codHerramienta']);
                                                                            echo $codHerramienta;

                                                                            ?>
                                                                        </center>
                                                                    </td>
                                                                    <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                        <center>
                                                                            <?php

                                                                            $nomHerramienta = mb_strtoupper($rowHerramientas['nomHerramienta']);
                                                                            echo $nomHerramienta;

                                                                            ?>
                                                                        </center>
                                                                    </td>
                                                                    <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold;" class="bg-primary">
                                                                        <center>
                                                                            <?php

                                                                            $cantHerramienta = mb_strtoupper($rowHerramientas['cantHerramienta']);
                                                                            echo $cantHerramienta;

                                                                            ?>
                                                                        </center>
                                                                    </td>
                                                                    <td style="vertical-align: middle;font-weight:bold">
                                                                    <center>
                                                                        <?php 

                                                                            ?>
                                                                                
                                                                                <form action="añadir-herramientas.php" class="form-group" method="POST" id="eliminar" style="margin: 0;text-align:center;">
                                                                            
                                                                                    <input type="hidden" name="idHerramienta" value="<?php echo $idHerramienta ;?>">
                                                                                    <button type="submit" onclick="confirmar(event, <?php echo $idHerramienta?>)" id="inputMozi" class="btn  btn-success"><i class="fas fa-plus"></i></button>
                                                                                
                                                                                </form>

                                                                            <?php

                                                                        
                                                                        ?>
                                                                    </center>
                                                                    </td>
                                                                </tr>

                                                                <?php



                                                            }


                                                            ?>

                                                        </tbody>
                                                        <tfoot class="bg-secondary">
                                                            <tr>
                                                                <th style="vertical-align: middle;">
                                                                    <center>N°</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Imagen</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Código</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Nombre</center>  
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>En Stock</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Agregar</center> 
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </fieldset>

                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Materiales Disponibles:</legend>
                                                                    
                                                <div class="table-responsive">
                                                    <table style="font-size: 90%;" id="example3" class="table table-bordered table-hover">
                                                        <thead class="bg-secondary">
                                                        <tr>    
                                                                <th style="vertical-align: middle;">
                                                                    <center>N°</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Imagen</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Código</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Nombre</center>  
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Stock Disponible</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Agregar</center> 
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            

                                                                <?php 

                                                                $queryMateriales = "SELECT * FROM pañol_materiales ORDER BY idMaterial  DESC";
                                                                $resMateriales = mysqli_query($conexion, $queryMateriales);

                                                                while($rowMateriales = $resMateriales->fetch_assoc()){

                                                                    $datos = [];
                                                                    
                                                                    
                                                                    $datos['idMaterial'] = $rowMateriales['idMaterial'];
                                                                    $datos['codMaterial'] = $rowMateriales['codMaterial'];
                                                                    $datos['nomMaterial'] = $rowMateriales['nomMaterial'];
                                                                    $datos['cantMaterial'] = $rowMateriales['cantMaterial'];



                                                                    ?>
                                                                    
                                                                    <tr>
                                                                        <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                            <center>
                                                                                <?php

                                                                              
                                                                                $idMaterial = mb_strtoupper($rowMateriales['idMaterial']);
                                                                                echo $idMaterial;

                                                                                ?>
                                                                            </center>
                                                                        </td>
                                                                        <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                            <center>
                                                                                <?php

                                                                              
                                                                                echo '<i class="fas fa-box"></i> ';

                                                                                ?>
                                                                            </center>
                                                                        </td>
                                                                        <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                        <center>
                                                                            <?php

                                                                            $codMaterial = mb_strtoupper($rowMateriales['codMaterial']);
                                                                            echo $codMaterial;

                                                                            ?>
                                                                        </center>
                                                                        </td>
                                                                        <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold">
                                                                        <center>
                                                                            <?php

                                                                            $nomMaterial = mb_strtoupper($rowMateriales['nomMaterial']);
                                                                            echo $nomMaterial;

                                                                            ?>
                                                                        </center>
                                                                        </td>
                                                                        <td nowrap="nowrap" style="vertical-align:middle;font-weight:bold" class="bg-primary">
                                                                        <center>
                                                                            <?php

                                                                            $cantMaterial = mb_strtoupper($rowMateriales['cantMaterial']);
                                                                            echo $cantMaterial;

                                                                            ?>
                                                                        </center>
                                                                        </td>
                                                                        <td style="vertical-align: middle;font-weight:bold">
                                                                            <center>
                                                                                <?php 

                                                                                    ?>
                                                                                        
                                                                                        <form action="añadir-herramientas.php" class="form-group" method="POST" id="eliminar" style="margin: 0;text-align:center;">
                                                                                    
                                                                                            <input type="hidden" name="idHerramienta" value="<?php echo $idHerramienta ;?>">
                                                                                            <button type="submit" onclick="confirmar(event, <?php echo $idHerramienta?>)" id="inputMozi" class="btn  btn-success"><i class="fas fa-plus"></i></button>
                                                                                        
                                                                                        </form>

                                                                                    <?php

                                                                                
                                                                                ?>
                                                                            </center>
                                                                        </td>
                                                                    </tr>

                                                                    <?php



                                                                }


                                                                ?>

                                                        </tbody>
                                                        <tfoot class="bg-secondary">
                                                            <tr>
                                                                <th style="vertical-align: middle;">
                                                                    <center>N°</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Imagen</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Código</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Nombre</center>  
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Stock Disponible</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Agregar</center> 
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </fieldset>


                                        </div>

                                        <br>
                                        
                                        <div class="tab-pane fade" id="pills-resumen" role="tabpanel" aria-labelledby="pills-resumen-tab">
                                            
                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Resumen Solicitud:</legend>
                                                
                                                <br>
                            
                                                <h5>Información General Solicitud:</h5>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputNomTarjeta">Fecha Ingreso:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="far fa-calendar-times"></i></span>
                                                                </div>
                                                                
                                                                <input disabled  type="text" required style="text-transform:capitalize" class="form-control" id="rutTarjeta" name="ingreso" value="<?php echo date('Y/m/d'); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                                    <div class="form-row">
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputNomTarjeta">Departamento:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                                </div>
                                                                
                                                                <input disabled  type="text" required style="text-transform:capitalize" class="form-control" id="departamento" name="departamento" value="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputNomTarjeta">Personal Solicitante:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                                </div>
                                                                
                                                                <input disabled  type="text" required style="text-transform:capitalize" class="form-control" id="personal" name="personal" value="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                <h5>Herramientas Seleccionadas:</h5>
                                                
                                        
                                            </fieldset>

                                            <br>
                                            <br>


                                            <div class="form-group">
                                                <input type="hidden" name="idTecnico" id="idTecnico" value="<?php echo $idUsuario; ?>">
                                                <input type="hidden" id="nomTecnicoTurno" name="nomTecnicoTurno" value="<?php echo $nomUsuario; ?>" />
                                                <input type="submit" class="btn btn-block btn-success" value="Guardar" style="font-weight: bold;" />
                                            </div>

                                        </div>
                                                
                                                <div class="form-group">
                                                    
                                                    <!-- <input type="button" id="anterior" value="&laquo;Anterior" class="btn btn-primary"></input> -->
                                                    <input type="button" id="siguiente" value="Siguiente&raquo;" class="btn btn-primary"></input>

                                                    
                                                </div>
                                    
                                    
                                                <!-- <div class="form-group">
                                                    <a href="bodega-administrar.php" class="btn btn-block btn-warning" style="font-weight: bold;"> Volver </a>
                                                </div> -->
                                    </div>
                            </form>

                            <div class="form-row fieldGroupCopy" style="display: none;">
                                        <div class="form-group col-md-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                </div>
                                                <input type="text" required class="form-control" id="herramienta[]" name="herramienta[]" placeholder="Código Barras">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-comment"></i></span>
                                                </div>
                                                <input type="text" min="1" placeholder="Nombre Producto" required class="form-control" id="cantidad[]" name="cantidad[]">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <div class="input-group mb-3">
                                                <a href="javascript:void(0)" class="btn btn-block btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</a>
                                            </div>
                                        </div>

                            </div>
                            <script type="text/javascript">
                                            $(document).ready(function() {
                                            //group add limit
                                            var maxGroup = "100";

                                            //add more fields group
                                            $(".addMore").click(function() {
                                                if ($('body').find('.fieldGroup').length < maxGroup ) {
                                                    var fieldHTML = '<div class="form-row fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
                                                $('body').find('.fieldGroup:last').after(fieldHTML);

                                            } else {
                                                alert('Limite de Herramientas Completados. Solo se permiten ' + maxGroup + ' Herramientas.');
                                            }
                                        });

                                                                //remove fields group
                                    $("body").on("click", ".remove", function() {
                                        $(this).parents(".fieldGroup").remove();
                                    });
                                });
                            </script>

                                      
                                        

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                            </div>
                            <!--/.col  -->

                
                        
                    </div>

                        
                    </div>
                </section>
            </div><!-- .content wrapper-->

            <footer class="main-footer">
                <strong>Copyright &copy; 2022. Derechos Reservados.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

        </div><!--.wrapper -->
        

        
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
        <script>
            $(function() {
        
                $('#example3').DataTable({
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
        
   
        </script>
        <script src="js/alert.js"></script>
    </body>

</html>