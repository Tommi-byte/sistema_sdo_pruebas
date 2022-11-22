<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idJefe'])) {

    $idJefe = trim($_POST['idJefe']);

    if (empty($idJefe) || $idJefe == "" || $idJefe == " ") {
        header('Location: ../sdo-administrador/jefes-administrar.php?errorEliminarJefe=true');
    } else {

        $queryJefe = "DELETE FROM jefes_tecnicos WHERE idJefe=" . $idJefe;
        $resJefe = mysqli_query($conexion, $queryJefe);

        if ($resJefe) {
            header('Location: ../sdo-administrador/jefes-administrar.php?exitoEliminarJefe=true');
        } else {
            header('Location: ../sdo-administrador/jefes-administrar.php?errorEliminarJefe=true');
        }
    }
} else {
    header('Location: ../sdo-administrador/jefes-administrar.php?errorSeleccionarEliminarJefe=true');
}
