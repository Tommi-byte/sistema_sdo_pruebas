<?php 

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//1. SE TRAEN LOS DATOS CONSULTADOS DE LA BASE DE DATOS 

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $idReservado = $_POST['idReserva'];

    //Query Trae datos
    $queryReserva = "SELECT * FROM solicitudes_reserva WHERE idSoliReserva = $idReservado";

    // var_dump($queryReserva);
    // exit;
    $resReserva = mysqli_query($conexion, $queryReserva);

    while($row = $resReserva->fetch_assoc()){

            $datos = [];

            $datos['numReserva'] = $row['numReserva'];
            $datos['folioSoliCompra'] = $row['folioSoliCompra'];
            $datos['numeroCompra'] = $row['numeroCompra'];
            $datos['observaciones'] = $row['observaciones'];
            $datos['nomArchivo'] = $row['nomArchivo'];
            $datos['idPersonal'] = $row['idPersonal'];
            $datos['idDepartamento'] = $row['idDepartamento'];
            $datos['fechaSoliReserva'] = $row['fechaSoliReserva'];
            
            $numReserva = $datos['numReserva'];
            $folioSoliCompra = $datos['folioSoliCompra'];
            $numeroCompra = $datos['numeroCompra'];
            $pdf = $datos['nomArchivo'];
            $idPersonal = $datos['idPersonal'];
            $idDepartamento = $datos['idDepartamento'];
            $fechaSoliReserva = $datos['fechaSoliReserva'];
            $observaciones = $datos['observaciones'];



    }


    $queryDepa = "SELECT * FROM departamentos WHERE idDepartamento = ${idDepartamento}";    
    $resDepa = mysqli_query($conexion, $queryDepa);

    while($rowDepa = $resDepa->fetch_assoc()){

        $datos = [];

        $datos['nomDepartamento'] = $rowDepa['nomDepartamento'];

        $nomDepa = $datos['nomDepartamento'];

      
    }

    $queryJefe = "SELECT * FROM jefes_tecnicos WHERE idJefe = ${idPersonal}";    
    $resJefe = mysqli_query($conexion, $queryJefe);

    while($rowJefe = $resJefe->fetch_assoc()){

        $datos = [];

        $datos['nomJefe'] = $rowJefe['nomJefe'];

        $nomJefe = $datos['nomJefe'];

       
    }
}


?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar Herramienta</title>

    <link rel="icon" href="../dist/img/ss-vina-quillota.png" type="image/icon type">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <script src="../sdo-canvasdraw1/jquery.min.js"></script>
    <script src="../sdo-canvasdraw1/signature_pad.js"></script>
    <script src="../sdo-funciones/jquery-3.2.1.min.js"></script>

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
                    url: "sdo-datos-tecnicos/cargarTecnicos2.php",
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

                            cadena = cadena + '<span class="input-group-text w-100">No existen datos en este departamento.</span>';

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




</head>

<body class="hold-transition sidebar-mini">
    
    <div class="wrapper">

    <div class="preloader  flex-column justify-content-center align-items-center">

        <img class="animation__shake" src="../dist/img/ssvq1.png" alt="logo">
        <br>
        <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>

    </div>


        
        <?php
        include '../sdo-templates/bodega-panol-sidebar.php';
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Modificar Reserva</h1>
                        </div>
                        
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                  
                        <br>
                   <form action="guardar-modificacion-reserva.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idReservado" value="<?php echo $idReservado?>">

                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">

                                <!-- general form elements -->
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Informaci&oacute;n General de la Reserva:</h3> 
                                    </div>                                     <!-- /.card-header -->
                                    <?php


                            //        if (isset($_GET['exitoingresoherramienta'])) {
                             //           echo '<div class="success alert-success alert-dismissible">
                             //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             //           <h5><i class="fa fa-check"></i>&nbsp;Ingreso de la Herramienta Completado</h5></div>';
                             //       }


                                    ?>
                                    <div class="card-body">

                                        <a href="reservar-soli-compra.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                        <br>
                                        <br>

                                        <fieldset class="border p-3">
                                            <legend class="w-auto">Información Reserva</legend>
                                            <div class="form-row"> 
                                                <div class="form-group col-md-6">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                         <!--   <span class="input-group-text"><i class="fas fa-barcode"></i></span> -->
                                                        </div>
                                                      <!--  <button class="btn btn-primary" name="buscar">Buscar</button> -->
                                                   
                                                        

                                                      <!--   <style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Buscar Codigo Barra</style=>-->

                                                    </div>
                                                </div>
                                            </div>
                                              <!--  <?php
                                            
                                                  //$query = 'SELECT * FROM pañol_herramientas WHERE codHerramienta = ;';

                                                 //   $res = mysqli_query($conexion, $query);
                                                //?> -->
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputNomTarjeta">N° Reserva:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                                        </div>
                                                        <input type="text" readonly style="text-transform:capitalize" class="form-control" id="nomHerramienta" name="nomHerramienta" value="<?php echo $numReserva?>" >
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Fecha Ingreso:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <input disabled  type="text" required class="form-control" id="fechaHerramienta" name="fechaHerramienta" value="<?php echo $fechaSoliReserva?>" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">

                                                
                                                <div class="form-group col-md-6">
                                                <label for="exampleInputNomTarjeta">Solicitud de Compra Referente:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                                        </div>
                                                        <input type="text"  style="text-transform:capitalize" require class="form-control" id="solicitudCompra" name="solicitudCompra" value="<?php echo $folioSoliCompra?>" >
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="codigo"> N° de Compra Referente<code>*</code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-file-alt"></i></span>
                                                        </div>
                                                        <input id="codigo" style="resize:none;" required name="numeroCompra"   class="form-control"  placeholder="Numero de Compra" value="<?php echo  $numeroCompra?>">

                                                    </div>
                                                </div>
                            
                                                
                                            </div>

                                            <div class="form-row">
                                                   
                                                <div class="form-group col-md-6">
        
                                                    <label for="codigo"> Documento Solicitud de compra(Anexo):<code>*</code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                                                        </div>
                                                        <input type="file" accept="application/pdf" id="anexoSoliCompra" style="resize:none;"  name="anexoSoliCompra"  class="form-control"  >
                                                    
                                                    </div>
                                                    <a class="btn btn-warning" target="_blank" href="pdfs/<?php echo $pdf ?>" ><i class="fas fa-eye"> Visualizar Archivo Actual</i></a>
                                                </div>
                                  
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                        <label for="exampleInputNomTarjeta">Departamento Actual:<code></code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="far fa-building"></i></i></span>
                                                            </div>
                                                            <input type="hidden" value="<?php echo $idDepartamento?>" name="idDepartamento">
                                                            <input type="text" class="form-control"  name="depaActual" readonly value="<?php echo $nomDepa?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                        <label for="exampleInputNomTarjeta">Solicitante Actual:<code></code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                            </div>
                                                            <input type="hidden" value="<?php echo $idPersonal ?>"  name="idPersonal">
                                                            <input type="text" class="form-control"   name="solicitanteActual" readonly value="<?php echo $nomJefe?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row"> 
                                                <div class="form-group col-md-6">
                                                            <label for="exampleInputNomTarjeta">Nuevo Departamento:<code></code></label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="far fa-building"></i></span>
                                                                </div>
                                                                <select id="departamentoSolicitante"  class="form-control" name="departamentoSolicitante">
                                                                    <option value=""  selected>--Seleccione--</option>
                                                                    <?php

                                                                    $queryDepartamentos = "SELECT * FROM departamentos ";

                                                                    $resDepartamentos = mysqli_query($conexion, $queryDepartamentos);

                                                                    while ($rowDepartamentos = $resDepartamentos->fetch_assoc()) {

                                                                        $datos = [];

                                                                        $datos['idDepartamento'] = $rowDepartamentos['idDepartamento'];
                                                                        $datos['nomDepartamento'] = $rowDepartamentos['nomDepartamento'];

                                                                        $idDepartamentoNuevo = $datos['idDepartamento'];
                                                                        $nomDepartamentoNuevo =  $datos['nomDepartamento'];
    
                                                                    ?>
                                                                        <option value="<?php echo $idDepartamentoNuevo ?>">
                                                                            <?php echo  $nomDepartamentoNuevo?>
                                                                        </option>
                                                                    <?php

                                                                    }

                                                                    ?>
                                                                
                                                                </select>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group col-md-6">
                                                <label for="codigo">Personal Solicitante:<code></code></label>
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
                                        
                                        <div class="form-row fieldGroup">

                                          

                                            <div class="form-group col-md-12">

                                                <label for="observaciones">Observaciones:</label>
                                                <div class="input-group mb-3">
                                                
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                                    </div>
                                                    <textarea placeholder="informaciones, falta productos, etc.." id="observaciones" style="resize:none;"  name="observaciones" class="form-control" rows="10"><?php echo $observaciones;?></textarea>

                                                </div>
                                                            
                                            </div>

                                        </div>


                                        </fieldset>
                                        <br>
                                        <br>

                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Materiales Solicitados</legend>

                                                <div class="form-row">
                                                    <div class="from-group col-md-3">
                                                        <label for="codigo">Código de barras</label>
                                                        <div class="input-group mb-3">

                                                            <?php 
                                                            
                                                                $queryMateriales = "SELECT * FROM material_soli_reserva WHERE idSoliReserva = ${idReservado}";
                                                                $resMateriales = mysqli_query($conexion, $queryMateriales);
                                                                $aumento = 1;
                                                                while($rowMaterial = $resMateriales->fetch_assoc()){

                                                                    $datosMaterial = [];
                                                                    $datosMaterial['codigoMaterialSC'] = $rowMaterial['codigoMaterialSC'];

                                                                    foreach($datosMaterial as $valor){

                                                                        ?>

                                                                            <div class="form-col">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="producto">Producto: <?php echo $aumento?></label>
                                                                                    <div class="input-group mb-6">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" required id="codigoSC[]" name="codigoSC[]" value="<?php echo $valor?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        <?php
                                                                        $aumento++;

                                                                    }
                                                                }
                                                            
                                                            
                                                            
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="from-group col-md-3">
                                                        <label for="codigo">Nombre Material</label>
                                                        <div class="input-group mb-3">

                                                            <?php 
                                                            
                                                                $queryMateriales = "SELECT * FROM material_soli_reserva WHERE idSoliReserva = ${idReservado}";
                                                                $resMateriales = mysqli_query($conexion, $queryMateriales);
                                                                $aumento = 1;
                                                                $texto = "<br>";
                                                                while($rowMaterial = $resMateriales->fetch_assoc()){

                                                                    $datosMaterial = [];
                                                                    $datosMaterial['nomMaterialSC'] = $rowMaterial['nomMaterialSC'];

                                                                    foreach($datosMaterial as $valor){

                                                                        ?>

                                                                            <div class="form-col">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for=""><?php echo $texto; ?></label>
                                                                                    <div class="input-group mb-6">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" required  id="nombre[]" name="nombre[]" value="<?php echo $valor?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        <?php
                                                                        $aumento++;

                                        
                                                                    }
                                                                }
                                                            
                                                            
                                                            
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="from-group col-md-3">
                                                        <label for="codigo">Cantidad</label>
                                                        <div class="input-group mb-3">

                                                            <?php 
                                                            
                                                                $queryMateriales = "SELECT * FROM material_soli_reserva WHERE idSoliReserva = ${idReservado}";
                                                                $resMateriales = mysqli_query($conexion, $queryMateriales);
                                                                $aumento = 1;
                                                                $texto = "<br>";
                                                                while($rowMaterial = $resMateriales->fetch_assoc()){

                                                                    $datosMaterial = [];
                                                                    $datosMaterial['cantMaterialSC'] = $rowMaterial['cantMaterialSC'];

                                                                    foreach($datosMaterial as $valor){

                                                                        ?>

                                                                            <div class="form-col">
                                                                                <div class="form-group col-md-12">
                                                                                <label for=""><?php echo $texto; ?></label>
                                                                                    <div class="input-group mb-6">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"  required id="cantidad[]" name="cantidad[]" value="<?php echo $valor?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        <?php
                                                                        $aumento++;

                                        
                                                                    }
                                                                }
                                                            
                                                            
                                                            
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="from-group col-md-3">
                                                        <label for="codigo">Medida</label>
                                                        <div class="input-group mb-3">

                                                            <?php 
                                                            
                                                                $queryMateriales = "SELECT * FROM material_soli_reserva WHERE idSoliReserva = ${idReservado}";
                                                                $resMateriales = mysqli_query($conexion, $queryMateriales);
                                                                $aumento = 1;
                                                                $texto = "<br>";
                                                                while($rowMaterial = $resMateriales->fetch_assoc()){

                                                                    $datosMedida = [];
                                                                    $datosMedida['nomMedida'] = $rowMaterial['nomMedida'];

                                                                        foreach($datosMedida as $valor){

                                                                            ?>

                                                                                <div class="form-col">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label for=""><?php echo $texto; ?></label>
                                                                                        <div class="input-group mb-6">
                                                                                            <div class="input-group-prepend">
                                                                                                <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                                                            </div>

                                                                                            
                                                                                            <input type="text"  class="form-control"  required id="medida[]" name="medida[]" value="<?php echo $valor?>">

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            <?php
                                                                            $aumento++;

                                            
                                                                        }
                                                                    
                                                                }
                                                            
                                                            
                                                            
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                    </div>
                                        <br>
                                        <br>

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-block" value="Modificar" style="background-color:yellowgreen ; border-color:green; font-weight:bold; color: white;" >
                                        </div>
                                        <div class="form-group">
                                            <a href="../sdo-bodega-pañol/reservar-soli-compra.php" class="btn btn-block btn-info" style="color: white;font-weight: bold;"> Volver </a>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!--/.col  -->
                        </div>
                    </form>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022.</strong> Derechos Reservados.
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
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="js/funciones.js"></script>
    <script src="js/sumar.js"></script>
</body>

</html>





