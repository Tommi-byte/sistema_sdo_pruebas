<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['idOrden'], $_POST['detalleTrabajo'], $_POST['comentariosTrabajos'])) {

    $idOrden = $_POST['idOrden'];
    $detalleTrabajo = $_POST['detalleTrabajo'];
    $comentariosTrabajos = $_POST['comentariosTrabajos'];

    if (!empty($detalleTrabajo)) {

        $detalleTrabajo = str_replace("'", "\'", $detalleTrabajo);
    }

    if (!empty($comentariosTrabajos)) {

        $comentariosTrabajos = str_replace("'", "\'", $comentariosTrabajos);
    }

    if (!empty($idOrden) && !empty($detalleTrabajo) && !empty($comentariosTrabajos)) {

        $queryOrden = "UPDATE ordenes_trabajos SET detalleTrabajo = '" . $detalleTrabajo . "', comentariosTrabajos = '" . $comentariosTrabajos . "' WHERE idOrden = " . $idOrden;

        // echo $queryOrden;

        $resModOrden = mysqli_query($conexion, $queryOrden);

        if ($resModOrden) {
            header('Location: ../sdo-administrador/ordenes-administrar.php?exitoModificarOrden=true');

        } else {
            header('Location: ../sdo-administrador/ordenes-administrar.php?errorModificarOrden=true');
        }
    } else {
        header('Location: ../sdo-administrador/ordenes-administrar.php?errorModificarOrden=true');
    }
} else {
    header('Location: ../sdo-administrador/ordenes-administrar.php?errorModificarOrden=true');
}
