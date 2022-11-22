<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idBitacora'])) {

    $idBitacora = trim($_POST['idBitacora']);

    if (empty($idBitacora) || $idBitacora == "" || $idBitacora == " ") {
        header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorEliminarBitacora=true');
    } else {

        $queryBitacora = "DELETE FROM bitacora WHERE idBitacora=" . $idBitacora;
        $resBitacora = mysqli_query($conexion, $queryBitacora);

        if ($resBitacora) {
            header('Location: ../sdo-jefestecnicos/bitacora-listado.php?exitoEliminarObservacion=true');
        } else {
            header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorEliminarObservacion=true');
        }
    }
} else {
    header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorSeleccionarEliminarObservacion=true');
}
