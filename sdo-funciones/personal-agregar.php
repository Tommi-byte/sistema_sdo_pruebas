<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('funciones.php');
include_once('conexion.php');


if (isset($_POST['addNombre'], $_POST['addUser'], $_POST['addPassword'], $_POST['departamentoAgregar'])) {

    $nomPersonal = trim($_POST['addNombre']);
    $nomPersonal = ucwords(strtolower($nomPersonal));
    $userPersonal = trim($_POST['addUser']);
    $passPersonal = trim($_POST['addPassword']);
    $departamentoAgregar = trim($_POST['departamentoAgregar']);

    if (empty($nomPersonal) || empty($userPersonal) || empty($passPersonal) || empty($departamentoAgregar) || $nomPersonal == '' || $userPersonal == '' || $passPersonal == '' || $departamentoAgregar == '') {
        header('Location: ../sdo-administrador/personal-administrar.php?errorAgregarPersonal=true');
    } else {
        $existePersonal = existePersonal($userPersonal);

        $existeAdministrador = existeAdministrador($userPersonal);

        if ($existePersonal == 0) {

            if ($existeAdministrador == 0) {

                $query = "INSERT INTO personal(idPersonal,nomPersonal,userPersonal,passPersonal,activoPersonal,departamentoPersonal)";
                $query .=  "VALUES (NULL,'" . $nomPersonal . "','" . $userPersonal . "','" . $passPersonal . "',1,'" . $departamentoAgregar . "')";
                $res = mysqli_query($conexion, $query);

                if ($res) {
                    header('Location: ../sdo-administrador/personal-administrar.php?exitoAgregarPersonal=true');
                } else {
                    header('Location: ../sdo-administrador/personal-administrar.php?errorAgregarPersonal=true');
                }
            } else {
                header('Location: ..sdo-administrador/personal-administrar.php?existeUsuario=true');
            }
        } else {
            header('Location: ../sdo-administrador/personal-administrar.php?existeUsuario=true');
        }
    }
} else {
    header('Location: ../sdo-administrador/personal-administrar.php?errorAgregarPersonal=true');
}

mysqli_close($conexion);
