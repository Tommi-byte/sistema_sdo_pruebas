<?php

include("conexion.php");
include("funciones.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['nuevaPassword'], $_POST['idUsuario'], $_POST['rolUsuario'])) {

    $nuevaPassword = trim($_POST['nuevaPassword']);
    $idUsuario = $_POST['idUsuario'];
    $rolUsuario = $_POST['rolUsuario'];

    if (!empty($nuevaPassword) && !empty($idUsuario) && !empty($rolUsuario)) {

        if ($rolUsuario == 'Administrador') {

            $queryModificarAdministrador = "UPDATE administracion SET passAdministrador = '" . $nuevaPassword . "' WHERE idAdministrador = '" . $idUsuario."'";

            // echo $queryModificarAdministrador;
            $resModificarAdministrador = mysqli_query($conexion, $queryModificarAdministrador);

            if ($resModificarAdministrador) {
                header('Location: ../sdo-administrador/index.php?exitoCambioPassword=true');
            } else {
                header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
            }
        } else if ($rolUsuario == 'Personal') {

            $queryModificarPersonal = "UPDATE personal SET passPersonal = '" . $nuevaPassword . "' WHERE idPersonal = '" . $idUsuario."'";

            $resModificarPersonal = mysqli_query($conexion, $queryModificarPersonal);

            if ($resModificarPersonal) {
                header('Location: ../sdo-personal/index.php?exitoCambioPassword=true');
            } else {
                header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
            }
        } else if ($rolUsuario == 'Directiva') {
            $queryModificarDirectiva = "UPDATE directivos SET passDirectivo = '" . $nuevaPassword . "' WHERE idDirectivo = '" . $idUsuario."'";

            $resModificarDirectiva = mysqli_query($conexion, $queryModificarDirectiva);

            if ($resModificarDirectiva) {
                header('Location: ../sdo-directiva/index.php?exitoCambioPassword=true');
            } else {
                header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
            }
        } else if ($rolUsuario == 'Jefe Tecnico') {
            $queryModificarJefe = "UPDATE jefes_tecnicos SET passJefe = '" . $nuevaPassword . "' WHERE idJefe = '" . $idUsuario."'";

            $resModificarJefe = mysqli_query($conexion, $queryModificarJefe);

            // echo $queryModificarJefe;
            if ($resModificarJefe) {
                header('Location: ../sdo-jefestecnicos/index.php?exitoCambioPassword=true');
            } else {
                header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
            }
        } else if ($rolUsuario == 'Administrativo') {
            $queryModificarAdmTec = "UPDATE adm_tecnicos SET passAdmTecnicos = '" . $nuevaPassword . "' WHERE idAdmTecnicos = '" . $idUsuario."'";

            $resModificarAdmTec = mysqli_query($conexion, $queryModificarAdmTec);

            // echo $queryModificarJefe;
            if ($resModificarAdmTec) {
                header('Location: ../sdo-admtec/index.php?exitoCambioPassword=true');
            } else {
                header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
            }
        } else if ($rolUsuario == 'Mesa Ayuda') {
            $queryModificarMesaAyuda = "UPDATE mesa_ayuda SET passMesaAyuda = '" . $nuevaPassword . "' WHERE idMesaAyuda = '" . $idUsuario."'";

            $resModificarMesaAyuda = mysqli_query($conexion, $queryModificarMesaAyuda);

            // echo $queryModificarJefe;
            if ($resModificarMesaAyuda) {
                header('Location: ../sdo-mesa-ayuda/index.php?loginExito=true&exitoCambioPassword=true');
            } else {
                header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
            }
        } else {
            header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
        }
    } else {
        header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
    }
} else {
    header('Location: ../sdo-flujo/login.php?errorCambioPassword=true');
}
