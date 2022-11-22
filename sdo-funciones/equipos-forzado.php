<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['razonesForzado'], $_POST['idEquipo'], $_POST['idPersonal'], $_POST['forzadoEquipo'])) {

    $razonesForzado = $_POST['razonesForzado'];
    $idEquipo = $_POST['idEquipo'];
    $idPersonal = $_POST['idPersonal'];
    $forzadoEquipo = $_POST['forzadoEquipo'];

    if (!empty($razonesForzado)) {

        $razonesForzado = str_replace("'", "\'", $razonesForzado);
    }

    $forzar = 0;

    if ($forzadoEquipo == 'Encender' || $forzadoEquipo == 'ENCENDER' || $forzadoEquipo == 'encender') {
        $forzar = 1;
        $headerTextCorrecto = 'Location: ../sdo-personal/equipos-observaciones.php?exitoForzarEquipo=true';
        $headerTextIncorrecto = 'Location: ../sdo-personal/equipos-observaciones.php?errorEstadoForzarEquipo=true';
        $headerSinObservacion = 'Location: ../sdo-personal/equipos-observaciones.php?errorForzarEquipoSinObservacion=true';
    } else if ($forzadoEquipo == 'Apagar' || $forzadoEquipo == 'APAGAR' || $forzadoEquipo == 'apagar') {
        $forzar = 0;
        $headerTextCorrecto = 'Location: ../sdo-personal/equipos-observaciones.php?exitoQuitarForzarEquipo=true';
        $headerTextIncorrecto = 'Location: ../sdo-personal/equipos-observaciones.php?errorEstadoForzarEquipo=true';
        $headerSinObservacion = 'Location: ../sdo-personal/equipos-observaciones.php?errorQuitarForzarEquipoSinObservacion=true';
    } else {
        $forzar = 0;
        $headerTextCorrecto = 'Location: ../sdo-personal/equipos-observaciones.php?errorEstadoForzarEquipo=true';
        $headerTextIncorrecto = 'Location: ../sdo-personal/equipos-observaciones.php?errorEstadoForzarEquipo=true';
        $headerSinObservacion = 'Location: ../sdo-personal/equipos-observaciones.php?errorForzarEquipoSinObservacion=true';
    }

    if (!empty($razonesForzado) && !empty($idEquipo) && !empty($idPersonal) && $idEquipo > 0 && $idPersonal > 0) {

        $sqlForzar = "UPDATE equipos SET forzadoEquipo = '" . $forzar . "' WHERE idEquipo = '" . $idEquipo . "'";

        $resForzar = mysqli_query($conexion, $sqlForzar);

        if ($resForzar) {
            $sqlObservacionForzar = "INSERT INTO equipos_observaciones(idObservaciones,detalleObservaciones,fechaObservaciones,personalObservacion,idEquipo,esForzado)
            VALUES(NULL,'".$razonesForzado."',NOW(),".$idPersonal.",".$idEquipo.",1)";

            $resObservacionForzar = mysqli_query($conexion, $sqlObservacionForzar);

            if ($resObservacionForzar) {
                header($headerTextCorrecto);
            } else {
                header($headerSinObservacion);
            }
        } else {
            header('Location: ../sdo-personal/equipos-observaciones.php?errorEstadoForzarEquipo=true');
        }
    } else {
        header('Location: ../sdo-personal/equipos-observaciones.php?errorEstadoForzarEquipo=true');
    }
} else {
    header('Location: ../sdo-personal/equipos-observaciones.php?errorEstadoForzarEquipo=true');
}
