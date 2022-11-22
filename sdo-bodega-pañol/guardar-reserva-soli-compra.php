<?php

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



$mail = new PHPMailer(true);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

    // exit;

    $reserva = 0;
    $solicitudReferente = trim($_POST['solicitud']);
    $numeroCompra = trim($_POST['numeroCompra']);
    $anexoSoliCompra = $_FILES['anexoSoliCompra'];
    $observaciones = trim($_POST['observaciones']);


    if(empty($observaciones)){

        $observaciones = "SIN OBSERVACIONES";
    }
    // var_dump($anexoSoliCompra);
    // exit;
    //$personalSolicita = trim($_POST['personalSolicita']);
    $departamentoPersonal = trim($_POST['departamentoSolicitante']);

  
    // var_dump($email);
    // exit;

    //Rescata email del solicitante
    $idJefe = trim($_POST['nomTecnicoRecepcionador']);

    $query = "SELECT * FROM jefes_tecnicos WHERE idJefe = ${idJefe}";
    $res = mysqli_query($conexion, $query);

    while($row = $res->fetch_assoc()){

        $datos = [];
        $datos['email'] = $row['emailJefe'];

        $email = $datos['email'];

    }
    $estado = "En Proceso";

   
   
 

   //$now = date('Y/m/d');

    //INSERTA EN BASE DE DATOS

    if(!empty($solicitudReferente) && !empty($departamentoPersonal) && !empty($idJefe && !empty($numeroCompra))){

        if($anexoSoliCompra['type'] == 'application/pdf'){

            //CREA CARPETA 
            $carpetaPDF = 'pdfs/';

            if(!is_dir($carpetaPDF)){
                mkdir($carpetaPDF);
            }

            //Generar un nombre único
            $nomArchivo = md5( uniqid(rand(), true) ) . ".pdf";

            //SUBIR PDF
            //$carpeta = "/pdfSoliReserva"; 
            move_uploaded_file($anexoSoliCompra['tmp_name'], $carpetaPDF . $nomArchivo);
            

            $query1 = "INSERT INTO solicitudes_reserva (numReserva, folioSoliCompra,  numeroCompra,idPersonal, idDepartamento, email, estadoSoliReserva, nomArchivo, observaciones)  VALUES ('". $reserva . "','". $solicitudReferente . "', '". $numeroCompra . "','". $idJefe . "','". $departamentoPersonal . "','". $email . "','". $estado . "','". $nomArchivo . "','". $observaciones . "')";
            $res1 = mysqli_query($conexion, $query1);
        }else{

            header('Location: ../sdo-bodega-pañol/reservar-soli-compra.php?solopdf=true');
        }

 

        $idSoliReserva = mysqli_insert_id($conexion);

    

        if ($idSoliReserva < 10) {
            $solicitudReferente = "000" . $idSoli;
        } else if ($idSoli > 9 && $idSoli < 100) {
            $solicitudReferente = "00" . $idSoliReserva;
        } else if ($idSoli > 99 && $idSoli < 1000) {
            $solicitudReferente = "0" . $idSoliReserva;
        } else if ($idSoli > 999) {
            $solicitudReferente = $idSoli;
        } else {
            $solicitudReferente = $idSoli;
        }

        $numeroRes = "NR-" . $solicitudReferente ;

        $queryUpdate = "UPDATE solicitudes_reserva SET numReserva = '${numeroRes}' WHERE idSoliReserva = ${idSoliReserva}";
        $res2 = mysqli_query($conexion, $queryUpdate);

        //Obtiene datos del jefe
        $queryJefe = "SELECT * FROM jefes_tecnicos WHERE idJefe = ${idJefe}";
        $res3 = mysqli_query($conexion, $queryJefe);

        while($row3 = $res3->fetch_assoc()){

            $datos3 = [];
            $datos3['nomJefe'] = $row3['nomJefe'];

            $nomJefe = $datos3['nomJefe'];

        }

        try{

            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'saladecontrolhbqp@gmail.com';
            $mail->Password = 'dcdxxsysxkjopsyv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');

            $mail->addAddress($email);

            $message  = "<html><body>";

                $message .= "<table height='100%' width='100%' cellpadding='0' cellspacing='0' border='0'>";
                
                $message .= "<tr><td>";
                
                $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
                
                $message .= "<thead>";
                
                $message .= "</thead>";
                
                $message .= "<tbody>";
                
                $message .= "<tr>";
                $message .= "<td><br><h2 align='center'> Estado de Solicitud Reserva Por Solicitud De Compra<br>&nbsp;<br><img src='https://cdnimg.bnamericas.com/QNBIixQugonFwhWLMWquGdAuLNTdViLJxwJUeVCETPAVucFxvIjNFgkxIIkUJUbK.png' alt='SSVQ' width='100' height='100'></h2><hr></td>";

                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px; ' align= 'center'>Estimado: ". $nomJefe ."</p>";
                $message .= "</td>";
                $message .= "</tr>";

                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px;' align='center'>Junto con saludar, se le notifica que se ingreso una solicitud de reserva de herramientas y/o materiales a su nombre.   </p>";
                $message .= "</td>";
                $message .= "</tr>";

                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px;' align='center'> N° Solicitud Reserva:  </p>";
                $message .= "<p style='font-weight:bold; font-size: 20px;' align='center' > " . $numeroRes .  " </p>";
                $message .= "</td>";
                $message .= "</tr>";

                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px;' align='center'>Saludos cordiales.<br><br></p>";
                $message .= "<p style='font-size:20px;' align='center'>Bodega Pañol - HBQP<br><br></p>";
                $message .= "<br><br></td>";
                $message .= "</tr>";

                $message .= "</tbody>";
                $message .= "</table>";
                $message .= "</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Estado Solicitud Reserva';
            $mail->Body = $message;

            $mail->send();

        }catch(Exception $e){
            echo $e->getMessage();
        }


        /*INSERTA LOS MATERIALES */

        if (isset($_POST['materialSC'], $_POST['cantidadSC'], $_POST['observacionSC'])) {

            $materialSC = $_POST['materialSC'];
            $cantidadSC = $_POST['cantidadSC'];
            $observacionSC = $_POST['observacionSC'];
            $medidaSC = $_POST['medida'];

            if (!empty($materialSC) && !empty($cantidadSC) && $cantidadSC > 0) {

                for ($i = 0; $i < count($materialSC); $i++) {
                    if (!empty($materialSC[$i])) {
                        $materialSCFor = $materialSC[$i];
                        $cantidadSCFor = $cantidadSC[$i];
                        $observacionSCFor = $observacionSC[$i];
                        $medidaFor = $medidaSC[$i];
                        

                        $queryMaterialSC = "INSERT INTO material_soli_reserva(codigoMaterialSC,cantMaterialSC,nomMaterialSC,nomMedida, idSoliReserva)
                        VALUES('" . $materialSCFor . "','" . $cantidadSCFor . "','" . $observacionSCFor . "','" . $medidaFor . "'," . $idSoliReserva . ")";

                        $resMaterialSC = mysqli_query($conexion, $queryMaterialSC);

                        if ($resMaterialSC) {
                            $usoMaterial = "Con";
                        } else {
                            $usoMaterial = "Sin";
                        }

                        // echo $queryMaterialSC;
                    } else {
                        $usoMaterial = "Sin";
                    }
                }
            } else {
                $usoMaterial = "Sin";
            }
        } else {
            $usoMaterial = "Sin";
        }
        

    
        if($res1){

            header('Location: ../sdo-bodega-pañol/reservar-soli-compra.php?SolicitudCorrecta=true');
        }


    }else{
        header('Location: ../sdo-bodega-pañol/reservar-soli-compra.php?novacios=true');
    }
    
}