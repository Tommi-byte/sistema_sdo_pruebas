<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

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
}  else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

$headerTextCorrecto = 'Location: ../' . $ruta . '/solicitudes_detalle.php?exitoCambiarDepartamento=true';
$headerError = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorIdSolicitud=true';
$headerError2 = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorDepartamentoResponsable=true';
$headerError3 = 'Location: ../' . $ruta . '/solicitudes_detalle.php?errorCambiarDepartamento=true';

if (isset($_POST['idSolicitud'])) {

    $idSolicitud = trim($_POST['idSolicitud']);

    if ($idSolicitud !== 0) {

        if (isset($_POST['nomCreador'], $_POST['deptoAnteriorResponsable'], $_POST['razonesCambio'])) {

            $nomCreador = trim($_POST['nomCreador']);
            $deptoAnteriorResponsable = trim($_POST['deptoAnteriorResponsable']);
            $razonesCambio = $_POST['razonesCambio'];

            if ($razonesCambio == '') {
            } else {
                $razonesCambio = str_replace("'", "\'", $razonesCambio);
            }

            if (empty($nomCreador) || empty($razonesCambio)) {
                header($headerError3.'0');
            } else {

                $_SESSION['idSolicitud'] = $idSolicitud;

                if (isset($_POST['departamentoNuevoResponsable'], $_POST['tipoObservacion'])) {

                    $departamentoNuevoResponsable = trim($_POST['departamentoNuevoResponsable']);
                    $tipoObservacion = trim($_POST['tipoObservacion']);
                    

                    if (!empty($departamentoNuevoResponsable) && $departamentoNuevoResponsable > 0 && !empty($tipoObservacion) && $tipoObservacion > 0) {

                        $departamentoNuevoResponsable = getNomDepartamento($departamentoNuevoResponsable);

                        $tipoObservacion = getNomTipoSolicitud($tipoObservacion);

                        $sqlCambiarDepartamento = "UPDATE solicitudes_soportes SET deptoResponsable = '" . $departamentoNuevoResponsable . "', tipoProblemaSolicitud = '" . $tipoObservacion . "', tecnicoSolicitud = '', situacionSolicitud = 'Se modifica Departamento Responsable' WHERE idSolicitud = '" . $idSolicitud . "'";

                        $resCambiarDepartamento = mysqli_query($conexion, $sqlCambiarDepartamento);

                        if ($resCambiarDepartamento) {

                            $folioModSolicitud = getFolioSolicitud($idSolicitud);

                            $observacion = $nomCreador . ' ha cambiado el Departamento Responsable de la Solicitud N°  " ' . $folioModSolicitud . ' " . Se ha asignado al Departamento de " ' . $departamentoNuevoResponsable . ' " con la Categoria " '.$tipoObservacion.' ", esto debido a las siguientes razones: \n\n '.$razonesCambio;

                            $tipoObservaSolicitudes = "Cambio de Departamento Responsable";

                            $sqlObservacion = "INSERT INTO observaciones_solicitudes(idObservaSolicitudes,detalleObservaSolicitudes,fechaObservaSolicitudes,tipoObservaSolicitudes,creadorObservaSolicitudes,idSolicitud)
                            VALUES(NULL,'" . $observacion . "',NOW(),'" . $tipoObservaSolicitudes . "','" . $nomCreador . "'," . $idSolicitud . ")";

                            $resObservacion = mysqli_query($conexion, $sqlObservacion);

                            if ($resObservacion) {
                                header($headerTextCorrecto);
                            } else {
                                header($headerError3.'1');
                            }
                        } else {
                            header($headerError3.'2');
                        }
                    } else {
                        header($headerError3.'3');
                    }
                } else {
                    header($headerError3.'4');
                }
            }
        } else {
            header($headerError);
        }
    } else {
        header($headerError);
    }
} else {
    header($headerError);
}
