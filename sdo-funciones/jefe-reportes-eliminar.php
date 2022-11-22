<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idReporte'])) {

    $idReporte = trim($_POST['idReporte']);

    if (empty($idReporte) || $idReporte == "" || $idReporte == " ") {
        header('Location: ../sdo-jefestecnicos/reportes-listado.php?errorEliminarReporte=true');
    } else {

        $queryReporte = "DELETE FROM reportes_generales WHERE idReporte=" . $idReporte;
        $resReporte = mysqli_query($conexion, $queryReporte);

        if ($resReporte) {
            $queryImagenes = "DELETE FROM imagenes WHERE idReporte=" . $idReporte;
            $resImagenes = mysqli_query($conexion, $queryImagenes);

            if ($resImagenes) {
                header('Location: ../sdo-jefestecnicos/reportes-listado.php?exitoEliminarReporte=true');
            } else {
                header('Location: ../sdo-jefestecnicos/reportes-listado.php?errorEliminarFotoReporte=true');
            }
        } else {
            header('Location: ../sdo-jefestecnicos/reportes-listado.php?errorEliminarReporte=true');
        }
    }
} else {
    header('Location: ../sdo-jefestecnicos/reportes-listado.php?errorSeleccionarReporte=true');
}
