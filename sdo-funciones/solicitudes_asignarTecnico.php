<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

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
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

$headerTextCorrecto = 'Location: ../' . $ruta . '/solicitudes_detalle.php?exitoAsignarPersonal=true';
$headerError = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorIdSolicitud=true';
$headerError2 = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorDepartamentoResponsable=true';
$headerError3 = 'Location: ../' . $ruta . '/solicitudes_detalle.php?errorAsignarPersonal=true';

if (isset($_POST['idSolicitud'])) {

    $idSolicitud = trim($_POST['idSolicitud']);

    if ($idSolicitud !== 0) {

        $_SESSION['idSolicitud'] = $idSolicitud;

        if (isset($_POST['nomPersonal'], $_POST['departamentoResponsable'], $_POST['tecnicoResponsable'])) {

            $nomPersonal = trim($_POST['nomPersonal']);
            $departamentoResponsable = trim($_POST['departamentoResponsable']);
            $tecnicoResponsable = trim($_POST['tecnicoResponsable']);


            if (empty($departamentoResponsable) || empty($tecnicoResponsable || empty($nomPersonal))) {
                header($headerError3);
            } else {

                $esAdministrativo = strpos($tecnicoResponsable, 'Administrativo');

                $esJefe = strpos($tecnicoResponsable, 'Jefe');

                $esPersonal = strpos($tecnicoResponsable, 'Personal');

                $datosSolicitud = array();
                $datosSolicitud = getSolicitudSoporte($idSolicitud);

                $folioSolicitud = $datosSolicitud['folioSolicitud'];

                $nomSolicitante = $datosSolicitud['nomSolicitante'];

                $deptoSolicitante = $datosSolicitud['deptoSolicitante'];

                $ubicacionSolicitud = $datosSolicitud['ubicacionSolicitud'];

                $emailSolicitante = $datosSolicitud['emailSolicitante'];

                $nomAsignado = '';
                $cargoAsignado = '';
                $emailAsignado = '';

                //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
                if ($esAdministrativo === false) {
                    if ($esJefe === false) {
                        if ($esPersonal === false) {
                            header($headerError3);
                        } else {
                            $separada = explode('Personal', $tecnicoResponsable);
    
                            $datosPersonal = array();
                            $datosPersonal = getDatosPersonal($separada[1]);
    
                            $nomAsignado = $datosPersonal['nomPersonal'];
                            $nomAsignadoCompleto = $datosPersonal['nomPersonal'] . ' (' . $datosPersonal['cargoPersonal'] . ')';
    
                            $emailPersonal = $datosPersonal['emailPersonal'];
    
                            $emailAsignado .= $emailPersonal;
                        }
                    } else {
                        $separada = explode('Jefe', $tecnicoResponsable);

                        $datosJefe = array();
                        $datosJefe = getDatosJefe($separada[1]);

                        $nomAsignado = $datosJefe['nomJefe'];
                        $nomAsignadoCompleto = $datosJefe['nomJefe'] . ' (' . $datosJefe['cargoJefe'] . ')';

                        $emailJefe = $datosJefe['emailJefe'];

                        $emailAsignado .= $emailJefe;
                    }
                } else {
                    $separada = explode('Administrativo', $tecnicoResponsable);

                    $datosAdministrativo = array();
                    $datosAdministrativo = getDatosAdministrativo($separada[1]);

                    $nomAsignado = $datosAdministrativo['nomAdmTecnicos'];
                    $nomAsignadoCompleto = $datosAdministrativo['nomAdmTecnicos'] . ' (Administrativo)';

                    $emailAdministrativo = $datosAdministrativo['emailAdmTecnicos'];

                    $emailAsignado .= $emailAdministrativo;
                }


                $deptoResponsableSQL = getDeptoResponsableSolicitud($idSolicitud);

                if ($departamentoResponsable == $deptoResponsableSQL) {
                    $sqlAsignarTecnico = "UPDATE solicitudes_soportes SET tecnicoSolicitud = '" . $nomAsignadoCompleto . "', situacionSolicitud = 'Solicitud con Personal Asignado'  WHERE idSolicitud = '" . $idSolicitud . "'";

                    $resAsignarTecnico = mysqli_query($conexion, $sqlAsignarTecnico);

                    if ($resAsignarTecnico) {

                        $observacion = 'Se ha asignado a ' . $nomAsignadoCompleto . ' de ' . $departamentoResponsable . ' para Revisión de esta Solicitud';

                        $tipoObservaSolicitudes = "Asignación de Personal";

                        $sqlObservacion = "INSERT INTO observaciones_solicitudes(idObservaSolicitudes,detalleObservaSolicitudes,fechaObservaSolicitudes,tipoObservaSolicitudes,creadorObservaSolicitudes,idSolicitud)
                            VALUES(NULL,'" . $observacion . "',NOW(),'" . $tipoObservaSolicitudes . "','" . $nomPersonal . "'," . $idSolicitud . ")";

                        $resObservacion = mysqli_query($conexion, $sqlObservacion);

                        if ($resObservacion) {

                            header($headerTextCorrecto);

                        } else {
                            header($headerError3);
                        }
                    } else {
                        header($headerError3);
                    }
                } else {
                    header($headerError3);
                }
            }
        } else {
            header($headerError3);
        }
    } else {
        header($headerError);
    }
} else {
    header($headerError);
}
