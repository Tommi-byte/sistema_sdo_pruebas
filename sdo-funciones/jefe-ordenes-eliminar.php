<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idOrden'])) {

    $idOrden = trim($_POST['idOrden']);

    if (empty($idOrden) || $idOrden == "" || $idOrden == " ") {
        header('Location: ../sdo-jefestecnicos/ordenes-listado.php?errorEliminarOrden=true');
    } else {

        $queryOrden = "DELETE FROM ordenes_trabajos WHERE idOrden=" . $idOrden;
        $resOrden = mysqli_query($conexion, $queryOrden);

        if ($resOrden) {
            $queryImagenes = "DELETE FROM imagenes WHERE idOrden=" . $idOrden;
            $resImagenes = mysqli_query($conexion, $queryImagenes);

            if ($resImagenes) {
                header('Location: ../sdo-jefestecnicos/ordenes-listado.php?exitoEliminarOrden=true');
            } else {
                header('Location: ../sdo-jefestecnicos/ordenes-listado.php?errorEliminarFotoOrden=true');
            }
        } else {
            header('Location: ../sdo-jefestecnicos/ordenes-listado.php?errorEliminarOrden=true');
        }
    }
} else {
    header('Location: ../sdo-jefestecnicos/ordenes-listado.php?errorSeleccionarOrden=true');
}
