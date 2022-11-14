<?php

// ASIGNAR ID

use function Composer\Autoload\includeFile;

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';





?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingreso Herramienta</title>

    <link rel="icon" href="../dist/img/ss-vina-quillota.png" type="image/icon type">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/estilos.css">

    <script src="../sdo-canvasdraw1/jquery.min.js"></script>
    <script src="../sdo-canvasdraw1/signature_pad.js"></script>
    <script src="../sdo-funciones/jquery-3.2.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            
            recargarNomCategoria();
       


            $('#categoriaOrden').change(function() {
                recargarNomCategoria();
            });


            function recargarNomCategoria() {

                $.ajax({
                    type: "POST",
                    url: "sdo-datos-categorias/habilitarIngresoCategoria.php",
                    data: "idCategoria=" + $('#categoriaOrden').val(),
                    success: function(r) {
                        $('#visualizarNomCategoria').html(r);


                    }
                });

            };

        });
    </script>
</head>

<body class="hold-transition sidebar-mini dark-mode" id="body">

        <div class="preloader  flex-column justify-content-center align-items-center">

            <img class="animation__shake" src="../dist/img/ssvq1.png" alt="logo">
            <br>
            <div class="spinner-border text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>

        </div>

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
                            <h1>Ingreso Herramienta</h1>
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
                    
                   <!-- general form elements -->
                   <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Información Ingreso Herramienta</h3>
                        </div>
                        <div class="row">

                            

                            <!-- left column -->
                            <div class="col-md-12">

                                    

                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <a href="bodega-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                        <br>
                                        <br>


                                        <form action="valida-codigo.php" method="POST">

                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Valida Código de Barras:</legend>
                                                <div class="form-group col-md-6">
                                                        
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" id="valida">Validar</button>
                                                            
                                                        </div>
                                                        <input type="text" required  style="text-transform:capitalize" class="form-control" id="codigoBarra1" name="codBarra" placeholder="Código de barras a Validar" minlength="3" maxlength="12" onKeypress="return event.charCode>=48 && event.charCode <=57 || event.charCode <=13">

                                                     
                                                    </div>

                                            
                                                   

                                                    <?php 
                                                        
                                                        if(isset($_GET['no-repetido'])){

                                                            echo "<p style='color: red; font-weight: bold;'>No ingresado, favor llenar formulario de ingreso</p>";
                                                        }
                                                    

                                                        if(isset($_GET['exlusiones'])){

                                                            echo "<p style='color: red; font-weight: bold;'>No se acepta solo 0</p>";
                                                        }
                                                    
                                                    ?>
                                                </div>
                                            </fieldset>
                                        </form>

                                        <br>

                                        <?php if(isset($_GET['no-repetido']) && isset($_GET['buscCodigo'])){ ?>
                                            
                                            <?php 

                                                $buscarCodigo = trim($_GET['buscCodigo'])

                                                ?> 
                                                
                                                <script>

                                                    
                                                    var input = document.getElementById('codigoBarra1');
                                                    var btn = document.getElementById('valida');

                                                    input.disabled = true;
                                                    input.style.cursor = "not-allowed"
                                                    btn.disabled = true;

                                                </script>
                                                
                                                
                                                <?php
                                            
                                            
                                        ?>



                                        <form action="guardar-herramienta.php" method="post" enctype="multipart/form-data">
                                        
                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Informaci&oacute;n General de la herramienta:</legend>

                                                

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        
                                                        <label for="codigoBarra">Código de Barra:<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                            </div>
                                                            <input type="text"  required readonly style="text-transform:capitalize;cursor:not-allowed" class="form-control" value="<?php echo $buscarCodigo?>" id="codigoBarra" name="codBarra" placeholder="Código de barras de la herramienta" minlength="3" maxlength="12" onKeypress="return event.charCode>=48 && event.charCode <=57 || event.charCode <=13">
                                                            </div>
                                                            
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputNomTarjeta">Nombre Descriptivo:<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                            </div>
                                                            <input type="text" required style="text-transform:capitalize" class="form-control" id="rutTarjeta" name="nombre" placeholder="Nombre Herramienta">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">


                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="exampleInputNomTarjeta">Categoria:<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                            </div> -->
                                                            <!-- <input type="text" required style="text-transform:capitalize" class="form-control" id="rutTarjeta" name="categoria" placeholder="Categoria de la herramienta"> -->
                                                            <!-- <select id="categoriaOrden" required class="form-control" name="categoriaOrden">
                                                                <option value="" disabled selected>--Seleccione--</option>
                                                                <?php

                                                                $queryCategorias //= "SELECT * FROM categorias_herramienta ORDER BY nomCategoria ASC";

                                                                //$resCategorias = mysqli_query($conexion, $queryCategorias);

                                                                //while ($rowCategorias = $resCategorias->fetch_assoc()) {

                                                                ?>
                                                                    <option value="<?php //echo $rowCategorias['idCategoria']; ?>">
                                                                        <?php //echo $rowCategorias['nomCategoria']; ?>
                                                                    </option>
                                                                <?php

                                                                //}


                                                                ?>
                                                                <option value="Otro">
                                                                    Otro
                                                                </option>
                                                            </select>
                                                        </div>

                                                      
                                                    </div>
                                                    <div name="visualizarNomCategoria" id="visualizarNomCategoria" class="form-group col-md-6">
                                                        
                                                    </div> -->

                                                 
                                                </div>

                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="departamento">Departamento(Especialidad):</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                            </div>
                                                            <select name="departamento" class="form-control" require id="departamento">
                                                                <option value="">-- Seleccione --</option>
                                                                <?php 

                                                                    $queryDepa = "SELECT * FROM departamentos";
                                                                    $resDepa = mysqli_query($conexion, $queryDepa);

                                                                    while($rowDepa = $resDepa->fetch_assoc()){

                                                                            $datos = [];

                                                                            $datos['idDepartamento'] = $rowDepa['idDepartamento'];
                                                                            $datos['nomDepartamento'] = $rowDepa['nomDepartamento'];

                                                                            $idDepartamento = $datos['idDepartamento'];
                                                                            $nomDepartamento = $datos['nomDepartamento'];

                                                                    

                                                                        ?>

                                                                            <option value="<?php echo $idDepartamento?>">
                                                                                <?php echo $nomDepartamento?>
                                                                            </option>


                                                                        <?php

                                                                    }
                                                                
                                                                
                                                                
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="departamento">Imagen:</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                                            </div>
                                                            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/png, image/jpeg">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="form-row">


                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputNomTarjeta">Modelo:</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                            </div>
                                                            <input type="text"  style="text-transform:capitalize" class="form-control" id="rutTarjeta" name="modelo" placeholder="Modelo de la herramienta">
                                                            
                                                        </div>
                                                    </div>

                                                 

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputCodigoTarjeta">Marca:</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-tag"></i></i></span>
                                                            </div>
                                                            <input type="text"  class="form-control" id="numTelefono" name="marca" placeholder="Marca Herramienta">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                   
                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="vencimiento">Fecha Vencimiento:</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="far fa-calendar-times"></i></span>
                                                            </div>
                                                            
                                                            <input type="date"  style="text-transform:capitalize" class="form-control" id="vencimiento" name="vencimiento">
                                                        </div>
                                                    </div> -->
                                                 
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputCodigoTarjeta">Cantidad:<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-angle-up"></i></span>
                                                            </div>
                                                            <input type="number" min="1" required class="form-control" id="numTelefono" name="cantidad" placeholder="Ej: 5">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputNomTarjeta">Fecha Ingreso:<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="far fa-calendar-times"></i></span>
                                                            </div>
                                                            
                                                            <input disabled  type="text"   required style="text-transform:capitalize;cursor:not-allowed" class="form-control" id="rutTarjeta" name="ingreso" value="<?php echo date('Y/m/d'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                            </fieldset>

                                            <br>
                                            <fieldset class="border p-3">
                                                <legend class="w-auto">Informaci&oacute;n Especifica del producto</legend>

                                                    <div class="form-group col-md-12">
                                                        <label for="descripcion">Especificaciones de la herramienta<code>*</code></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                                            </div>
                                                            <!--<input type="text" required class="form-control" id="unidadTarjeta" name="unidadTarjeta" placeholder="Unidad del Usuario de Tarjeta">-->
                                                            <textarea class="form-control" name="descripcion" id="descripcion" required aria-label="With textarea" rows="10" placeholder="Especificaciones Técnicas..."></textarea>
                                                        </div>
                                                    </div>
                                            </fieldset>

                                            <br>

                                            <br>
                                            <br>


                                            <div class="form-group">
                                                <input type="hidden" name="idTecnico" id="idTecnico" value="<?php echo $idUsuario; ?>">
                                                <input type="hidden" id="nomTecnicoTurno" name="nomTecnicoTurno" value="<?php echo $nomUsuario; ?>" />
                                                <input type="submit" class="btn btn-block btn-primary" value="Guardar" style="font-weight: bold;" />
                                            </div>
                                            <div class="form-group">
                                                <a href="bodega-administrar.php" class="btn btn-block btn-warning" style="font-weight: bold;"> Volver </a>
                                            </div>
                                        </form>
                                        <?php }?>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                            </div>
                            <!--/.col  -->

                
                        
                    </div>
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
    <script src="js/deshabilita.js"></script>
</body>

</html>