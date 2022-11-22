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
            header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorModificarPersonal=true');
        } else {

            $idSubDepartamento = '';

            if(isset($_POST['subdepartamentoModificar'])){

                $subdepartamentoModificar = $_POST['subdepartamentoModificar'];

                if($subdepartamentoModificar > 0){
                    $idSubDepartamento = $subdepartamentoModificar;
                }else{
                    $idSubDepartamento = '0';
                }

            }else{
                $idSubDepartamento = '0';
            }


            if ($modEstado == 'true' || $modEstado == 'false') {

                if ($modEstado == 'true') {
                    $modEstado2 = 1;
                }

                if ($modEstado == 'false') {
                    $modEstado2 = 0;
                }

                // echo $modEstado . '<br>' . '<br>' . $modEstado2;

                $queryModificar = "UPDATE personal SET nomPersonal = '" . $modNombre . "', userPersonal = '" . $modUser . "', passPersonal = '" . $passUser . "', activoPersonal = " . $modEstado2 . ", departamentoPersonal = " . $departamentoModificar . ", idSubdepartamento = " . $idSubDepartamento . " WHERE idPersonal = " . $idPersonal;

                $resModificar = mysqli_query($conexion, $queryModificar);

                if ($resModificar) {
                    header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?exitoModificarPersonal=true');
                } else {
                    header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorModificarPersonal=true');
                }
            }else {
                header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorModificarPersonal=true');
            }
        }
    } else {
        header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorModificarPersonal=true');
    }
} else {
    header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorSeleccionarModificarPersonal=true');
}
