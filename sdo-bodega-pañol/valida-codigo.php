<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (isset($_POST['codBarra'])){
$buscCodigo = trim($_POST['codBarra']);

if(!empty($buscCodigo) || !$buscCodigo == '0'){
$sqlquery = "SELECT * FROM pañol_herramientas WHERE codHerramienta = '".$buscCodigo."'";
$res = mysqli_query($conexion, $sqlquery);

if($res->num_rows){
    //header('Location: ../sdo-bodega-pañol/herramientas-formulario.php?Repetido=true');
    $query = 'SELECT * FROM pañol_herramientas WHERE codHerramienta=' . $buscCodigo . '';
    $res = mysqli_query($conexion, $query);
    $row = $res->fetch_assoc();
    if ($row) {
      $datos = array();
      $datos['idHerramienta'] = $row['idHerramienta'];//$idHerramienta;
      $datos['codHerramienta'] = $row['codHerramienta'];
      $datos['nomHerramienta'] = $row['nomHerramienta'];
      $datos['idCategoria'] = $row['idCategoria'];
      $datos['modeloHerramienta'] = $row['modeloHerramienta'];
      $datos['cantHerramienta'] = $row['cantHerramienta'];
      $datos['marcaHerramienta'] = $row['marcaHerramienta'];
      $datos['fechaIngreso'] = $row['fechaIngreso'];
      //$datos['fechaVencimiento'] = $row['fechaVencimiento'];
      $datos['descriptHerramienta'] = $row['descriptHerramienta'];
      //$datos['numTelefono'] = $row['numTelefono'];
     // $datos['tipoActa'] = $row['tipoActa'];
      //return $datos;

    }
    $codHerramienta = $datos['codHerramienta'];
    $nomHerramienta = $datos['nomHerramienta'];
    $idCategoria = $datos['idCategoria'];
    $modeloHerramienta = $datos['modeloHerramienta'];
    $cantHerramienta = $datos['cantHerramienta'];
    $marcaHerramienta = $datos['marcaHerramienta'];
    $fechaIngreso = $datos['fechaIngreso'];
    //$fechaVencimientoHerramienta = $datos['fechaVencimiento'];
    $descripHerramienta = $datos['descriptHerramienta'];
    $idHerramienta = $datos['idHerramienta'];


    // $query1 = "SELECT * FROM  categorias_herramienta WHERE idCategoria = ${idCategoria}";
    // $res1 = mysqli_query($conexion, $query1);
    // $row1 = $res1->fetch_assoc();
    // mysqli_close($conexion);
    // if($row){

    //     $datos1 = array();
    //     $datos1['nomCategoria'] = $row1['nomCategoria']; 
    // }

    // $nomCategoria = $datos1['nomCategoria'];





} else{
    
    header('Location: ../sdo-bodega-pañol/ingreso-herramientas.php?no-repetido=true&&buscCodigo='.urlencode($buscCodigo));

}
}else{

    header('Location: ../sdo-bodega-pañol/ingreso-herramientas.php?exlusiones=true');
}


}
//mysqli_close($conexion);
?>

<?php

// // ASIGNAR ID
// include '../sdo-funciones/conexion.php';
// include '../sdo-funciones/funciones.php';

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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</head>

<body class="hold-transition sidebar-mini dark-mode">
    
    <div class="wrapper">
        
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
                            <h1>Modificar Herramienta</h1>
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
                  
                        <br>
                   <form action="herramienta-modificar-cantidad.php" method="POST">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">

                                <!-- general form elements -->
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Informaci&oacute;n General de la Herramienta:</h3> 
                                    </div>                                     <!-- /.card-header -->
                                    <?php


                            //        if (isset($_GET['exitoingresoherramienta'])) {
                             //           echo '<div class="success alert-success alert-dismissible">
                             //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             //           <h5><i class="fa fa-check"></i>&nbsp;Ingreso de la Herramienta Completado</h5></div>';
                             //       }


                                    ?>
                                    <div class="card-body">

                                        <a href="bodega-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                        <br>
                                        <br>

                                     

                                        <fieldset class="border p-3">
                                            <legend class="w-auto">Informaci&oacute;n General de la Herramienta:</legend>
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
                                            
                                    //               $query = 'SELECT * FROM pañol_herramientas WHERE codHerramienta = ;';

                                                 //   $res = mysqli_query($conexion, $query);
                                                //?> -->
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputNomTarjeta">Codigo de Barras:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                        </div>
                                                        <input type="text" required style="text-transform:capitalize" class="form-control" id="codHerramienta" name="codHerramienta" value="<?php echo $codHerramienta?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputNomTarjeta">Nombre:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                        </div>
                                                        <input type="text" required style="text-transform:capitalize" class="form-control" id="nomHerramienta" name="nomHerramienta" value="<?php echo $nomHerramienta?>" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Modelo:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control" id="modeloHerramienta" name="modeloHerramienta" value="<?php echo $modeloHerramienta?>" readonly>
                                                    </div>
                                                </div>
                                            </div>


                                            </script>

                                            <div class="form-row">
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Marca:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control" id="marcaHerramienta" name="marcaHerramienta" value="<?php echo $marcaHerramienta?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Fecha Ingreso:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <input disabled  type="text" required class="form-control" id="fechaHerramienta" name="fechaHerramienta" value="<?php echo $fechaIngreso?>" >
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="form-row"> 

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Cantidad Actual:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control" id="cantidadHerramienta" onkeyup="añadir();"  name="cantidadHerramienta" value="<?php echo $cantHerramienta?>" placeholder="Cantidad" readonly>
                                                    </div>
                                                </div>
                                                
                                            </div>


                                            <div class="form-row">



                                                <div class="form-group col-md-6">
                                                    <center>
                                                    <label for="exampleInputNumero">Cantidad a añadir<code></code></label>
                                                    </center>
                                                    <div class="input-group mb-3">
                                                      <input class="form-control" type="text" id="numeroIngresar" onKeypress="return event.charCode>=48 && event.charCode <=57 || event.charCode <=13" onkeyup="añadir();"  name="numeroIngresar" placeholder="Ej: 3" min="1">

                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <center>
                                                    <label for="exampleInputNumero">Cantidad total, luego de añadir<code></code></label>
                                                    </center>
                                                    <div class="input-group mb-3">
                                                      <input class="form-control" type="text" readonly id="total" onkeyup="añadir();" name="total" placeholder="Ej: 3" min="1" value="<?php echo  $cantHerramienta ?>">
                                                      
                                                    </div>
                                                </div>

    

                                            </div>
                                            <div class="form-row">
                                                
                                                
                                            </div>

                                           

                                            </fieldset>

                                                <br>
                                                <fieldset class="border p-3">
                                                    <legend class="w-auto">Información Especifica del producto:</legend>
                                                    <textarea rows="04" cols="10" class="form-control" id="descripHerramienta" name="descripHerramienta" required aria-label="With textarea" readonly><?php echo $descripHerramienta ?></textarea>
                                                

                                                </fieldset>


                                      
                                           

                                    </div>
                                     
                                   
                                       

                                        <br>
                                        <br>


                                        <div class="form-group">
                                            <input type="hidden" name="idTecnico" id="idTecnico" value="<?php echo $idUsuario; ?>">
                                            <input type="hidden" id="nomTecnicoTurno" name="nomTecnicoTurno" value="<?php echo $nomUsuario; ?>" />
                                            <input type="hidden" id="idHerramienta" name="idHerramienta" value="<?php echo $idHerramienta?>">
                                            <input type="submit" class="btn btn-block"  value="Guardar nuevas unidades" style="background-color:green ; border-color:green; font-weight:bold;color:white" >
                                        </div>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-block btn-warning" style="color: white; font-weight:bold;"> Volver </a>
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
    <!-- <script src="js/funciones.js"></script>  -->
    <script src="js/sumar.js"></script> 
    <!-- <script src="js/funciones.js"></script> -->
</body>

</html>





