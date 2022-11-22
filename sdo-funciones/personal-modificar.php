<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idPersonal'], $_POST['modNombre'], $_POST['modUser'], $_POST['modPassword'], $_POST['modEstado'], $_POST['departamentoModificar'])) {

    $idPersonal = trim($_POST['idPersonal']);
    $modNombre = trim($_POST['modNombre']);
    $modNombre = ucwords(strtolower($modNombre));
    $modUser = trim($_POST['modUser']);
    $passUser = trim($_POST['modPassword']);
    $modEstado = trim($_POST['modEstado']);
    $departamentoModificar = trim($_POST['departamentoModificar']);


    if ($idPersonal > 0) {

        if ($modNombre == '' || empty($modNombre) || $modUser == '' || empty($modUser) || $passUser == '' || empty($passUser) || $departamentoModificar == '' || empty($departamentoModificar)) {
            header('Location: ../sdo-administrador/personal-administrar.php?errorModificarPersonal=true');
        } else {


            if ($modEstado == 'true' || $modEstado == 'false') {

                if ($modEstado == 'true') {
                    $modEstado2 = 1;
                }

                if ($modEstado == 'false') {
                    $modEstado2 = 0;
                }

                // echo $modEstado . '<br>' . '<br>' . $modEstado2;

                $queryModificar = "UPDATE personal SET nomPersonal = '" . $modNombre . "', userPersonal = '" . $modUser . "', passPersonal = '" . $passUser . "', activoPersonal = " . $modEstado2 . ", departamentoPersonal = " . $departamentoModificar . " WHERE idPersonal = " . $idPersonal;

                $resModificar = mysqli_query($conexion, $queryModificar);

                if ($resModificar) {
                    header('Location: ../sdo-administrador/personal-administrar.php?exitoModificarPersonal=true');
                } else {
                    header('Location: ../sdo-administrador/personal-administrar.php?errorModificarPersonal=true');
                }
            }else {
                header('Location: ../sdo-administrador/personal-administrar.php?errorModificarPersonal=true');
            }
        }
    } else {
        header('Location: ../sdo-administrador/personal-administrar.php?errorModificarPersonal=true');
    }
} else {
    header('Location: ../sdo-administrador/personal-administrar.php?errorSeleccionarModificarPersonal=true');
}
