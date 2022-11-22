<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';
include 'carritoHerramientas.php';


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
        <!-- CSS only -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->

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
                
                if(isset($_GET['sacar'])){
                    
                    ?>

                        <script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Error..',
                            text: 'No puede ingresar 0 herramientas',
                            
                        })
                        </script>
                    <?php
                
                }

                if(isset($_GET['stock'])){
                    
                    ?>

                        <script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Error..',
                            text: 'La cantidad solicitada no puede superar el stock disponible',
                            
                        })
                        </script>
                    <?php
                
                }

                if(isset($_GET['eliminado'])){
                    
                    ?>

                        <script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Good..',
                            text: 'Elemento eliminado de la lista',
                            
                        })
                        </script>
                    <?php
                
                }

                if(isset($_GET['repetido'])){
                    
                    ?>

                        <script>
                            Swal.fire({
                            icon: 'warning',
                            title: 'Ya existe..',
                            text: 'Esta Herramienta ya se encuentra seleccionada en el carrito',
                            
                        })
                        </script>
                    <?php
                
                }

                if(isset($_GET['ingresado'])){
                    
                    ?>

                        <script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Añadido al carrito..',
                            text: 'Herramienta añadida exitosamente',
                            
                        })
                        </script>
                    <?php
                
                }

                if(isset($_GET['guardado'])){
                    
                    ?>

                        <script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Exito.',
                            text: 'Solicitud Generada Correctamente',
                            
                        })
                        </script>
                    <?php
                
                }

                if(isset($_GET['vacios'])){
                    
                    ?>

                        <script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Error.',
                            text: 'Debe Ingresar al menos una herramienta o material',
                            
                        })
                        </script>
                    <?php
                
                }
                
                
                
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

                                        <a href="arriendo-retiro-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                        <br>
                                        <br>

                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            
                                            
                                            
                                                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="font-weight: 900;">Herramientas</a>
                                           
                                            
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false" style="font-weight: 900;">Materiales</a>
                                            
                                            
                                                <a class="nav-link" id="pills-resumen-tab" data-toggle="pill" href="#pills-resumen" role="tab" aria-controls="pills-contact" aria-selected="false" style="font-weight: 900;">Resumen(<?php echo (empty($_SESSION['CARRITO'])) ? 0: count($_SESSION['CARRITO'])?>) </a>
                                        
                                        </div>

                                        
                                        <div class="tab-content" id="pills-tabContent">
                                             
                                            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                
                                            <br>
                                            <?php if(!empty($mensaje)):?>
                                                    <div class="alert alert-primary" id="mensaje"   role="alert">
                                                        
                                                        <strong style="color: #62ed53;font-weight:bold">Herramienta Añadida Al Carrito:</strong><br>
                                                        <strong><?php echo $mensaje ?></strong> 
                                                    </div>
                                                <?php endif; ?>
                                                

                                            
                                                
                                                <div class="row">

                                                    <?php 
                                                    
                                                        $queryHerramientas = "SELECT * FROM pañol_herramientas";
                                                        $resHerramienta = mysqli_query($conexion, $queryHerramientas);                
                                                    ?>

                                                    <?php while($rowHerramienta = $resHerramienta->fetch_assoc()){


                                                        
                                                        $datosHerramientas = [];


                                                        $datosHerramientas['idHerramienta'] = $rowHerramienta['idHerramienta'];
                                                        $datosHerramientas['codHerramienta'] = $rowHerramienta['codHerramienta'];
                                                        $datosHerramientas['nomHerramienta'] = $rowHerramienta['nomHerramienta'];
                                                        $datosHerramientas['imagen'] = $rowHerramienta['imagen'];
                                                        $datosHerramientas['cantHerramienta'] = $rowHerramienta['cantHerramienta'];
                                                        $datosHerramientas['descriptHerramienta'] = $rowHerramienta['descriptHerramienta'];

                                                        $idHerramienta = $datosHerramientas['idHerramienta'];
                                                        $codHerramienta =  $datosHerramientas['codHerramienta'];
                                                        $nomHerramienta =  $datosHerramientas['nomHerramienta'];
                                                        $cantHerramienta =  $datosHerramientas['cantHerramienta'];
                                                        $descriptHerramienta =  $datosHerramientas['descriptHerramienta'];


                                                        if($cantHerramienta <= 2 ){

                                                            $color = " style='color:red; font-weight:bold'";
                                                        }

                                                        if($cantHerramienta >=3 && $cantHerramienta <= 9){

                                                            $color = " style='color:yellow; font-weight:bold'";
                                                        }

                                                        if($cantHerramienta >=10){

                                                            $color = " style='color:#62ed53; font-weight:bold'";
                                                        }

                                                        $imagenHerramienta = $datosHerramientas['imagen'];
                                                    
                                                    ?>
                                                    
                                                        <div class="col-lg-3 col-md-2">
                                                            <div class="card " >
                                                                <img
                                                                height="300px"
                                                                src="img/<?php echo  $imagenHerramienta  ?>" 
                                                                title="<?php echo $nomHerramienta?>"
                                                                class="card-img-top"                             
                                                                alt="Imagen producto">
                                                                <div class="card-body ">          
                                                                    <span style="text-align: center; color: orange; font-weight:bold;"><?php echo "Código. " . $codHerramienta?></span><br>
                                                                    <span style="text-transform:uppercase;font-weight:bold;color: yellowgreen"><?php echo $nomHerramienta ?></span><br>
                                                                    <h5  <?php echo $color?> class="card-title" style="font-weight: bold">En Stock: <?php echo $cantHerramienta; ?></h5>
                                                                    <br>
                                                                    
                                                        
                                                                    <br>
                                                                    <button type="button" style="cursor:zoom-in;" class="btn btn-xs  btn-info" id="descripcion" data-toggle="modal" data-target="#idHerramienta<?php echo $idHerramienta ?>">Leer Descripción</button> 
                                                                    <br>
                                                                    <div class="modal fade" id="idHerramienta<?php echo $idHerramienta ?>" name="idHerramienta<?php echo $idHerramienta ?>" tabindex="-1" role="dialog" aria-labelledby="EjemploModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="EjemploModalLabel">Especificaciones de la herramienta</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div style="text-align:left;" class="form-group">
                                                                                        
                                                                                    </div>
                                                                                        <p><?php echo $descriptHerramienta;?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-info" data-dismiss="modal">Ya he leído esto!</button>
                                                                                    

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <br>
                                                                    
                                                                

                                                        
                                                                    
                                                                        <form method="POST" id="formdata">
                                                                            
                                                                            <div class="form-group">
                                                                                <label for="" class="label-control" required>Cantidad a reservar:</label>
                                                                                <input type="number" class=" form-control" name="sacar">
                                                                            </div>
                                                                            
                                                                            <br>
                                                                            <input type="hidden" name="id" id="id" value="<?php echo $idHerramienta?>">
                                                                            <input type="hidden" name="codigo" id="codigo" value="<?php echo $codHerramienta?>">
                                                                            <input type="hidden" name="nombre" id="nombre" value="<?php echo $nomHerramienta?>">
                                                                            <input type="hidden" name="stock" id="stock" value="<?php echo $cantHerramienta ?>">
                                                                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1?>">
                                                                        

                                                                            <button name="btnAccion" value="Agregar"  id="añadir"  class="btn btn-success"><strong>Añadir al carrito</strong> </button>
                                                                        </form>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div><!-- .col-3 -->

                                                    <?php }?>
                                                
                                                </div> <!-- .row--> 

                                    
                                                
                                            

                                            
                                                                
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
                                                                    <center>Nombre Descriptivo</center>  
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Stock Disponible</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Agregar al Carrito</center> 
                                                                   
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
                                                                    $datos['imagen'] = $rowMateriales['imagen'];

                                                                    $cantMaterial = $datos['cantMaterial'];

                                                                    if($cantMaterial <= 2 ){

                                                                        $color = " style='background-color:red; font-weight:bold;font-size: 30px; vertical-align:middle'";
                                                                    }
            
                                                                    if($cantMaterial >=3 && $cantMaterial <= 9){
            
                                                                        $color = " style='background-color:yellow;font-size: 30px; font-weight:bold; vertical-align:middle'";
                                                                    }
            
                                                                    if($cantMaterial >=10){
            
                                                                        $color = " style='background-color:#62ed53;font-size: 30px; font-weight:bold; vertical-align:middle'";
                                                                    }
            



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

                                                                              
                                                                                $imagen = $rowMateriales['imagen'];
                                                                                ?>
                                                                                    
                                                                                    <img src="img/<?php echo $imagen ?>" alt="Imagen del material" width="100px">

                                                                                <?php 

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
                                                                        <td nowrap="nowrap" <?php echo $color ?> style="vertical-align:middle;font-weight:bold">
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
                                                                                        
                                                                                        <form action="carritoMateriales.php" class="form-group" method="POST" >

                                                                                            
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
                                                                    <center>Nombre Descriptivo</center>  
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Stock Disponible</center> 
                                                                </th>
                                                                <th style="vertical-align: middle;">
                                                                    <center>Agregar al Carrito</center> 
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </fieldset>

                                            </div>
                                            <div class="tab-pane fade" id="pills-resumen"  role="tabpanel" aria-labelledby="pills-resumen-tab">
                                                
                                                
                                                <fieldset class="border p-3">
                                                    <legend class="w-auto">Solicitante:</legend>
                                                    
                                                    <br>
                                
                                                    <h5>Información General Solicitud:</h5>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputNomTarjeta">Fecha Ingreso:</label>
                                                                <a name="resumen"></a>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="far fa-calendar-times"></i></span>
                                                                    </div>
                                                                    
                                                                    <input disabled  type="text" required style="text-transform:capitalize;cursor:not-allowed" class="form-control" id="rutTarjeta" name="ingreso" value="<?php echo date('Y/m/d'); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    
                                                       
                                                        <div class="form-row fieldGroup">


                                                            <div class="form-group col-md-3">

                                                                <label for="departamentoSolicitante">Departamento: <code>*</code></label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                                    </div>

                                                                    <select required name="departamentoSolicitante" id="departamentoSolicitante" class="form-control">
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
                                                    </fieldset>


                                                    <fieldset class="border p-3">
                                                        <legend class="w-auto">Herramientas Añadidas:</legend>
                                                        
                                                        

                                                        <?php  if(!empty($_SESSION['CARRITO'])){?>

                                                        

                                                        <table class="table">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col" class="text-center">N°</th>
                                                                    <th scope="col" class="text-center">CÓDIGO</th>
                                                                    <th scope="col" class="text-center">NOMBRE</th>
                                                                    <th scope="col" class="text-center">CANTIDAD</th>
                                                                    <th scope="col" class="text-center">ACCIONES</th>
                                                                </tr>
                                                            </thead>
                                                            <?php foreach($_SESSION['CARRITO'] AS $indice=>$herramienta){  
                                                                
                                                                if(!isset($num)){
                                                                    $num = 0;
                                                                }else{
                                                                    $num = $num;
                                                                }

                                                                $num++;
                                                                
                                                            ?>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row"  class="text-center"><?php echo $num?></th>
                                                                        <td class="text-center"><?php echo $herramienta['codigo']?></td>
                                                                        <td class="text-center"><?php echo $herramienta['nombre']?></td>
                                                                        <td class="text-center"><?php echo $herramienta['sacar']?></td>
                                                                        
                                                                        <form action="" method="POST">

                                                                            
                                                                                <input type="hidden" required name="id" id="id" value="<?php echo $herramienta['id']?>">

                                                                                <td class="text-center"><button class="btn btn-danger" name="btnAccion" value="Eliminar" type="submit">Eliminar</button></td>
                                                                            
                                                                        </form>
                                                                            
                                                                        </tr>                                                          
                                                                </tbody>


                                                            <?php } ?>
                                                            </table>

                                                    
                                                        </table>
                                                        <?php }else{?>

                                                            <div class="alert alert-info">

                                                                <strong>No ha añadido ninguna herramienta</strong> 

                                                            </div>

                                                        <?php }?>

                                                        
                                                    </fieldset>

                                                    <fieldset class="border p-3">
                                                        <legend class="w-auto">Materiales Añadidas:</legend>
                                                        
                                                        

                                                        <?php  if(!empty($_SESSION['CARRITO'])){?>

                                                        

                                                        <table class="table">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col" class="text-center">N°</th>
                                                                    <th scope="col" class="text-center">CÓDIGO</th>
                                                                    <th scope="col" class="text-center">NOMBRE</th>
                                                                    <th scope="col" class="text-center">CANTIDAD</th>
                                                                    <th scope="col" class="text-center">ACCIONES</th>
                                                                </tr>
                                                            </thead>
                                                            <?php foreach($_SESSION['CARRITO'] AS $indice=>$herramienta){  
                                                                
                                                                if(!isset($num)){
                                                                    $num = 0;
                                                                }else{
                                                                    $num = $num;
                                                                }

                                                                $num++;
                                                                
                                                            ?>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row"  class="text-center"><?php echo $num?></th>
                                                                        <td class="text-center"><?php echo $herramienta['codigo']?></td>
                                                                        <td class="text-center"><?php echo $herramienta['nombre']?></td>
                                                                        <td class="text-center"><?php echo $herramienta['sacar']?></td>
                                                                        
                                                                        <form action="" method="POST">

                                                                            
                                                                                <input type="hidden" required name="id" id="id" value="<?php echo $herramienta['id']?>">

                                                                                <td class="text-center"><button class="btn btn-danger" name="btnAccion" value="Eliminar" type="submit">Eliminar</button></td>
                                                                            
                                                                        </form>
                                                                            
                                                                        </tr>                                                          
                                                                </tbody>


                                                            <?php } ?>
                                                            </table>

                                                    
                                                        </table>
                                                        <?php }else{?>

                                                            <div class="alert alert-info">

                                                                <strong>No ha añadido ningún material</strong> 

                                                            </div>

                                                        <?php }?>

                                                        
                                                    </fieldset>
                                                    
                                            
                                                

                                                <br>
                                                <br>

                                                <form action="carritoHerramientas.php" method="POST">
                                                    <div class="form-group">
                                                        
                                                        <input type="submit" class="btn btn-block btn-success" name="btnAccion" value="Guardar" style="font-weight: bold;" />
                                                    </div>
                                                </form>

                                            </div>
                                            <br>
                                                    
                                                    <div class="form-group">
                                                        
                                                        <!-- <input type="button" id="anterior" value="&laquo;Anterior" class="btn btn-primary"></input> -->
                                                        <input type="button" id="siguiente" value="Siguiente&raquo;" class="btn btn-primary"></input>

                                                        
                                                    </div>
                                    
                                    
                                                <!-- <div class="form-group">
                                                    <a href="bodega-administrar.php" class="btn btn-block btn-warning" style="font-weight: bold;"> Volver </a>
                                                </div> -->
                                    </div>
                            

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

       
      
        </script>
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
    


   
        
        <script src="js/alert.js"></script>
        <script src="js/fetch_api_arriendo.js"></script>
    </body>

</html>