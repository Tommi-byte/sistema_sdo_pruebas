<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['customRadio'], $_POST['nomUsuario'], $_POST['tipoUsuario'])) {

    $customRadio = $_POST['customRadio'];
    $nomUsuario = trim($_POST['nomUsuario']);
    $tipoUsuario = trim($_POST['tipoUsuario']);

    $nomCompleto = $nomUsuario . ' (' . $tipoUsuario . ')';

    $query = "";
    $tipoDescarga = "";
    $observaciones = "";

    $rolUsuario = $_SESSION['rolUsuario'];

    $rolUsuario2 = strtolower($rolUsuario);

    $ruta = "";

    if ($rolUsuario2 == "personal") {

        $ruta = "sdo-personal";
    } else if ($rolUsuario2 == "administrativo") {

        $ruta = "sdo-admtec";
    } else if ($rolUsuario2 == "jefe tecnico") {

        $ruta = "sdo-jefestecnicos";
    } else if ($rolUsuario2 == "administrador") {

        $ruta = "sdo-administrador";

        $nomCompleto = $nomUsuario;
    } else {
        header('Location: ../sdo-flujo/sdo-flujo/login.php?errorSesion=true');
    }

    date_default_timezone_set('America/Santiago');

    if ($customRadio == 'true') {

        $fecha = date('d-m-Y H:i');
        $fechaInicio = strtotime($fecha);
        $fechaInicio = fechaEspañol($fechaInicio);
        $horaInicio = date('H:i', strtotime($fecha));
        $tipoDescarga = "Completa";

        $observaciones = $nomCompleto . ' ha descargado el Historial Completo de la Bitacora el día ' . $fechaInicio . ' a las ' . $horaInicio . ' hrs.';

        $query = "INSERT INTO descargas_bitacora(idDescargaB,fechaDescargaB,usuarioDescargaB,tipoDescargaB,comentarioDescargaB)";
        $query .= " VALUES(NULL,NOW(),'" . $nomCompleto . "','" . $tipoDescarga . "','" . $observaciones . "')";

        $res = mysqli_query($conexion, $query);

        if ($res) {

            $_SESSION['idDescargaB'] = mysqli_insert_id($conexion);
            $_SESSION['tipoDescarga'] = $tipoDescarga;
            header("Location: ../sdo-pdf/SDO-Bitacora.php");
        } else {
            header('Location: ../'.$ruta.'/bitacora-listado.php?errorDescargarBitacora=true');
        }
    } else if ($customRadio == 'false') {
        if (isset($_POST['fechaInicio'], $_POST['fechaTermino'])) {
            $fechaInicio = $_POST['fechaInicio'];
            $fechaTermino = $_POST['fechaTermino'];

            if ($fechaInicio == '' || $fechaInicio == 0 || $fechaTermino == '' || $fechaTermino == 0 || $fechaTermino < $fechaInicio) {
                header('Location: ../'.$ruta.'/bitacora-listado.php?errorDescargarBitacora=true');
            } else {

                if ($fechaTermino < $fechaInicio) {
                    header('Location: ../'.$ruta.'/bitacora-listado.php?errorFechaTermino=true');
                } else {
                    $fechaInicio2 = strtotime($fechaInicio);
                    $fechaInicio2 = fechaEspañol($fechaInicio2);
                    $horaInicio = date('H:i', strtotime($fechaInicio));

                    $fechaTermino2 = strtotime($fechaTermino);
                    $fechaTermino2 = fechaEspañol($fechaTermino2);
                    $horaTermino = date('H:i', strtotime($fechaTermino));

                    $tipoDescarga = "Fechas";

                    $observaciones = $nomCompleto . ' ha descargado el Historial de la Bitacora entre el día ' . $fechaInicio2 . ' a las ' . $horaInicio . ' hrs.';
                    $observaciones .= ' hasta el día ' . $fechaTermino2 . ' a las ' . $horaTermino . ' hrs. ';

                    // echo $observaciones;
                    $query = "INSERT INTO descargas_bitacora(idDescargaB,fechaDescargaB,usuarioDescargaB,tipoDescargaB,comentarioDescargaB)";
                    $query .= " VALUES(NULL,NOW(),'" . $nomCompleto . "','" . $tipoDescarga . "','" . $observaciones . "')";

                    $res = mysqli_query($conexion, $query);

                    if ($res) {

                        $_SESSION['idDescargaB'] = mysqli_insert_id($conexion);
                        $_SESSION['tipoDescarga'] = $tipoDescarga;
                        $_SESSION['fechaInicio'] = $fechaInicio;
                        $_SESSION['fechaTermino'] = $fechaTermino;
                        $_SESSION['rolUsuario2'] = $rolUsuario2;
                        header("Location: ../sdo-pdf/SDO-Bitacora.php");
                    } else {
                        header('Location: ../'.$ruta.'/bitacora-listado.php?errorDescargarBitacora=true');
                    }
                }
            }
        } else {
            header('Location: ../'.$ruta.'/bitacora-listado.php?errorDescargarBitacora=true');
        }
    } else {
        header('Location: ../'.$ruta.'/bitacora-listado.php?errorDescargarBitacora=true');
    }
} else {
    header('Location: ../'.$ruta.'/bitacora-listado.php?errorDescargarBitacora=true');
}
