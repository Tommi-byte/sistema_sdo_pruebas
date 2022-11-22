<?php

include_once 'conexion.php';
include_once 'funciones.php';


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
} else {

    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

$headerTextCorrecto = 'Location: ../' . $ruta . '/solicitudes_detalle.php?exitoFinalizarSolicitud=true';
$headerError = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorIdSolicitud=true';
$headerError2 = 'Location: ../' . $ruta . '/solicitudes_recibidas.php?errorDepartamentoResponsable=true';
$headerError3 = 'Location: ../' . $ruta . '/solicitudes_detalle.php?errorFinalizarSolicitud=true';


if (isset($_POST['idSolicitud'], $_POST['conclusionProblema'], $_POST['datosFinalizador'], $_POST['nomSolicitante'])) {

    $idSolicitud = $_POST['idSolicitud'];

    $conclusionProblema = $_POST['conclusionProblema'];

    $datosFinalizador = trim($_POST['datosFinalizador']);

    $nomSolicitante = trim($_POST['nomSolicitante']);

    $folioSolicitud = getFolioSolicitud($idSolicitud);

    if (!empty($conclusionProblema)) {

        $conclusionProblema = str_replace("'", "\'", $conclusionProblema);
    }

    if ($idSolicitud > 0 || !empty($conclusionProblema) && !empty($datosFinalizador) && !empty($nomSolicitante) && !empty($folioSolicitud)) {

        $queryFinalizar = "UPDATE solicitudes_soportes SET terminoSolicitud = NOW() , finalizadaSolicitud = 1 , situacionSolicitud = 'Solicitud Finalizada', conclusionSolicitud = '" . $conclusionProblema . "' WHERE idSolicitud = " . $idSolicitud;

        $resFinalizar = mysqli_query($conexion, $queryFinalizar);

        if ($resFinalizar) {

            $observacion = $datosFinalizador . ' ha finalizado la Solicitud de Soporte # ' . getFolioSolicitud($idSolicitud) . ' .';

            $tipoObservaSolicitudes = "Finalización de Solicitud";

            $sqlObservacion = "INSERT INTO observaciones_solicitudes(idObservaSolicitudes,detalleObservaSolicitudes,fechaObservaSolicitudes,tipoObservaSolicitudes,creadorObservaSolicitudes,idSolicitud)
                        VALUES(NULL,'" . $observacion . "',NOW(),'" . $tipoObservaSolicitudes . "','" . $datosFinalizador . "'," . $idSolicitud . ")";

            $resObservacion = mysqli_query($conexion, $sqlObservacion);

            if ($resObservacion) {
                $usoMaterial = '';

                $usoFoto = '';

                if (isset($_POST['materialUsado'], $_POST['unidad'], $_POST['cantidad'])) {

                    $materialUsado = $_POST['materialUsado'];
                    $unidad = $_POST['unidad'];
                    $cantidad = $_POST['cantidad'];

                    if (!empty($materialUsado) && !empty($unidad) && !empty($cantidad)) {

                        for ($i = 0; $i < count($materialUsado); $i++) {
                            if (!empty($materialUsado[$i])) {
                                $materialFor = $materialUsado[$i];
                                $unidadFor = $unidad[$i];
                                $cantidadFor = $cantidad[$i];

                                $queryMaterial = "INSERT INTO material_soporte(idMaterial,nomMaterial,unidadMaterial,cantidadMaterial,idSolicitud)
                                    VALUES(NULL,'" . $materialFor . "','" . $unidadFor . "','" . $cantidadFor . "'," . $idSolicitud . ")";

                                $resMaterial = mysqli_query($conexion, $queryMaterial);

                                if ($resMaterial) {
                                    $_SESSION['usoMaterialSolicitud'] = 'Usando';
                                } else {
                                    $_SESSION['usoMaterialSolicitud'] = 'Vacio';
                                }
                            } else {
                                $_SESSION['usoMaterialSolicitud'] = 'Vacio';
                            }
                        }
                    } else {
                        $_SESSION['usoMaterialSolicitud'] = 'Vacio';
                    }
                } else {
                    $_SESSION['usoMaterialSolicitud'] = 'Vacio';
                }

                $emailSolicitante = getEmailSolicitud($idSolicitud);

                if (!empty($emailSolicitante)) {
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

                        $message .= "<table height='100%' width='100%' border='0'>";

                        $message .= "<tr><td>";

                        $message .= "<table width='100%' border='0' style='background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

                        $message .= "<thead>";

                        $message .= "</thead>";

                        $message .= "<tbody>";

                        $message .= "<tr>";
                        $message .= "<td><br><h2 align='center'>SISTEMA DE TICKETS DE SOPORTE<br>&nbsp;<br><img src='https://cdnimg.bnamericas.com/QNBIixQugonFwhWLMWquGdAuLNTdViLJxwJUeVCETPAVucFxvIjNFgkxIIkUJUbK.png' alt='SSVQ' width='150' height='150'></h2><hr></td>";


                        $message .= "</tr>";



                        $message .= "<tr>";
                        $message .= "<td>";
                        $message .= "<p style='font-size:20px;' align='center'><b>Estado de Solicitud de Soporte - SDO</b><br></p><br>";
                        $message .= "<p style='font-size:20px;'><b>Estimado(a): " . $nomSolicitante . "</b></p>";
                        $message .= "<p style='font-size:20px;' align='justify'>Su Solicitud de Soporte N# <b>" . $folioSolicitud . "</b> fue Finalizada por " . $datosFinalizador . ".</p>";

                        $message .= "</td>";
                        $message .= "</tr>";

                        $message .= "<tr>";
                        $message .= "<td>";
                        $message .= "<p style='font-size:20px;' align='justify'>Las razones de finalizaci&oacute;n son las siguientes: <br></p>";
                        $message .= "<br></td>";
                        $message .= "</tr>";

                        $message .= "<tr>";
                        $message .= "<td>";
                        $message .= "<p style='font-size:20px;' align='justify'>" . nl2br($conclusionProblema) . "</p>";
                        $message .= "<br></td>";
                        $message .= "</tr>";
                        
                        $message .= "<tr>";
                        $message .= "<td colspan='4'>";
                        $message .= "<p style='font-size:20px;' align='justify'>En caso de no aceptar estos fundamentos, Ud. podra generar otro requerimiento para que sea revisado nuevamente.</p>";
                        $message .= "</td>";
                        $message .= "</tr>";

                        $message .= "<tr>";
                        $message .= "<td>";
                        $message .= "<p style='font-size:20px;' align='center'>Atte.<br><br>Administrador de Solicitudes de Soporte</p>";
                        $message .= "<br></td>";
                        $message .= "</tr>";


                        $message .= "</tbody>";

                        $message .= "</table>";

                        $message .= "</td></tr>";

                        $message .= "</table>";


                        $message .= "</body></html>";

                        //Content

                        $subject = 'Finalización de Solicitud de Soporte #' . $folioSolicitud;

                        $altMessage = 'Estimado(a): Su Solicitud ' . $folioSolicitud . ' ha sido finalizada.';

                        $mail->isHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = $subject;
                        $mail->Body    = $message;
                        $mail->AltBody = $altMessage;

                        if ($mail->send()) {
                            $_SESSION['enviarMail'] = 'Correcto';
                            header($headerTextCorrecto);
                        } else {
                            $_SESSION['enviarMail'] = 'Error';
                            header($headerTextCorrecto);
                        }
                    } catch (Exception $e) {
                        $_SESSION['enviarMail'] = 'Error';
                        header($headerTextCorrecto);
                    }
                } else {
                    $_SESSION['enviarMail'] = 'Error';
                    header($headerTextCorrecto);
                }

                
            } else {
                header($headerError3);
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
