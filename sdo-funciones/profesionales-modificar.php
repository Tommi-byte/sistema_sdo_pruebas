<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idJefe'], $_POST['modNombre'], $_POST['modUser'], $_POST['modPassword'], $_POST['departamentoModificar'])) {

    $idJefe = trim($_POST['idJefe']);
    $modNombre = trim($_POST['modNombre']);
    $modNombre = ucwords(strtolower($modNombre));
    $modUser = trim($_POST['modUser']);
    $passUser = trim($_POST['modPassword']);
    $departamentoModificar = trim($_POST['departamentoModificar']);


    if ($idJefe > 0) {

        if ($modNombre == '' || empty($modNombre) || $modUser == '' || empty($modUser) || $passUser == '' || empty($passUser) || $departamentoModificar == '' || empty($departamentoModificar)) {
            header('Location: ../sdo-administrador/profesionales-administrar.php?errorModificarProfesional=true');
        } else {

            // echo $modEstado . '<br>' . '<br>' . $modEstado2;

            $queryModificar = "UPDATE jefes_tecnicos SET nomJefe = '" . $modNombre . "', userJefe = '" . $modUser . "', passJefe = '" . $passUser . "', idDepartamento = " . $departamentoModificar . ", idSubDepartamento = 0 WHERE idJefe = " . $idJefe;

            $resModificar = mysqli_query($conexion, $queryModificar);

            if ($resModificar) {
                header('Location: ../sdo-administrador/profesionales-administrar.php?exitoModificarProfesional=true');
            } else {
                header('Location: ../sdo-administrador/profesionales-administrar.php?errorModificarProfesional=true');
            }
        }
    } else {
        header('Location: ../sdo-administrador/profesionales-administrar.php?errorModificarProfesional=true');
    }
} else {
    header('Location: ../sdo-administrador/profesionales-administrar.php?errorSeleccionarModificarProfesional=true');
}
