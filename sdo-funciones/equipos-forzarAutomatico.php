<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
} else {
    header('Location: ../sdo-flujo/sdo-flujo/login.php?errorSesion=true');
}

$headerTextCorrecto = 'Location: ../' . $ruta . '/equipos-observaciones.php?exitoForzarAutomaticoEquipo=true';
$headerTextIncorrecto = 'Location: ../' . $ruta . '/equipos-observaciones.php?errorForzarAutomaticoEquipo=true';
$headerSinObservacion = 'Location: ../' . $ruta . '/equipos-observaciones.php?errorForzarEquipoSinObservacion=true';

if (isset($_POST['modoAutomatico'], $_POST['idEquipo'], $_POST['personalObservacion'], $_POST['addNombre'], $_POST['addFecha'], $_POST['razonesForzado'])) {

    $modoAutomatico = trim($_POST['modoAutomatico']);
    $idEquipo = trim($_POST['idEquipo']);
    $personalObservacion = trim($_POST['personalObservacion']);
    $addNombre = trim($_POST['addNombre']);
    $addFecha = trim($_POST['addFecha']);
    $razonesForzado = trim($_POST['razonesForzado']);

    if (!empty($razonesForzado)) {
        $razonesForzado = str_replace("'", "\'", $razonesForzado);
    }

    if (!empty($modoAutomatico) || !empty($idEquipo) || !empty($personalObservacion) || !empty($addNombre) || !empty($addFecha) || !empty($razonesForzado)) {
        if ($modoAutomatico == "Automatico" || $idEquipo > 0 || $personalObservacion > 0) {

            $sqlAutomatico = "UPDATE equipos SET forzadoEquipo = '0', forzadoEncendido = '0', forzadoApagado = '0', forzadoVariable = '0', modoAutomatico = '1' WHERE idEquipo = '" . $idEquipo . "'";

            $resAutomatico = mysqli_query($conexion, $sqlAutomatico);

            if ($resAutomatico) {
                $sqlObservacionForzar = "INSERT INTO equipos_observaciones(idObservaciones,detalleObservaciones,fechaObservaciones,personalObservacion,idEquipo,esForzado)
                VALUES(NULL,'" . $razonesForzado . "',NOW(),'" . $personalObservacion . "'," . $idEquipo . ",'Modo Automatico')";

                $resObservacionForzar = mysqli_query($conexion, $sqlObservacionForzar);

                if ($resObservacionForzar) {
                    header($headerTextCorrecto);
                } else {
                    header($headerSinObservacion);
                }
            } else {
                header($headerTextIncorrecto);
            }

        } else {
            header($headerTextIncorrecto);
        }
    } else {
        header($headerTextIncorrecto);
    }
} else {
    header($headerTextIncorrecto);
}
