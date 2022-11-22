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

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('funciones.php');
include_once('conexion.php');


if (isset($_POST['nomSolicitud'], $_POST['rutSolicitud'], $_POST['deptoSolicitud'], $_POST['correoSolicitud'], $_POST['celularSolicitante'], $_POST['pmaSolicitud'], $_POST['detalleSolicitud'])) {

    $nomSolicitud = trim($_POST['nomSolicitud']);
    $rutSolicitud = trim($_POST['rutSolicitud']);
    $deptoSolicitud = trim($_POST['deptoSolicitud']);
    $correoSolicitud = trim($_POST['correoSolicitud']);
    $celularSolicitante = trim($_POST['celularSolicitante']);
    $departamentoResponsable = trim($_POST['departamentoResponsable']);
    $tipoObservacion = trim($_POST['tipoObservacion']);
    $pmaSolicitud = trim($_POST['pmaSolicitud']);
    $detalleSolicitud = $_POST['detalleSolicitud'];

    if (!empty($detalleSolicitud)) {
        $detalleSolicitud = str_replace("'", "\'", $detalleSolicitud);
    }

    if (!empty($deptoSolicitud)) {
        $deptoSolicitud = str_replace("\\", '/', $deptoSolicitud);
    }



    if (empty($nomSolicitud) || empty($rutSolicitud) || empty($deptoSolicitud) || empty($correoSolicitud) || empty($celularSolicitante) || empty($departamentoResponsable) || empty($tipoObservacion) || $departamentoResponsable < 1 || $tipoObservacion < 1 || empty($pmaSolicitud) || empty($detalleSolicitud)) {
        header('Location: ../sdo-flujo/soporte_verificarRUT.php?errorAgregarSolicitud=true');
    } else {

        date_default_timezone_set('America/Santiago');

        $inicioSolicitud = date("Y-m-d H:i:s");

        $terminoSolicitud = date("Y-m-d H:i:s", strtotime($inicioSolicitud . "+ 100 years"));

        $numRandom = rand(10000, 999999);

        $nomDepartamento = getNomDepartamento($departamentoResponsable);

        $nomTipoObservacion = getNomTipoSolicitud($tipoObservacion);

        do {
            $numRandom = rand(10000, 999999);
        } while (existeAleatorio($numRandom) == 1);

        if (existeAleatorio($numRandom) == 0) {
            $query = "INSERT INTO solicitudes_soportes(idSolicitud,nomSolicitante,rutSolicitante,deptoSolicitante,emailSolicitante,telefonoSolicitante,ubicacionSolicitud,deptoResponsable,tipoProblemaSolicitud,problemaSolicitud,inicioSolicitud,terminoSolicitud,canceladaSolicitud,finalizadaSolicitud,nuevaObservacion)";
            $query .=  "VALUES (NULL,'" . $nomSolicitud . "','" . $rutSolicitud . "','" . $deptoSolicitud . "','" . $correoSolicitud . "','" . $celularSolicitante . "','" . $pmaSolicitud . "','" . $nomDepartamento . "','" . $nomTipoObservacion . "','" . $detalleSolicitud . "','" . $inicioSolicitud . "','" . $terminoSolicitud . "',0,0,0)";
            $res = mysqli_query($conexion, $query);


            if ($res) {

                $solicitudSoporte = mysqli_insert_id($conexion);

                $folioSolicitud = 'SS-' . $solicitudSoporte . '-' . $numRandom;

                $query2 = "UPDATE solicitudes_soportes SET folioSolicitud = '" . $folioSolicitud . "', aleatorioSolicitud = '" . $numRandom . "', situacionSolicitud = 'Solicitud Creada' WHERE idSolicitud=" . $solicitudSoporte;
                $res2 = mysqli_query($conexion, $query2);

                if ($res2) {

                    $_SESSION['folioSolicitud'] = $folioSolicitud;

                    $_SESSION['nomSolicitante'] = $nomSolicitud;

                    $detalleObservaSolicitudes = 'Se genera Solicitud de Soporte con Folio N° " ' . $folioSolicitud . ' " para Departamento de ' . $nomDepartamento . ' con Categoria " ' . $nomTipoObservacion . ' " y con el siguiente detalle: \n\n';

                    $detalleObservaSolicitudes .= $detalleSolicitud;

                    $query3 = "INSERT INTO observaciones_solicitudes(idObservaSolicitudes,detalleObservaSolicitudes,fechaObservaSolicitudes,tipoObservaSolicitudes,creadorObservaSolicitudes,idSolicitud)";
                    $query3 .=  "VALUES (NULL,'" . $detalleObservaSolicitudes . "',NOW(),'Creación de Solicitud de Soporte','" . $nomSolicitud . "','" . $solicitudSoporte . "')";
                    $res3 = mysqli_query($conexion, $query3);

                    if ($res2) {


                        try {
                            
                            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'saladecontrolhbqp@gmail.com';                     //SMTP username
                            $mail->Password   = 'dcdxxsysxkjopsyv';                               //SMTP password
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
                            $mail->addAddress($correoSolicitud, $nomSolicitud);
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
                            $message .= "<td colspan='2' style='padding:15px;'>";
                            $message .= "<p style='font-size:20px;'>Estimado(a): " . $nomSolicitud . "</p>";
                            $message .= "</td>";
                            $message .= "</tr>";

                            $message .= "<tr>";
                            $message .= "<td colspan='2' style='padding:15px;'>";
                            $message .= "<p style='font-size:20px;' align='justify'>Su Solicitud ha sido ingresada con &eacute;xito en nuestro sistema y se le ha asignado el N# <b>" . $folioSolicitud . "</b>.</p>";
                            $message .= "</td>";
                            $message .= "</tr>";

                            $message .= "<tr>";
                            $message .= "<td colspan='2' style='padding:15px;'>";
                            $message .= "<p style='font-size:20px;' align='justify'>Para consultar las actualizaciones de su estado, debe ingresar al siguiente enlace: <a style='color:blue;' href='http://10.68.120.2/sdo/sdo-flujo/soporte_consultaEstado.php'>Comprobar Estado de Solicitud</a></p>";
                            $message .= "</td>";
                            $message .= "</tr>";

                            $message .= "<tr>";
                            $message .= "<td colspan='2' style='padding:15px;'>";
                            $message .= "<p style='font-size:20px;' align='justify'>Destacar que la informaci&oacute;n debe ser revisada en un Equipo del Hospital Biprovincial Quillota Petorca.</p>";
                            $message .= "</td>";
                            $message .= "</tr>";


                            $message .= "<tr>";
                            $message .= "<td colspan='2' style='padding:15px;'>";
                            $message .= "<p style='font-size:20px;' align='center'>Atte.<br><br>Administrador de Solicitudes de Soporte</p>";
                            $message .= "<br><br></td>";
                            $message .= "</tr>";

                            $message .= "</tbody>";

                            $message .= "</table>";

                            $message .= "</td></tr>";

                            $message .= "</table>";

                            $message .= "</body></html>";

                            //Content

                            $subject = 'Creación de Solicitud de Soporte #' . $folioSolicitud;

                            $altMessage = 'Estimado(a): Su Solicitud ' . $folioSolicitud . ' se encuentra en el siguiente estado: "Ingresada en Sistema"';

                            $mail->isHTML(true);
                            $mail->CharSet = 'UTF-8';
                            $mail->Subject = $subject;
                            $mail->Body    = $message;
                            $mail->AltBody = $altMessage;

                            if ($mail->send()) {
                                echo "<script>window.location.assign('../sdo-flujo/soporte_mostrarFolio.php')</script>";
                            } else {
                                header('Location: ../sdo-flujo/soporte_verificarRUT.php?errorEnviarMail=true');
                            }
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                    } else {
                        header('Location: ../sdo-flujo/soporte_verificarRUT.php?errorAgregarSolicitud=true');
                    }
                } else {
                    header('Location: ../sdo-flujo/soporte_verificarRUT.php?errorAgregarSolicitud=true');
                }
            } else {
                header('Location: ../sdo-flujo/soporte_verificarRUT.php?errorAgregarSolicitud=true');
            }
        } else {
            header('Location: ../sdo-flujo/soporte_verificarRUT.php?errorAgregarSolicitud=true');
        }
    }
} else {
    header('Location: ../sdo-flujo/soporte_verificarRUT.php?errorAgregarSolicitud=true');
}

mysqli_close($conexion);
