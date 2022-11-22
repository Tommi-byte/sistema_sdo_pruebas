<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['nomUsuario'], $_POST['tipoUsuario'], $_POST['idSubCategoriaParaDescarga'])) {

    $nomUsuario = trim($_POST['nomUsuario']);
    $tipoUsuario = trim($_POST['tipoUsuario']);
    $idSubCategoriaParaDescarga = trim($_POST['idSubCategoriaParaDescarga']);

    $nomCompleto = $nomUsuario . ' (' . $tipoUsuario . ')';

    $query = "";
    $tipoDescarga = "Historico Completo de Equipos de Sistema según Categoria ";
    $observaciones = "";

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
        header('Location: ../sdo-flujo/sdo-flujo/login.php?errorSesion=true');
    }

    date_default_timezone_set('America/Santiago');

    if ($idSubCategoriaParaDescarga > 0) {

        $fecha = date('d-m-Y H:i');
        $fechaInicio = strtotime($fecha);
        $fechaInicio = fechaEspañol($fechaInicio);
        $horaInicio = date('H:i', strtotime($fecha));

        $observaciones = $nomCompleto . ' ha descargado el Historial Completo de '.getNomSubCategoria($idSubCategoriaParaDescarga).' perteneciente a la Categoria '.getNomCategoria(getCategoriaSegunSubcategoria($idSubCategoriaParaDescarga)).' el día ' . $fechaInicio . ' a las ' . $horaInicio . ' hrs.';

        $tipoDescarga .= ' '.getNomSubCategoria($idSubCategoriaParaDescarga);

        $query = "INSERT INTO descargas_historico_sistemas(idDescargaH,fechaDescargaH,usuarioDescargaH,tipoDescargaH,comentarioDescargaH,idSubCategoria)";
        $query .= " VALUES(NULL,NOW(),'" . $nomCompleto . "','" . $tipoDescarga . "','" . $observaciones . "','" . $idSubCategoriaParaDescarga . "')";

        $res = mysqli_query($conexion, $query);

        if ($res) {

            $_SESSION['idDescargaH'] = mysqli_insert_id($conexion);
            header("Location: ../sdo-pdf/SDO-HistoricoSistema.php");
        } else {
            header('Location: ../'.$ruta.'/sistemas-visualizar.php?errorDescargarHistorico1=true');
        }
    } else {
        header('Location: ../'.$ruta.'/sistemas-visualizar.php?errorDescargarHistorico2=true');
    }
} else {
    header('Location: ../'.$ruta.'/sistemas-visualizar.php?errorDescargarHistorico3=true');
}
