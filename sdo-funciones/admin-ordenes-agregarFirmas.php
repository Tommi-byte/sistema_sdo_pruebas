<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idOrden'], $_POST['nomRecepcionador'], $_POST['unidadNomRecepcionador'], $_POST['nomEjecutador'], $_POST['unidadNomEjecutador'], $_POST['nomAutorizador'], $_POST['unidadNomAutorizador'])) {

    $idOrden = trim($_POST['idOrden']);
    $nomRecepcionador = trim($_POST['nomRecepcionador']);
    $unidadNomRecepcionador = trim($_POST['unidadNomRecepcionador']);
    $nomEjecutador = trim($_POST['nomEjecutador']);
    $unidadNomEjecutador = trim($_POST['unidadNomEjecutador']);
    $nomAutorizador = trim($_POST['nomAutorizador']);
    $unidadNomAutorizador = trim($_POST['unidadNomAutorizador']);

    if (!empty($idOrden)) {

        if (!empty($nomRecepcionador) && !empty($unidadNomRecepcionador)  && !empty($nomEjecutador)  && !empty($unidadNomEjecutador)  && !empty($nomAutorizador)  && !empty($unidadNomAutorizador)) {

            $recepcionador = $nomRecepcionador . ' (' . $unidadNomRecepcionador . ')';
            $ejecutador = $nomEjecutador . ' (' . $unidadNomEjecutador . ')';
            $autorizador = $nomAutorizador . ' (' . $unidadNomAutorizador . ')';

            $queryFirmar = "UPDATE ordenes_trabajos SET recepcionistaOrden = '" . $recepcionador . "', ejecutorOrden = '" . $ejecutador . "', autorizadorOrden = '" . $autorizador . "' WHERE idOrden = " . $idOrden;

            $resFirmar = mysqli_query($conexion, $queryFirmar);

            if ($resFirmar) {
                header('Location: ../sdo-administrador/ordenes-listado.php?exitoFirmarRecepcion=true');
            } else {
                header('Location: ../sdo-administrador/ordenes-listado.php?errorFirmarRecepcion=true');
            }
        } else {
            header('Location: ../sdo-administrador/ordenes-listado.php?errorFirmarRecepcion=true');
        }
    } else {
        header('Location: ../sdo-administrador/ordenes-listado.php?errorFirmarRecepcion=true');
    }
} else {
    header('Location: ../sdo-administrador/ordenes-listado.php?errorFirmarRecepcion=true');
}
