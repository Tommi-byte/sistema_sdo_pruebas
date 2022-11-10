<?php
include '../sdo-funciones/conexion.php';

include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


date_default_timezone_set('America/Santiago');


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Men&uacute; Solicitudes Reserva Material</title>

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


    
    
    </head>
    <body class="hold-transition sidebar-mini" id="body">

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

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Arriendo Herramienta</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                </ol>
                                <li>
                                <div class="form-group">
                                            <div style="float: right;" class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="toggleDark()">
                                                <label class="custom-control-label" for="customSwitch3">Modo Oscuro</label>
                                            </div>
                                        </div>
                                        </li>

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
                    <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Arriendo de las herramientas Disponibles</h3>
                            </div>
                            <div class="row">

                                

                                <!-- left column -->
                                <div class="col-md-12">

                                        

                                        <!-- /.card-header -->
                                        <div class="card-body">

                                            <a href="bodega-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>
                                            <br>
                                            <br>

                                            <form action="guardar-herramienta.php" method="post" enctype="multipart/form-data">
                                            
                                                <fieldset class="border p-3">
                                                    <legend class="w-auto">Informacion Solicitante:</legend>

                                                    

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            
                                                            <label for="codigoBarra">Departamento<code>*</code></label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                                </div>
                                                                <select name="departamentoSolicitante" id="departamentoSolicitante" class="form-control">

                                                                    <option disabled selected>-- Seleccione --</option>

                                                                    <?php 
                                                                    
                                                                        $queryDepartamentos = "SELECT * FROM departamentos";
                                                                        $resDepartamentos = mysqli_query($conexion, $queryDepartamentos);

                                                                        while($rowDepartamentos = $resDepartamentos->fetch_assoc()){

                                                                            $datos=[];

                                                                            $datos['idDepartamento'] = $rowDepartamentos['idDepartamento'];
                                                                            $datos['nomDepartamento'] = $rowDepartamentos['nomDepartamento'];

                                                                            $idDepartamento = $datos['idDepartamento'];
                                                                            $nombreDepartamento = $datos['nomDepartamento'];
                                                                            ?>

                                                                                <option value="<?php echo $idDepartamento?>">
                                                                                    <?php echo $nombreDepartamento?>
                                                                                </option>


                                                                            <?php
                                                                        }
                                                                    
                                                                    
                                                                    
                                                                    ?>

                                                                </select>
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


                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputNomTarjeta">N° Ticket de trabajo:<code>*</code></label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                                                </div>
                                                                <!-- <input type="text" required style="text-transform:capitalize" class="form-control" id="rutTarjeta" name="categoria" placeholder="Categoria de la herramienta"> -->
                                                                <select id="categoriaOrden" required class="form-control" name="categoriaOrden">
                                                                    <option value="" disabled selected>--Seleccione--</option>
                                                                    <?php

                                                                    $queryActas = "SELECT * FROM actas";

                                                                    $resActas = mysqli_query($conexion, $queryActas);

                                                                    while ($rowActas = $resActas->fetch_assoc()) {

                                                                    ?>
                                                                        <option value="<?php echo $rowActas['idActa']; ?>">
                                                                            <?php echo $rowActas['folioActa'] . ' - ' .$rowActas['nomSolicitante'] . ' - ' . $rowActas['unidadTarjeta']; ?>
                                                                        </option>
                                                                    <?php

                                                                    }


                                                                    ?>
                                                             
                                                                </select>
                                                            </div>

                                                        
                                                        </div>
                                                        

                                                    
                                                    </div>

                                                

                                                    <!-- <div class="form-row">


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
                                                    </div> -->

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
                                                <br>
                                                <fieldset class="border p-3">
                                                    <legend class="w-auto">Herramientas A Seleccionar</legend>

                                                    <div class="form-row fieldGroup">
                                                        <div class="form-group col-md-3">
                                                            <label for="exampleInputRecinto">Codigo Barras:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                                </div>
                                                                <input type="text" required class="form-control" id="materialSC[]" name="materialSC[]" placeholder="Código Barras">
                                                            </div>
                                                        </div>



                                                        <div class="form-group col-md-3">
                                                            <label for="exampleInputCoordenadas">Nombre Material</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-comment"></i></span>
                                                                </div>
                                                                <input type="text" required min="1" title="mensaje" class="form-control" id="observacionSC[]" name="observacionSC[]" placeholder="Nombre Producto">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-2">
                                                            <label for="exampleInputCoordenadas">Cantidad:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                                                </div>
                                                                <input type="number" required min="1" class="form-control" id="cantidadSC[]" name="cantidadSC[]" placeholder="3">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-2">
                                                            <label for="exampleInputCoordenadas">Medida:</label>
                                                            <!-- <button class="btn btn-success"><i></i></button> -->
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                                                </div>
                                                                <!-- <input type="text" required min="1" class="form-control" id="medida[]" name="medida[]" placeholder="3"> -->
                                                                <input type="text" required class="form-control" name="medida[]" placeholder="Cajas, cm, metros.">
                                                                <!-- <button type="button" title="Añadir una nueva medida" class="btn btn-xs  btn-info" data-toggle="modal" data-target="#idReservado2<?php echo $idReservado2 ?>"><i class="nav-icon fa fa-plus"></i></button>  -->
                                                            </div>
                                                        </div>


                                                        <div class="form-group col-md-2">
                                                            <label for="exampleInputCoordenadas">&nbsp;</label>
                                                            <div class="input-group mb-3">
                                                                <a href="javascript:void(0)" class="btn btn-block btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Otro Elemento</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <br>
                                             

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

                                            <div class="form-row fieldGroupCopy" style="display: none;">
                                                <div class="form-group col-md-3">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                        </div>
                                                        <input type="text" required class="form-control" id="materialSC[]" name="materialSC[]" placeholder="Código Barras">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-comment"></i></span>
                                                        </div>
                                                        <input type="text" min="1" placeholder="Nombre Producto" required class="form-control" id="observacionSC[]" name="observacionSC[]">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                                        </div>
                                                        <input type="number" placeholder="3" required min="1" class="form-control" id="cantidadSC[]" name="cantidadSC[]">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                                        </div>
                                                        <!-- <input type="text" required  min="1" class="form-control" id="medida[]" name="medida[]" placeholder=""> -->
                                                        <input type="text" required class="form-control" name="medida[]" placeholder="Cajas, cm, metros..">

                                                </div>

                                                
                                            </div>



                                        <!-- <div class="form-group col-md-2">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                </div>
                                                <input type="text" min="1" class="form-control" id="empresaSC[]" name="empresaSC[]" placeholder="Referencia de Adquisici&oacute;n">
                                            </div>
                                        </div> -->
                                        

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
                                                        alert('Limite de Materiales Completados. Solo se permiten ' + maxGroup + ' Materiales.');
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
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
       
        

            <footer class="main-footer">
                <strong>Copyright &copy; 2022. Derechos Reservados.
            </footer>

        </div>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
       
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
        <!-- Page specific script -->
        <script>
            $(function() {
                $('#example').DataTable({
                    "paging": true,
                    "pageLength": 10,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": false,
                    "info": false,
                    "autoWidth": true,
                    "responsive": true,
                    "language": {
                        "lengthMenu": "Visualizando _MENU_ Registros por P&aacute;gina",
                        "zeroRecords": "No se han encontrado Registros.",
                        "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
                        "infoEmpty": "No existen Registros.",
                        "search": "Buscar :",
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
    </body>

</html>

