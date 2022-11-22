<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idPersonal'])) {

    $idPersonal = trim($_POST['idPersonal']);

    if (empty($idPersonal) || $idPersonal == "" || $idPersonal == " ") {
        header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorEliminarPersonal=true');
    } else {

        $queryPersonal = "DELETE FROM personal WHERE idPersonal=" . $idPersonal;
        $resPersonal = mysqli_query($conexion, $queryPersonal);

        if ($resPersonal) {
            header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?exitoEliminarPersonal=true');
        } else {
            header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorEliminarPersonal=true');
        }
    }
} else {
    header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorSeleccionarEliminarPersonal=true');
}
