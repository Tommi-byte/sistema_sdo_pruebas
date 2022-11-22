<?php

include('funciones.php');
include_once('conexion.php');


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$rolUsuario = $_SESSION['rolUsuario'];

$rolUsuario2 = strtolower($rolUsuario);

$ruta = "";

if ($rolUsuario2 == "personal") {

    $ruta = "sdo-personal";

} else if ($rolUsuario2 == "administrativo") {

    $ruta = "sdo-admtec";

} else if ($rolUsuario2 == "jefe tecnico") {

    $ruta = "sdo-jefestecnicos";
    
} else if ($rolUsuario2 == "administrador") {

    $ruta = "sdo-administrador";
    
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

if (isset($_POST['observacionEquipo'], $_POST['idEquipo'], $_POST['personalObservacion'])) {

    $observacionEquipo = $_POST['observacionEquipo'];
    $idEquipo = $_POST['idEquipo'];
    $personalObservacion = $_POST['personalObservacion'];

    if (!empty($observacionEquipo)) {

        $observacionEquipo = str_replace("'", "\'", $observacionEquipo);
    }

    if (!empty($observacionEquipo) && $idEquipo > 0 && !empty($personalObservacion)) {

        $query = "INSERT INTO equipos_observaciones(idObservaciones,detalleObservaciones,fechaObservaciones,personalObservacion,idEquipo,esForzado)";
        $query .=  "VALUES (NULL,'" . $observacionEquipo . "',NOW(),'" . $personalObservacion . "'," . $idEquipo . ",'Observación Normal')";
        $res = mysqli_query($conexion, $query);

        if ($res) {
            header('Location: ../'.$ruta.'/equipos-observaciones.php?exitoAgregarObservacion=true');
        } else {
            header('Location: ../'.$ruta.'/equipos-observaciones.php?errorAgregarObservacion1=true');
        }
    } else {
        header('Location: ../'.$ruta.'/equipos-observaciones.php?errorAgregarObservacion2=true');
    }
} else {
    header('Location: ../'.$ruta.'/equipos-observaciones.php?errorAgregarObservacion3=true');
}

mysqli_close($conexion);
