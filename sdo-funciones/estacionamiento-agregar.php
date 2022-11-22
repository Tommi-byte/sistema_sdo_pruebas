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

            $rutaRol = "sdo-admtec/actas-listado.php";

            $rutaParkingRol = 'sdo-admtec/actas-estacionamiento.php';
        } else {

            header('Location: ../sdo-flujo/login.php?errorLogin=true');
        }

        if (isset($_POST['patenteParking'], $_POST['modeloParking'], $_POST['idActa'], $_POST['rutTarjeta'])) {

            $patenteParking = trim($_POST['patenteParking']);
            $modeloParking = trim($_POST['modeloParking']);
            $rutTarjeta = trim($_POST['rutTarjeta']);
            $idActa = trim($_POST['idActa']);

            if (empty($patenteParking) || empty($modeloParking) || empty($idActa) || empty($rutTarjeta)) {
                header('Location: ../' . $rutaParkingRol . '?errorModPatente=true');
            } else {


                $buscarPatente = buscarPatente($patenteParking);

                $contarPatente = contarPatente($rutTarjeta);

                // echo $buscarPatente;
                // echo '<br><br>';
                // echo buscarPatente($patenteParking);

                if ($buscarPatente == 0) {
                    if ($contarPatente < 2) {
                        $queryAgregar = "INSERT INTO parking(idParking,patenteParking,modeloParking,rutParking) ";
                        $queryAgregar .= "VALUES(NULL,'".$patenteParking."','".$modeloParking."','".$rutTarjeta."');";
    
                        $resAgregar = mysqli_query($conexion, $queryAgregar);
    
                        if ($resAgregar) {
    
                            header('Location: ../' . $rutaParkingRol . '?exitoAgregarPatente=true');
                        } else {
                            header('Location: ../' . $rutaParkingRol . '?errorAgregarPatente=true');
                        }
                    } else {
                        header('Location: ../' . $rutaParkingRol . '?errorMaximoParking=true');
                    }
                } else {
                    header('Location: ../' . $rutaParkingRol . '?errorPatenteExiste=true');
                }
            }
        } else {
            header('Location: ../' . $rutaParkingRol . '?errorAgregarPatente=true');
        }
    } else {
        header('Location: sdo-flujo/login.php?errorLogin=true');
    }
}else {
    header('Location: sdo-flujo/login.php?errorLogin=true');
}
