<?php

include_once('funciones.php');
include_once('conexion.php');

if (isset($_POST['nombreSolicitar'], $_POST['usuarioSolicitar'], $_POST['passwordSolicitar'], $_POST['departamentoSolicitar'])) {

    $nombreSolicitar = trim($_POST['nombreSolicitar']);
    $nombreSolicitar = ucwords(strtolower($nombreSolicitar));
    $usuarioSolicitar = trim($_POST['usuarioSolicitar']);
    $passwordSolicitar = trim($_POST['passwordSolicitar']);
    $departamentoSolicitar = trim($_POST['departamentoSolicitar']);

    if (empty($nombreSolicitar) || empty($usuarioSolicitar || empty($passwordSolicitar) || $nombreSolicitar == '' || $usuarioSolicitar == '' || $passwordSolicitar == '' || $departamentoSolicitar == '' || $departamentoSolicitar == '' || $departamentoSolicitar == '')) {
        header('Location: ../sdo-flujo/solicitarAcceso.php?errorSolicitarAcceso=true');
    } else {

        $existePersonal = existePersonal($usuarioSolicitar);

        $existeAdministrador = existeAdministrador($usuarioSolicitar);

        if ($existePersonal == 0) {

            if ($existeAdministrador == 0) {

                $query = "INSERT INTO personal(idPersonal,nomPersonal,userPersonal,passPersonal,activoPersonal,departamentoPersonal)";
                $query .=  "VALUES (NULL,'" . $nombreSolicitar . "','" . $usuarioSolicitar . "','" . $passwordSolicitar . "',0,'" . $departamentoSolicitar . "' )";
                $res = mysqli_query($conexion, $query);

                if ($res) {
                    header('Location: ../sdo-flujo/login.php?exitoSolicitarAcceso=true');
                } else {
                    header('Location: ../sdo-flujo/solicitarAcceso.php?errorSolicitarAcceso=true');
                }
            } else {
                header('Location: ../sdo-flujo/solicitarAcceso.php?existeUsuario=true');
            }
        } else {
            header('Location: ../sdo-flujo/solicitarAcceso.php?existeUsuario=true');
        }
    }
} else {
    header('Location: ../sdo-flujo/solicitarAcceso.php?errorSolicitarAcceso=true');
}



mysqli_close($conexion);
