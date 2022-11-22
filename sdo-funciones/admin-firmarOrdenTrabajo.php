<?php

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usoMaterial'], $_SESSION['usoFoto'], $_SESSION['idOrden'])) {

    $usoMaterial = $_SESSION['usoMaterial'];
    $usoFoto = $_SESSION['usoFoto'];
    $idOrden = $_SESSION['idOrden'];

    if (!empty($usoMaterial) && !empty($usoFoto) && !empty($idOrden)) {

        $datosOrden = array();
        $datosOrden = getOrdenTrabajo($idOrden);

        $folioOrden = $datosOrden['folioOrden'];
        $nomSolicitante = $datosOrden['nomSolicitante'];
        $fechaOrden = $datosOrden['fechaOrden'];
        $fechaOrden2 = date("d-m-Y", strtotime($fechaOrden));
    } else {
        header('Location: ../sdo-administrador/ordenes-formulario.php?errorGenerar=true');
    }

    // echo $usoMaterial.'<br><br>';
    // echo $usoFoto.'<br><br>';
    // echo $idOrden.'<br><br>';

} else {
    header('Location: ../sdo-administrador/ordenes-formulario.php?errorGenerar=true');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firmar Recepción de Trabajo</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <script src="../sdo-funciones/jquery-3.2.1.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include '../sdo-templates/admin-sidebar.php';

        $_SESSION['idOrden'] = $idOrden;
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Firmar Orden de Trabajar</h1>
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
                    <form action="../sdo-funciones/admin-ordenes-agregarFirmas.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">

                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Firmar Orden</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <?php


                                    if (isset($_GET['errorModificar'])) {
                                        echo '<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="fa fa-exclamation-triangle"></i>&nbsp;Error al Modificar Orden. Reintente.</h5></div>';
                                    }


                                    ?>
                                    <div class="card-body">

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="exampleInputFecha">Fecha de Recepción de Trabajo:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <?php
                                                    date_default_timezone_set('America/Santiago');
                                                    ?>
                                                    <input type="datetime" readonly="readonly" id="fechaActualOrden2" name="fechaActualOrden2" class="form-control" value="<?php echo $fechaOrden2; ?>" />
                                                    <input type="hidden" id="fechaActualOrden" name="fechaActualOrden" class="form-control" value="<?php echo $fechaOrden; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputNomSolicitante">Nombre Solicitante:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" readonly="readonly" style="text-transform:capitalize" value="<?php echo $nomSolicitante; ?>" class="form-control" id="nomSolicitante" name="nomSolicitante" placeholder="Nombre Solicitante">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputFolio">Folio:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-code"></i></span>
                                                    </div>
                                                    <input type="text" readonly="readonly" style="text-transform:capitalize" value="<?php echo $folioOrden; ?>" class="form-control" id="nomSolicitante" name="nomSolicitante" placeholder="Nombre Solicitante">
                                                </div>
                                            </div>

                                        </div>


                                        <hr>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputRecepcionado">Recepcionado por:<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" style="text-transform:capitalize" class="form-control" id="nomRecepcionador" name="nomRecepcionador" placeholder="Recepcionado por">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputRecepcionado">Unidad a la que pertenece:<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" style="text-transform:capitalize" class="form-control" id="unidadNomRecepcionador" name="unidadNomRecepcionador" placeholder="Unidad de Recepcionador">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputAutorizador">Ejecutado por:<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" style="text-transform:capitalize" class="form-control" id="nomEjecutador" name="nomEjecutador" placeholder="Ejecutado por">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputAutorizador">Unidad a la que pertenece:<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" style="text-transform:capitalize" class="form-control" id="unidadNomEjecutador" name="unidadNomEjecutador" placeholder="Unidad de Ejecutor">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputAutorizador">Autorizado por:<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" style="text-transform:capitalize" class="form-control" id="nomAutorizador" name="nomAutorizador" placeholder="Autorizado por">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputAutorizador">Unidad a la que pertenece:<code>*</code></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" style="text-transform:capitalize" class="form-control" id="unidadNomAutorizador" name="unidadNomAutorizador" placeholder="Unidad de Autorizador">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <br>

                                        <div class="form-group">
                                            <input type="hidden" name="idOrden" id="idOrden" value="<?php echo $idOrden; ?>">
                                            <input type="submit" class="btn btn-block btn-primary" value="Firmar" />

                                        </div>
                                        <div class="form-group">
                                            <a href="ordenes-administrar.php" class="btn btn-block btn-warning"> Volver </a>
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

</body>

</html>