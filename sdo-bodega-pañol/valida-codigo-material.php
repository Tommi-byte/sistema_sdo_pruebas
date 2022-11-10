<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (isset($_POST['codBarra'])){
$buscCodigo = trim($_POST['codBarra']);

if(!empty($buscCodigo)){
$sqlquery = "SELECT * FROM pañol_materiales WHERE codMaterial = '".$buscCodigo."'";
$res = mysqli_query($conexion, $sqlquery);

if($res->num_rows){
    //header('Location: ../sdo-bodega-pañol/herramientas-formulario.php?Repetido=true');
    $query = 'SELECT * FROM pañol_materiales WHERE codMaterial=' . $buscCodigo . '';
    $res = mysqli_query($conexion, $query);
    $row = $res->fetch_assoc();

    if ($row) {
      $datos = array();
      $datos['idMaterial'] = $row['idMaterial'];//$idHerramienta;
      $datos['codMaterial'] = $row['codMaterial'];
      $datos['nomMaterial'] = $row['nomMaterial'];
      $datos['idCategoria'] = $row['idCategoria'];
      $datos['modeloMaterial'] = $row['modeloMaterial'];
      $datos['cantMaterial'] = $row['cantMaterial'];
      $datos['marcaMaterial'] = $row['marcaMaterial'];
      $datos['fechaIngreso'] = $row['fechaIngreso'];
      $datos['fechaVencimiento'] = $row['fechaVencimiento'];
      $datos['descriptMaterial'] = $row['descriptMaterial'];
      //$datos['numTelefono'] = $row['numTelefono'];
     // $datos['tipoActa'] = $row['tipoActa'];
      //return $datos;

    }
    $codMaterial = $datos['codMaterial'];
    $nomMaterial = $datos['nomMaterial'];
    $idCategoria = $datos['idCategoria'];
    $modeloMaterial = $datos['modeloMaterial'];
    $cantMaterial = $datos['cantMaterial'];
    $marcaMaterial = $datos['marcaMaterial'];
    $fechaIngreso = $datos['fechaIngreso'];
    $fechaVencimientoMaterial = $datos['fechaVencimiento'];
    $descripMaterial = $datos['descriptMaterial'];
    $idMaterial = $datos['idMaterial'];

    $query1 = "SELECT * FROM  categorias_material WHERE idCategoria = ${idCategoria}";
    $res1 = mysqli_query($conexion, $query1);
    $row1 = $res1->fetch_assoc();
    mysqli_close($conexion);
    if($row){

        $datos1 = array();
        $datos1['nomCategoria'] = $row1['nomCategoria']; 
    }

    $nomCategoria = $datos1['nomCategoria'];




} else{
    
    header('Location: ../sdo-bodega-pañol/ingreso-material.php?no-repetido=true&&buscCodigo='.urlencode($buscCodigo));

}
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
    <title>Modificar Material</title>

    <link rel="icon" href="../dist/img/ss-vina-quillota.png" type="image/icon type">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <script src="../sdo-canvasdraw1/jquery.min.js"></script>
    <script src="../sdo-canvasdraw1/signature_pad.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    
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
                            <h1>Modificar Material</h1>
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
                   <form action="material-modificar-cantidad.php" method="POST">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">

                                <!-- general form elements -->
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Informaci&oacute;n General del Material:</h3> 
                                    </div>                                     <!-- /.card-header -->
                                    <?php


                            //        if (isset($_GET['exitoingresoherramienta'])) {
                             //           echo '<div class="success alert-success alert-dismissible">
                             //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             //           <h5><i class="fa fa-check"></i>&nbsp;Ingreso de la Herramienta Completado</h5></div>';
                             //       }


                                    ?>
                                    <div class="card-body">

                                        <a href="ingreso-material.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                        <br>
                                        <br>

                                        <fieldset class="border p-3">
                                            <legend class="w-auto">Informaci&oacute;n General del Material:</legend>
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
                                                        <input type="text" required style="text-transform:capitalize" class="form-control" id="codHerramienta" name="codHerramienta" value="<?php echo $codMaterial?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputNomTarjeta">Nombre:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                        </div>
                                                        <input type="text" required style="text-transform:capitalize" class="form-control" id="nomHerramienta" name="nomHerramienta" value="<?php echo $nomMaterial?>" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">


                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputNomTarjeta">Categoria:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                                                        </div>
                                                       <!-- <select class="form-control" name="calidadContractual" id="calidadContractual">
                                                            <option value="Seleccione">Seleccione...</option>
                                                            <option value="Contrata">Contrata</option>
                                                            <option value="Empresa Externa">Empresa Externa</option>
                                                            <option value="Honorarios">Honorarios</option>
                                                            <option value="Reemplazo">Reemplazo</option>
                                                            <option value="Titular">Titular</option>
                                                        </select> -->
                                                        <input type="text" required style="text-transform:capitalize" class="form-control" id="categoriaHerramienta" name="categoriaHerramienta" value="<?php echo $nomCategoria?>" readonly>
                                                        <input type="hidden" value="<?php echo $idCategoria?>" name="idCategoria">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Modelo:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control" id="modeloHerramienta" name="modeloHerramienta" value="<?php echo $modeloMaterial?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Cantidad:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control" id="cantidadHerramienta" onkeyup="añadir();"  name="cantidadHerramienta" value="<?php echo $cantMaterial?>" placeholder="Cantidad" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Marca:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control" id="marcaHerramienta" name="marcaHerramienta" value="<?php echo $marcaMaterial?>" readonly>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="form-row"> 
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Fecha Ingreso:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <input disabled  type="text" required class="form-control" id="fechaHerramienta" name="fechaHerramienta" value="<?php echo $fechaIngreso?>" >
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputCodigoTarjeta">Fecha Vencimiento:<code></code></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <input class="form-control" type="text" id="fechavencimientoHerramienta" value="<?php echo $fechaVencimientoMaterial?>" name="fechavencimientoHerramienta" readonly>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputNumero">Cantidad a ingresar<code></code></label>
                                                    <div class="input-group mb-3">
                                                      <input class="form-control" type="text" id="numeroIngresar" onkeyup="añadir();" onKeypress="return event.charCode>=48 && event.charCode <=57 || event.charCode <=13"  name="numeroIngresar">
                                                    </div>
                                                </div>

                                           
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputNumero">Cantidad Total, luego de añadir unidades<code></code></label>
                                                    <div class="input-group mb-3">
                                                      <input class="form-control" type="text" id="total" name="total"  onkeyup="añadir();" value="<?php echo $cantMaterial?>" readonly>
                                                    </div>
                                                </div>

                           


                                            </div>
                                            <div class="form-row">
                                                <!-- <input type="button" class="btn btn-block" id="sumar"  value="Añadir" style="background-color:blue ; border-color:green ; color:white" > -->
                                             
                                            </div>

                                           

                                            </fieldset>

                                                <br>
                                                <fieldset class="border p-3">
                                                    <legend class="w-auto">Información Especifica del producto:</legend>
                                                    <textarea rows="04" cols="10" class="form-control" id="descripHerramienta" name="descripHerramienta" required aria-label="With textarea" readonly><?php echo $descripMaterial ?></textarea>
                                                

                                                </fieldset>


                                      
                                           

                                    </div>
                                     
                                   
                                       

                                        <br>
                                        <br>


                                        <div class="form-group">
                                            <input type="hidden" name="idTecnico" id="idTecnico" value="<?php echo $idUsuario; ?>">
                                            <input type="hidden" id="nomTecnicoTurno" name="nomTecnicoTurno" value="<?php echo $nomUsuario; ?>" />
                                            <input type="hidden" id="idMaterial" name="idMaterial" value="<?php echo $idMaterial?>">
                                            <input type="submit" class="btn btn-block" value="Guardar nuevas unidades" style="background-color:red ; border-color:green; font-weight: bold; color: white" >
                                        </div>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-block btn-warning"> Volver </a>
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
    <!-- <script src="js/funciones.js"></script> -->
    <script src="js/sumar.js"></script>
</body>

</html>


?>


