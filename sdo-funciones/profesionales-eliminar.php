<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idJefe'])) {

    $idJefe = trim($_POST['idJefe']);

    if (empty($idJefe) || $idJefe == "" || $idJefe == " ") {
        header('Location: ../sdo-administrador/profesionales-administrar.php?errorEliminarProfesional=true');
    } else {

        $queryJefe = "DELETE FROM jefes_tecnicos WHERE idJefe=" . $idJefe;
        $resJefe = mysqli_query($conexion, $queryJefe);

        if ($resJefe) {
            header('Location: ../sdo-administrador/profesionales-administrar.php?exitoEliminarProfesional=true');
        } else {
            header('Location: ../sdo-administrador/profesionales-administrar.php?errorEliminarProfesional=true');
        }
    }
} else {
    header('Location: ../sdo-administrador/profesionales-administrar.php?errorSeleccionarEliminarProfesional=true');
}
