<?php

include('funciones.php');
include_once('conexion.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$rolUsuario = '';
$rutaRol = '';
$rutaParkingRol = '';

if (isset($_POST['rolUsuario'])) {

    $rolUsuario = trim($_POST['rolUsuario']);

    if (!empty($rolUsuario)) {
        if ($rolUsuario == "Administrador") {

            $rutaRol = "sdo-administrador";

            $rutaParkingRol = 'sdo-administrador/actas-estacionamiento.php';
        } else if ($rolUsuario == "Personal") {

            $rutaRol = "sdo-personal/actas-listado.php";

            $rutaParkingRol = 'sdo-personal/actas-estacionamiento.php';
        } else if ($rolUsuario == "Directiva") {

            $rutaRol = "sdo-directiva";

            $rutaParkingRol = 'sdo-directiva/actas-estacionamiento.php';
        } else if ($rolUsuario == "Jefe Tecnico") {

            $rutaRol = "sdo-jefestecnicos/actas-administrar.php";

            $rutaParkingRol = 'sdo-jefestecnicos/actas-estacionamiento.php';
        } else if ($rolUsuario == "Administrativo") {

            $rutaRol = "sdo-admtec";

            $rutaParkingRol = 'sdo-admtec/actas-estacionamiento.php';
        } else {

            header('Location: ../sdo-flujo/login.php?errorLogin=true');
        }

        if (isset($_POST['patenteParking'], $_POST['antiguaPatente'], $_POST['modeloParking'], $_POST['idParking'], $_POST['rutActa2'], $_POST['idActa'])) {

            $patenteParking = trim($_POST['patenteParking']);
            $antiguaPatente = trim($_POST['antiguaPatente']);
            $modeloParking = trim($_POST['modeloParking']);
            $idParking = trim($_POST['idParking']);
            $rutActa2 = trim($_POST['rutActa2']);
            $idActa = trim($_POST['idActa']);

            if (empty($patenteParking) || empty($antiguaPatente) || empty($modeloParking) || empty($idParking) || empty($rutActa2) || empty($idActa)) {
                header('Location: ../' . $rutaParkingRol . '?errorModPatente=true');
            } else {

                if ($antiguaPatente == $patenteParking) {

                    $buscarPatente = 0;
                } else {
                    $buscarPatente = buscarPatente($patenteParking);
                }

                // echo $buscarPatente;
                // echo '<br><br>';
                // echo buscarPatente($patenteParking);

                if ($buscarPatente == 0) {
                    $queryModificar = "UPDATE parking SET patenteParking = '" . $patenteParking . "', modeloParking = '" . $modeloParking . "' WHERE idParking = " . $idParking;

                    $resModificar = mysqli_query($conexion, $queryModificar);

                    if ($resModificar) {

                        header('Location: ../' . $rutaParkingRol . '?exitoModPatente=true');
                    } else {
                        header('Location: ../' . $rutaParkingRol . '?errorModPatente=true');
                    }
                } else {
                    header('Location: ../' . $rutaParkingRol . '?errorPatenteExiste=true');
                }
            }
        } else {
            header('Location: ../' . $rutaParkingRol . '?errorModPatente=true');
        }
    } else {
        header('Location: sdo-flujo/login.php?errorLogin=true');
    }
} else if (isset($_SESSION['rolUsuario'])) {

    $rolUsuario = $_SESSION['rolUsuario'];

    if (!empty($rolUsuario)) {
        if ($rolUsuario == "Administrador") {

            $rutaRol = "sdo-administrador";

            $rutaParkingRol = 'sdo-administrador/actas-estacionamiento.php';
        } else if ($rolUsuario == "Personal") {

            $rutaRol = "sdo-personal/actas-listado.php";

            $rutaParkingRol = 'sdo-personal/actas-estacionamiento.php';
        } else if ($rolUsuario == "Directiva") {

            $rutaRol = "sdo-directiva";

            $rutaParkingRol = 'sdo-directiva/actas-estacionamiento.php';
        } else if ($rolUsuario == "Jefe Tecnico") {

            $rutaRol = "sdo-jefestecnicos/actas-administrar.php";

            $rutaParkingRol = 'sdo-jefestecnicos/actas-estacionamiento.php';
        } else if ($rolUsuario == "Administrativo") {

            $rutaRol = "sdo-admtec/actas-listado.php";

            $rutaParkingRol = 'sdo-admtec/actas-estacionamiento.php';
        } else {

            header('Location: ../sdo-flujo/login.php?errorLogin=true');
        }

        if (isset($_POST['patenteParking'], $_POST['antiguaPatente'], $_POST['modeloParking'], $_POST['idParking'], $_POST['rutActa2'], $_POST['idActa'])) {

            $patenteParking = trim($_POST['patenteParking']);
            $antiguaPatente = trim($_POST['antiguaPatente']);
            $modeloParking = trim($_POST['modeloParking']);
            $idParking = trim($_POST['idParking']);
            $rutActa2 = trim($_POST['rutActa2']);
            $idActa = trim($_POST['idActa']);

            if (empty($patenteParking) || empty($antiguaPatente) || empty($modeloParking) || empty($idParking) || empty($rutActa2) || empty($idActa)) {
                header('Location: ../' . $rutaRol . '?errorModPatente=true');
            } else {

                if ($antiguaPatente == $patenteParking) {

                    $buscarPatente = 0;
                } else {
                    $buscarPatente = buscarPatente($patenteParking);
                }

                // echo $buscarPatente;
                // echo '<br><br>';
                // echo buscarPatente($patenteParking);

                if ($buscarPatente == 0) {
                    $queryModificar = "UPDATE parking SET patenteParking = '" . $patenteParking . "', modeloParking = '" . $modeloParking . "' WHERE idParking = " . $idParking;

                    $resModificar = mysqli_query($conexion, $queryModificar);

                    if ($resModificar) {

                        header('Location: ../' . $rutaParkingRol . '?exitoModPatente=true');
                    } else {
                        header('Location: ../' . $rutaParkingRol . '?errorModPatente=true');
                    }
                } else {
                    header('Location: ../' . $rutaParkingRol . '?errorPatenteExiste=true');
                }
            }
        } else {
            header('Location: ../' . $rutaParkingRol . '?errorModPatente=true');
        }
    } else {
        header('Location: sdo-flujo/login.php?errorLogin=true');
    }
} else {
    header('Location: sdo-flujo/login.php?errorLogin=true');
}
