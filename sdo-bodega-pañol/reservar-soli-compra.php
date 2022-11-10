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
                    url: "sdo-datos-tecnicos/cargarTecnicos1.php",
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
    <script LANGUAGE="JavaScript">
        var cuenta = 0;

        function enviado() {
            if (cuenta == 0) {
                cuenta++;
                return true;
            } else {
                alert("El formulario ya está siendo enviado, por favor aguarde un instante.");
                return false;
            }
        }
        // –>
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

        
    <!-- Site wrapper -->
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
                            <h4>Herramientas y/o Materiales reservados por solicitud de Compras</h4>

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

                        <div class="form-group">
                                        <div style="float: right;" class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="toggleDark()">
                                            <label class="custom-control-label" for="customSwitch3">Modo Oscuro</label>
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

            <?php

            if (isset($_GET['SolicitudCorrecta'])) {
            ?>
                <script>
                    Swal.fire({
                        title: 'Solicitud de reserva Ingresada con &Eacute;xito.',
                        confirmButtonText: 'Cerrar',
                        icon: 'success',
                    })
                </script>
            <?php
            }

            if (isset($_GET['cambio'])) {
            ?>
                <script>
                    Swal.fire({
                        title: 'Estado de la solicitud cambiada correctamente',
                        confirmButtonText: 'Cerrar',
                        icon: 'success',
                    })
                </script>
            <?php
            }

            if (isset($_GET['exitoModificacion'])) {
            ?>
                <script>
                    Swal.fire({
                        title: 'Solicitud de reserva modificada correctamente',
                        confirmButtonText: 'Cerrar',
                        icon: 'success',
                    })
                </script>
            <?php
            }

            if (isset($_GET['novacios'])) {
            ?>
                <script>
                    Swal.fire({
                        title: 'Datos no validos, revise por favor.',
                        confirmButtonText: 'Cerrar',
                        icon: 'error',
                    })
                </script>
            <?php
            }

            if (isset($_GET['finalizado'])) {
            ?>
                <script>
                    Swal.fire({
                        title: 'Ticket reserva finalizada, revise en historial.',
                        confirmButtonText: 'Cerrar',
                        icon: 'success',
                    })
                </script>
            <?php
            }

            if (isset($_GET['solopdf'])) {
                ?>
                    <script>
                        Swal.fire({
                            title: 'Solo se permiten archivos tipo PDF',
                            confirmButtonText: 'Cerrar',
                            icon: 'error',
                        })
                    </script>
                <?php
                }

                if (isset($_GET['anulado'])) {
                    ?>
                        <script>
                            Swal.fire({
                                title: 'Solicitud Reserva Anulado',
                                confirmButtonText: 'Cerrar',
                                icon: 'info',
                            })
                        </script>
                    <?php
                    }

                    if (isset($_GET['vacio'])) {
                        ?>
                            <script>
                                Swal.fire({
                                    title: 'Seleccione un estado valido..',
                                    confirmButtonText: 'Cerrar',
                                    icon: 'error',
                                })
                            </script>
                        <?php
                        }


            ?>

            

            <!-- Main content -->



            <section class="content">
                <div class="container-fluid">

                    <!-- Timelime example  -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="reserva-administrar.php" style="float: right;" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver Atras</a>


                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="text-align:center;">
                                    <button class="btn bg-yellow show-realizar" id="realizarSC" name="realizarSC">Reservar Material</button>
                                    <button class="btn bg-yellow show-listar" id="listarSC" style="display:none;" name="listarSC">Listar Solicitudes de reserva</button>

                                    <!-- <button type="button" class="hide-btn">Hide</button>
                                    <button type="button" class="show-btn">Show</button>
                                    <button type="button" class="toggle-btn">Toggle</button> -->


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <h5>Colores para Identificar:</h5>
                        <ul>
                            <li>
                                <i style="color : #E05214 ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Solicitud En proceso de recibir las herramientas y/o materiales solicitados
                            </li>
                            <li>
                                <i style="color : #301aec ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Solicitud con productos ya en bodega
                            </li>
                            <!-- <li>
                                            <i style="color : #4BD30B ; text-shadow: 0 0 3px #000;" class="fa fa-circle nav-icon"></i>&nbsp;&nbsp; Solicitud con productos preparados para entrega al personal
                                        </li> -->

                        </ul>
                        <br>
                        <br>
                    </div>



                    <div class="row" id="rowMenu1" name="rowMenu1">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>1.- Listado de Solicitudes Activos de Reserva</h5>
                                    <hr>
                                    <div class="table-responsive">

                                        <table style="font-size:90%" id="example2" class="table table-bordered table-hover">
                                            <thead class="bg-secondary">
                                                <tr>
                                                    <th style="vertical-align:middle;">
                                                        <center>N° Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitante</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Departamento</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitud Compra Referente</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>N° Compra Referente</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Fecha Reserva</center>
                                                    </th>
                                                
                                                    <th style="vertical-align:middle;">
                                                        <center>Estado Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Ver solicitud reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Descargar Orden de Compra</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Modificar Reserva</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "SELECT * FROM solicitudes_reserva ORDER BY fechaSoliReserva DESC";

                                                $res = mysqli_query($conexion, $query);



                                                $numSolicitud = 1;

                                                while ($row = $res->fetch_assoc()) {

                                                    $idReservado = $row['idSoliReserva'];
                                                    $idReservado2 = $row['idSoliReserva'];

                                                    $pdf = $row['nomArchivo'];
                                                    $numCompra = $row['numeroCompra'];
                                                    $observaciones = $row['observaciones'];


                                                    //PINTA DE COLOR LA TABLA SEGÚN CONDICIÓN
                                                    $color = "";
                                                    $estado = $row['estadoSoliReserva'];



                                                    if ($estado == 'En Proceso') {

                                                        $color = "style=' background-color: #E05214 ; font-weight:bold;vertical-align:middle;'";
                                                    } else if ($estado == 'En Pañol') {

                                                        $color = "style=' background-color: #301aec ;font-weight:bold;vertical-align:middle;'";
                                                    } else if ($estado == 'Entregado') {
                                                        $color = "style=' background-color: #4BD30B;font-weight:bold;vertical-align:middle;'";
                                                    }

                                                ?>
                                                    <tr>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <center>
                                                                <?php
                                                                $reserva = mb_strtoupper($row['numReserva']);
                                                                echo $reserva;

                                                                ?>
                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php

                                                            $solicitante = mb_strtoupper($row['idPersonal']);

                                                            $query1 = "SELECT * FROM jefes_tecnicos WHERE idJefe = ${solicitante}";
                                                            $res1 = mysqli_query($conexion, $query1);

                                                            while ($row1 = $res1->fetch_assoc()) {

                                                                $dato1 = [];
                                                                $dato1['jefe'] = $row1['nomJefe'];
                                                                $dato1['emailJefe'] = $row1['emailJefe'];

                                                                $nomJefe = $dato1['jefe'];
                                                                $email = $dato1['emailJefe'];
                                                            }

                                                            echo $nomJefe;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php

                                                            $idDepartamento = mb_strtoupper($row['idDepartamento']);

                                                            $query2 = "SELECT * FROM departamentos WHERE idDepartamento = ${idDepartamento}";
                                                            $res2 = mysqli_query($conexion, $query2);

                                                            while ($row2 = $res2->fetch_assoc()) {

                                                                $dato2 = [];
                                                                $dato2['nomDepa'] = $row2['nomDepartamento'];
                                                               


                                                                $nomDepa = $dato2['nomDepa'];
                                                                

                                                            }

                                                            echo $nomDepa;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php
                                                            $folioSoliCompra = mb_strtoupper($row['folioSoliCompra']);
                                                            echo $folioSoliCompra;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <?php
                                                            $numeroCompra = mb_strtoupper($row['numeroCompra']);
                                                            echo $numeroCompra;

                                                            ?>
                                                        </td>
                                                        <td style="vertical-align:middle;" nowrap="nowrap" align="center">
                                                            <center>
                                                                <?php if ($row['fechaSoliReserva'] == 0) {
                                                                    echo "No registra fecha";
                                                                } else {

                                                                    $fechaSoliReserva = $row['fechaSoliReserva'];

                                                                    $inicioFecha =  date('d/M/Y', (strtotime(str_replace('/', '-', $row['fechaSoliReserva']))));
                                                                    $inicioHora = date('H:i', strtotime($row['fechaSoliReserva']));

                                                                    echo $inicioFecha . '<br>' . $inicioHora;
                                                                } ?>
                                                            </center>
                                                        </td>
                                                


                                                        <td <?php echo $color ?> style="vertical-align:middle;">
                                                            <center>
                                                                <?php
                                                                $estado = mb_strtoupper($row['estadoSoliReserva']);
                                                                echo $estado;

                                                                ?>

                                                              <button type="button" class="btn btn-xs  btn-success" data-toggle="modal" data-target="#idReservado<?php echo $idReservado ?>"><i class="nav-icon fa fa-edit"></i></button> 

                                                                <form action="cambiarEstado.php" method="POST" id="form">

                                                                    <input type="hidden" value="<?php echo $email ?>" name="correo">
                                                                    <input type="hidden" value="<?php echo  $numCompra ?>" name="numCompra">
                                                                    <input type="hidden" value="<?php echo $pdf ?>" name="pdf">
                                                                    <input type="hidden" value="<?php echo $idReservado ?>" name="idReservado">
                                                                    <input type="hidden" value="<?php echo  $idDepartamento ?>" name="idDepartamento">
                                                                    <input type="hidden" value="<?php echo  $folioSoliCompra ?>" name="folioSoliCompra">
                                                                    <input type="hidden" value="<?php echo  $reserva ?>" name="numSolicitud">
                                                                    <input type="hidden" value="<?php echo  $fechaSoliReserva ?>" name="fechaSoliReserva">
                                                                    <input type="hidden" value="<?php echo  $observaciones ?>" name="observaciones">


                                                                    <div class="modal fade" id="idReservado<?php echo $idReservado ?>" name="idReservado<?php echo $idSoliCompra ?>" tabindex="-1" role="dialog" aria-labelledby="EjemploModalLabel" aria-hidden="true">
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
                                                                </form>
                                                                <?php
                                                                ?>

                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;">
                                                            <center>
                                                                <?php


                                                                ?>
                                                                <form action="visualizarReserva.php" method="POST" target="_blank">
                                                                    <input type="hidden" name="idReserva" value="<?php echo $idReservado; ?>">
                                                                    <input type="hidden" name="numReserva" value="<?php echo $reserva; ?>">
                                                                    


                                                                    <button type="submit" target="_blanck" id="inputMozi" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></button>


                                                                </form>
                                                                <?php
                                                                ?>


                                                            </center>
                                                        </td>
                                                        <td style="vertical-align:middle;">
                                                            <center>
                                                                <?php


                                                                ?>

                                                                <form action=" "></form>
                                                                <a href="pdfs/<?php echo $pdf ?>" class="btn btn-success btn-block" download="Orden-Compra-<?php echo $numCompra ?>"><i class="fas fa-download"></i></a>
                                                                <!-- <button type="submit" target="_blanck" id="inputMozi" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></button> -->


                                                                </form>
                                                                <?php
                                                                ?>


                                                            </center>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <center>

                                                                <?php


                                                                ?>

                                                                <form action="modificar-reserva.php" method="POST">

                                                                    <input type="hidden" name="idReserva" value="<?php echo $idReservado ?>">
                                                                    <button type="submit" id="inputMozi" class="btn btn-block btn-warning"><i class="fas fa-edit"></i></button>

                                                                </form>

                                                            </center>


                                                        </td>



                                                    <?php

                                                    $numSolicitud = $numSolicitud + 1;
                                                }
                                                    ?>

                                                    </tr>
                                            </tbody>
                                            <tfoot class="bg-secondary">
                                                <tr>
                                                    <th style="vertical-align:middle;">
                                                        <center>N° Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitante</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Departamento</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Solicitud Compra Referente</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>N° Compra Referente</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Fecha Reserva</center>
                                                    </th>
                                                  
                                                    <th style="vertical-align:middle;">
                                                        <center>Estado Reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Ver solicitud reserva</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Descargar Orden de Compra</center>
                                                    </th>
                                                    <th style="vertical-align:middle;">
                                                        <center>Modificar Reserva</center>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="row" id="rowMenu2" name="rowMenu2" style="display:none;">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>2.- Reservar (Herramientas o Materiales)</h5>
                                    <hr>
                                    <form action="guardar-reserva-soli-compra.php" method="post" enctype="multipart/form-data">
                                        <div class="form-row fieldGroup">


                                            <div class="form-group col-md-3">

                                                <label for="solicitud"> Solicitud De Compra Referente<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-file-alt"></i></span>
                                                    </div>
                                                    <input id="solicitud" style="resize:none;" required name="solicitud" class="form-control" placeholder="Código Soli. Compra">

                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="numeroCompra"> N° de Compra Referente<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-file-alt"></i></span>
                                                    </div>
                                                    <input id="numeroCompra" style="resize:none;" required name="numeroCompra" class="form-control" placeholder="Numero de Compra">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row fieldGroup">

                                            <div class="form-group col-md-6">

                                                <label for="anexoSoliCompra"> Documento Solicitud de compra(Anexo):<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                                                    </div>
                                                    <input type="file" accept="application/pdf" id="anexoSoliCompra" style="resize:none;" required name="anexoSoliCompra" class="form-control">

                                                </div>
                                                <p style=" color: red;">**Solo se permiten Archivos PDF**</p>
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

                                     

                                        <div class="form-row fieldGroup">

                                          

                                            <div class="form-group col-md-12">

                                                <label for="observaciones">Observaciones:</label>
                                                <div class="input-group mb-3">
                                                   
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                                    </div>
                                                    <textarea placeholder="informaciones, falta productos, etc.." id="observaciones" style="resize:none;"  name="observaciones" class="form-control" rows="10"></textarea>

                                                </div>
                                                            
                                            </div>

                                        </div>




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

                                        <br>
                                        <br>
                                        <hr>
                                        <br>

                                        <div class="form-group">
                                            <input type="hidden" name="personalSC" id="personalSC" value="<?php echo $nomUsuario; ?>">
                                            <input type="hidden" name="cargoSC" id="cargoSC" value="<?php echo $cargoUsuario; ?>">
                                            <input type="hidden" name="deptoSC" id="deptoSC" value="Administrador">
                                            <input type="hidden" name="emailSC" id="emailSC" value="saladecontrolhbqp@gmail.com">
                                            <input type="submit" class="btn btn-block btn-primary" value="Guardar" />

                                        </div>
                                    </form>

                                    <form action="agregar-medida.php" method="POST" id="form">

                                        <input type="hidden" value="<?php echo $email ?>" name="correo">
                                        <input type="hidden" value="<?php echo  $numCompra ?>" name="numCompra">
                                        <input type="hidden" value="<?php echo $pdf ?>" name="pdf">
                                        <input type="hidden" value="<?php echo $idReservado ?>" name="idReservado">
                                        <input type="hidden" value="<?php echo  $idDepartamento ?>" name="idDepartamento">
                                        <input type="hidden" value="<?php echo  $folioSoliCompra ?>" name="folioSoliCompra">
                                        <input type="hidden" value="<?php echo  $reserva ?>" name="numSolicitud">
                                        <input type="hidden" value="<?php echo  $fechaSoliReserva ?>" name="fechaSoliReserva">

                                        <div class="modal fade" id="idReservado2<?php echo $idReservado2 ?>" name="idReservado2<?php echo $idReservado2 ?>" tabindex="-1" role="dialog" aria-labelledby="EjemploModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EjemploModalLabel">Ingresar nueva medida</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="text-align:left;" class="form-group">
                                                            <label for="exampleInputBorder">Nueva Medida: <code>*</code></label>
                                                            <input type="text" class="form-control" name="nuevaMedida">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <input type="submit" class="btn btn-info" value="Añadir" id="añadir"></input>

                                                    </div>
                                                </div>
                                            </div>
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

                            </div>

                        </div>


                    </div>
                </div>
                <!-- /.timeline -->

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