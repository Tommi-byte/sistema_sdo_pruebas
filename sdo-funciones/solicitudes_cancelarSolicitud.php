<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

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

$headerTextCorrecto = 'Location: ../' . $ruta . '/solicitudes_detalle.php?exitoCancelarSolicitud=true';
$headerError = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorIdSolicitud=true';
$headerError2 = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorDepartamentoResponsable=true';
$headerError3 = 'Location: ../' . $ruta . '/solicitudes_detalle.php?errorCancelarSolicitud=true';
$headerError4 = 'Location: ../' . $ruta . '/solicitudes_detalle.php?errorCancelarSinFundamentos=true';
$headerError5 = 'Location: ../' . $ruta . '/solicitudes_detalle.php?errorCancelarObservacion=true';
$headerError6 = 'Location: ../' . $ruta . '/solicitudes_detalle.php?errorEnviarEmail=true';


if (isset($_POST['idSolicitud'])) {

    $idSolicitud = trim($_POST['idSolicitud']);

    if ($idSolicitud !== 0) {

        if (isset($_POST['nomQuienCancela'], $_POST['razonesCancelar'])) {

            $nomQuienCancela = trim($_POST['nomQuienCancela']);
            $razonesCancelar = trim($_POST['razonesCancelar']);

            if (empty($nomQuienCancela) || empty($razonesCancelar)) {
                header($headerError4);
            } else {

                $_SESSION['idSolicitud'] = $idSolicitud;

                $sqlCancelarSolicitud = "UPDATE solicitudes_soportes SET canceladaSolicitud = '1', situacionSolicitud = 'Solicitud Cancelada', terminoSolicitud = NOW() WHERE idSolicitud = '" . $idSolicitud . "'";

                $resCancelarSolicitud = mysqli_query($conexion, $sqlCancelarSolicitud);

                if ($resCancelarSolicitud) {

                    $observacion = $nomQuienCancela . ' ha cancelado la Solicitud de Soporte, debido a las siguientes razones: \n\n ' . $razonesCancelar;

                    $tipoObservaSolicitudes = "Solicitud Cancelada";

                    $sqlObservacion = "INSERT INTO observaciones_solicitudes(idObservaSolicitudes,detalleObservaSolicitudes,fechaObservaSolicitudes,tipoObservaSolicitudes,creadorObservaSolicitudes,idSolicitud)
                        VALUES(NULL,'" . $observacion . "',NOW(),'" . $tipoObservaSolicitudes . "','" . $nomQuienCancela . "'," . $idSolicitud . ")";

                    $resObservacion = mysqli_query($conexion, $sqlObservacion);

                    if ($resObservacion) {

                        $datosSolicitud = array();
                        $datosSolicitud = getSolicitudSoporte($idSolicitud);

                        $folioSolicitud = $datosSolicitud['folioSolicitud'];

                        $nomSolicitante = $datosSolicitud['nomSolicitante'];

                        $deptoSolicitante = $datosSolicitud['deptoSolicitante'];

                        $ubicacionSolicitud = $datosSolicitud['ubicacionSolicitud'];

                        $emailSolicitante = $datosSolicitud['emailSolicitante'];

                        try {

                            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'saladecontrolhbqp@gmail.com';                     //SMTP username
                            $mail->Password   = 'khbwzwrbjlzmnniz';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;

                            //Set who the message is to be sent from
                            //Note that with gmail you can only use your account address (same as `Username`)
                            //or predefined aliases that you have configured within your account.
                            //Do not use user-submitted addresses in here
                            $mail->setFrom('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');

                            //Set an alternative reply-to address
                            //This is a good place to put user-submitted addresses
                            $mail->addReplyTo('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');

                            //Set who the message is to be sent to
                            $mail->addAddress($emailSolicitante, $nomSolicitante);
                            $mail->addCC('yorgocasimis@hotmail.cl', 'Yorgo Casimis');
                            $mail->addCC('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');
                            $mail->addCC('tecnicos.cc.hbqp@redsalud.gob.cl', 'Técnicos de Control Centralizado');
                            // $mail->addCC('jorge.cantillano@redsalud.gov.cl','Alejandro Cantillano - Jefe de Control Centralizado y Especialidades');

                            //Set the subject line

                            $message  = "<html><body>";

                            $message .= "<table height='100%' width='100%' cellpadding='0' cellspacing='0' border='0'>";

                            $message .= "<tr><td>";

                            $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

                            $message .= "<thead>";

                            $message .= "</thead>";

                            $message .= "<tbody>";

                            $message .= "<tr>";
                            $message .= "<td><br><h2 align='center'>Sistema de Tickets de Soporte<br>&nbsp;<br><img src='https://cdnimg.bnamericas.com/QNBIixQugonFwhWLMWquGdAuLNTdViLJxwJUeVCETPAVucFxvIjNFgkxIIkUJUbK.png' alt='SSVQ' width='100' height='100'></h2><hr></td>";


                            $message .= "</tr>";

                            $message .= "<tr>";
                            $message .= "<td colspan='4'>";
                            $message .= "<p style='font-size:20px;'>Estimado(a) ".$nomSolicitante." :</p>";
                            $message .= "</td>";
                            $message .= "</tr>";

                            $message .= "<tr>";
                            $message .= "<td colspan='4'>";
                            $message .= "<p style='font-size:20px;' align='justify'>Junto con saludar, le informo que su Solicitud N# <b>".$folioSolicitud."</b> ha sido <b>Cancelada</b> por el &Aacute;rea T&eacute;cnica correspondiente, decisi&oacute;n basada en las siguientes razones:</p>";
                            $message .= "</td>";
                            $message .= "</tr>";

                            $message .= "<tr>";
                            $message .= "<td colspan='4'>";
                            $message .= "<p style='font-size:20px; font-style: italic;' align='justify'>".nl2br($razonesCancelar)."";
                            $message .= "</td>";
                            $message .= "</tr>";

                            $message .= "<tr>";
                            $message .= "<td colspan='4'>";
                            $message .= "<p style='font-size:20px;' align='justify'>En caso de no aceptar estos fundamentos, Ud. podra generar otro requerimiento para que sea revisado nuevamente.</p>";
                            $message .= "</td>";
                            $message .= "</tr>";


                            $message .= "<tr>";
                            $message .= "<td colspan='4'>";
                            $message .= "<p style='font-size:20px;' align='center'>Saludos cordiales.<br><br>Administrador de Solicitudes de Soporte</p>";
                            $message .= "<br><br></td>";
                            $message .= "</tr>";

                            $message .= "</tbody>";

                            $message .= "</table>";

                            $message .= "</td></tr>";

                            $message .= "</table>";

                            $message .= "</body></html>";

                            //Content

                            $subject = 'Cancelación de Solicitud de Soporte #' . $folioSolicitud;

                            $altMessage = 'Junto con saludar, le comunico que la Solicitud N# ' . $folioSolicitud . ' ha sido Cancelada.';

                            $mail->isHTML(true);
                            $mail->CharSet = 'UTF-8';
                            $mail->Subject = $subject;
                            $mail->Body    = $message;
                            $mail->AltBody = $altMessage;

                            if ($mail->send()) {
                                header($headerTextCorrecto);
                            } else {
                                header($headerError6);
                            }
                        } catch (Exception $e) {
                            header($headerError6);
                        }
                    } else {
                        header($headerError5);
                    }
                } else {
                    header($headerError3);
                }
            }
        } else {
            header($headerError4);
        }
    } else {
        header($headerError);
    }
} else {
    header($headerError);
}
