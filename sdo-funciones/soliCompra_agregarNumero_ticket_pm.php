<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$rolUsuario = $_SESSION['rolUsuario'];

$nomCreador = $_SESSION['nomUsuario'];

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
} else if ($rolUsuario2 == "mesa ayuda") {
    $ruta = "sdo-mesa-ayuda";
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

$headerExito = 'Location: ../' . $ruta . '/tickets_solicitarCompras_pm.php?exitoAsignarNumInterno=true';
$headerError = 'Location: ../' . $ruta . '/tickets_solicitarCompras_pm.php?errorAsignarNumInterno=true';
$headerExiste = 'Location: ../' . $ruta . '/tickets_solicitarCompras_pm.php?existeAsignarNumInterno=true';

if (isset($_POST['addNumInterno'], $_POST['idSoliCompra'])) {

    $addNumInterno = trim($_POST['addNumInterno']);
    $idSoliCompra = trim($_POST['idSoliCompra']);

    $existeNumInterno = existeNumInterno($addNumInterno);

    if ($addNumInterno > 0 && $idSoliCompra > 0) {

        if ($existeNumInterno == 0) {

            $queryModificar = "UPDATE solicitudes_compra_tickets_pm SET numSoliCompra = '" . $addNumInterno . "', estadoSoliCompra = 'Recibida por Puesta en Marcha' WHERE idSoliCompra = " . $idSoliCompra;

            $resModificar = mysqli_query($conexion, $queryModificar);

            if ($resModificar) {
                header($headerExito);
            } else {
                header($headerError);
            }
        } else {
            header($headerExiste);
        }
    } else {
        header($headerError);
    }
} else {
    header($headerError);
}
