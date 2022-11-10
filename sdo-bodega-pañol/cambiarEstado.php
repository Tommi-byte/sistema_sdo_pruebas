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

  

    $idSoliReserva = $_POST['idReservado'];

    $nuevoEstado = $_POST['nuevoEstado'];

    $idDepartamento = $_POST['idDepartamento'];

    $folioSoliCompra = $_POST['folioSoliCompra'];

    $fechaSoliReserva = $_POST['fechaSoliReserva'];

    $numSolicitud = $_POST['numSolicitud'];

    $numCompra = $_POST['numCompra'];

    $pdf = $_POST['pdf'];

    $observaciones = $_POST['observaciones'];

    // var_dump($idSoliReserva);
    // var_dump($nuevoEstado);

    // exit;
  
    $email = $_POST['correo'];

    if(!empty($nuevoEstado)){


   

   

    $queryUpdate = "UPDATE solicitudes_reserva SET estadoSoliReserva = '${nuevoEstado}' WHERE idSoliReserva = ${idSoliReserva} ";
    $res = mysqli_query($conexion, $queryUpdate);

    //SELECT TABLA SOLICITUDES RESERVA
    $querySelect = "SELECT * FROM solicitudes_reserva WHERE idSoliReserva = ${idSoliReserva}";
 
    $res1 = mysqli_query($conexion, $querySelect);

    while($row = $res1->fetch_assoc()){

        $datos = [];
        $datos['numReserva'] = $row['numReserva'];
        $datos['idPersonal'] = $row['idPersonal'];

        $numeroRes = $datos['numReserva'];
        $idJefe = $datos['idPersonal'];


    }

    //SELECT TABLA JEFE TECNICOS
    $queryJefe = "SELECT * FROM jefes_tecnicos WHERE idJefe = ${idJefe}";
    // var_dump($queryJefe);
    // exit;
    $res2 = mysqli_query($conexion, $queryJefe);

    while($row1 = $res2->fetch_assoc()){

        $datos1 = [];
        
    
        $datos1['nomJefe'] = $row1['nomJefe'];

        $nomJefe = $datos1['nomJefe'];


    }

    //SELECT TABLA JEFE TECNICOS
    $queryJefe = "SELECT * FROM jefes_tecnicos WHERE idJefe = ${idJefe}";
    // var_dump($queryJefe);
    // exit;
    $res2 = mysqli_query($conexion, $queryJefe);

    while($row1 = $res2->fetch_assoc()){

        $datos1 = [];
        
    
        $datos1['nomJefe'] = $row1['nomJefe'];

        $nomJefe = $datos1['nomJefe'];


    }

      //SELECT TABLA DEPARTAMENTOS
      $queryDepartamento = "SELECT * FROM departamentos WHERE idDepartamento = ${idDepartamento}";
      // var_dump($queryJefe);
      // exit;
      $res3 = mysqli_query($conexion, $queryDepartamento);
  
      while($row12 = $res3->fetch_assoc()){
  
          $datos1 = [];
          
      
          $datos1['nomDepartamento'] = $row12['nomDepartamento'];
  
          $nomDepartamento = $datos1['nomDepartamento'];
  
  
      }

 
    //Actualiza la columna estadoSoliReserva de la tabla en Reserva


    if($nuevoEstado == 'En Pañol'){

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
                $message .= "<td><br><h2 align='center'> Estado de Solicitud Reserva Material<br>&nbsp;<br><img src='https://cdnimg.bnamericas.com/QNBIixQugonFwhWLMWquGdAuLNTdViLJxwJUeVCETPAVucFxvIjNFgkxIIkUJUbK.png' alt='SSVQ' width='100' height='100'></h2><hr></td>";
    
                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px; ' align= 'center'>Estimado: ". $nomJefe ."</p>";
                $message .= "</td>";
                $message .= "</tr>";
    
                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px;' align='center'>Junto con saludar, se le notifica el avance de estado de su solicitud: <span style='background-color: yellow;'>". $numeroRes . "</span> </p>";
                $message .= "<p style='font-size:20px; font-weight:bold' align='center'>Nuevo Estado: ". $nuevoEstado ."   </p>";
                $message .= "</td>";
                $message .= "</tr>";
    
                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px;' align='center'> Este nuevo estado quiere decir que las herramientas y/o materiales solicitados ya se encuentran en la bodega para su retiro, le recordamos  el horario de atención:  </p>";
                $message .= "<p style='font-size:20px;font-weight:bold;background-color: yellow' align='center'>Lunes a Viernes 08:00 a 17:00 hrs.<br></p>";
                $message .= "</td>";
                $message .= "</tr>";
    
                $message .= "<tr>";
                $message .= "<td colspan='4' style='padding:15px;'>";
                $message .= "<p style='font-size:20px;' align='center'>Saludos cordiales.<br></p>";
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

       
    }


    // if($nuevoEstado == 'Preparado'){

    //     try{

    //         $mail->SMTPDebug = SMTP::DEBUG_OFF;
    //         $mail->isSMTP();
    //         $mail->Host = 'smtp.gmail.com';
    //         $mail->SMTPAuth = true;
    //         $mail->Username = 'saladecontrolhbqp@gmail.com';
    //         $mail->Password = 'dcdxxsysxkjopsyv';
    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    //         $mail->Port = 465;
    
    //         $mail->setFrom('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');
    
    //         $mail->addAddress($email);
    
    //         $message  = "<html><body>";
    
    //             $message .= "<table height='100%' width='100%' cellpadding='0' cellspacing='0' border='0'>";
                
    //             $message .= "<tr><td>";
                
    //             $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
                
    //             $message .= "<thead>";
                
    //             $message .= "</thead>";
                
    //             $message .= "<tbody>";
                
    //             $message .= "<tr>";
    //             $message .= "<td><br><h2 align='center'> Estado de Solicitud Reserva Material<br>&nbsp;<br><img src='https://cdnimg.bnamericas.com/QNBIixQugonFwhWLMWquGdAuLNTdViLJxwJUeVCETPAVucFxvIjNFgkxIIkUJUbK.png' alt='SSVQ' width='100' height='100'></h2><hr></td>";
    
    //             $message .= "<tr>";
    //             $message .= "<td colspan='4' style='padding:15px;'>";
    //             $message .= "<p style='font-size:20px; ' align= 'center'>Estimado: ". $nomJefe ."</p>";
    //             $message .= "</td>";
    //             $message .= "</tr>";
    
    //             $message .= "<tr>";
    //             $message .= "<td colspan='4' style='padding:15px;'>";
    //             $message .= "<p style='font-size:20px;' align='center'>Junto con saludar, se le notifica el avance de estado de su solicitud: <span style='background-color: yellow'>". $numeroRes . " </span></p>";
    //             $message .= "<p style='font-size:20px; font-weight:bold' align='center'>Nuevo Estado: ". $nuevoEstado ."   </p>";
    //             $message .= "</td>";
    //             $message .= "</tr>";
    
    //             $message .= "<tr>";
    //             $message .= "<td colspan='4' style='padding:15px;'>";
    //             $message .= "<p style='font-size:20px;' align='center'> Este nuevo estado quiere decir que los materiales solicitados ya se encuentran preparados para su retiro, le recordamos el horario de funcionamiento de pañol: </p>";
    //             $message .= "<p style='font-size:20px;font-weight:bold;background-color: yellow' align='center'> Lunes a Viernes 08:00 a 20:00 horas. </p>";
    //             $message .= "</td>";
    //             $message .= "</tr>";
    
    //             $message .= "<tr>";
    //             $message .= "<td colspan='4' style='padding:15px;'>";
    //             $message .= "<p style='font-size:20px;' align='center'>Saludos cordiales.<br></p>";
    //             $message .= "<p style='font-size:20px;' align='center'>Bodega Pañol - HBQP<br><br></p>";
    //             $message .= "<br><br></td>";
    //             $message .= "</tr>";
    
    //             $message .= "</tbody>";
    //             $message .= "</table>";
    //             $message .= "</td></tr>";
    //             $message .= "</table>";
    //             $message .= "</body></html>";
    
    //         $mail->isHTML(true);
    //         $mail->CharSet = 'UTF-8';
    //         $mail->Subject = 'Estado Solicitud Reserva';
    //         $mail->Body = $message;
    
    //         $mail->send();
    
    //     }catch(Exception $e){
    //         echo $e->getMessage();
    //     }
    // }

    if($nuevoEstado == 'Entregado'){


        //INSERTA EN TABLA HISTORIAL
        $insertHistorial = "INSERT INTO solicitudes_reserva_finalizadas (numReserva, folioSoliCompra, numeroCompra,fechaSoliReserva ,idPersonal, idDepartamento, email, estadoSoliReserva, nomArchivo, idSoliReserva2)  VALUES ('". 
        $numSolicitud . "','". $folioSoliCompra . "', '". $numCompra . "','". $fechaSoliReserva . "','". $idJefe . "','". $idDepartamento . "','". $email . "','". $nuevoEstado . "','". $pdf . "','". $idSoliReserva . "')";       
        $res1 = mysqli_query($conexion, $insertHistorial);

        //BORRA DATOS TABLA ORIGEN
        $delete = "DELETE FROM solicitudes_reserva WHERE idSoliReserva = $idSoliReserva";
        $res2 = mysqli_query($conexion, $delete);

        
       

        // try{

        //     $mail->SMTPDebug = SMTP::DEBUG_OFF;
        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.gmail.com';
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'saladecontrolhbqp@gmail.com';
        //     $mail->Password = 'dcdxxsysxkjopsyv';
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //     $mail->Port = 465;
    
        //     $mail->setFrom('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');
    
        //     $mail->addAddress($email);
    
        //     $message  = "<html><body>";
    
        //         $message .= "<table height='100%' width='100%' cellpadding='0' cellspacing='0' border='0'>";
                
        //         $message .= "<tr><td>";
                
        //         $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
                
        //         $message .= "<thead>";
                
        //         $message .= "</thead>";
                
        //         $message .= "<tbody>";
                
        //         $message .= "<tr>";
        //         $message .= "<td><br><h2 align='center'> Estado de Solicitud Reserva Material<br>&nbsp;<br><img src='https://cdnimg.bnamericas.com/QNBIixQugonFwhWLMWquGdAuLNTdViLJxwJUeVCETPAVucFxvIjNFgkxIIkUJUbK.png' alt='SSVQ' width='100' height='100'></h2><hr></td>";
    
        //         $message .= "<tr>";
        //         $message .= "<td colspan='4' style='padding:15px;'>";
        //         $message .= "<p style='font-size:20px; ' align= 'center'>Estimado: ". $nomJefe ."</p>";
        //         $message .= "</td>";
        //         $message .= "</tr>";
    
        //         $message .= "<tr>";
        //         $message .= "<td colspan='4' style='padding:15px;'>";
        //         $message .= "<p style='font-size:20px;' align='center'>Junto con saludar, se le notifica el avance de estado de su solicitud: <span style='background-color: yellow'>". $numeroRes . " </span></p>";
        //         $message .= "<p style='font-size:20px; font-weight:bold' align='center'>Nuevo Estado: ". $nuevoEstado ."   </p>";
        //         $message .= "</td>";
        //         $message .= "</tr>";
    
        //         $message .= "<tr>";
        //         $message .= "<td colspan='4' style='padding:15px;'>";
        //         $message .= "<p style='font-size:20px;' align='center'> Materiales solicitados entregados, se procede a cerrar el ticket de reserva</p>";
        //         $message .= "</td>";
        //         $message .= "</tr>";
    
        //         $message .= "<tr>";
        //         $message .= "<td colspan='4' style='padding:15px;'>";
        //         $message .= "<p style='font-size:20px;' align='center'>Saludos cordiales.<br></p>";
        //         $message .= "<p style='font-size:20px;' align='center'>Bodega Pañol - HBQP<br><br></p>";
        //         $message .= "<br><br></td>";
        //         $message .= "</tr>";
    
        //         $message .= "</tbody>";
        //         $message .= "</table>";
        //         $message .= "</td></tr>";
        //         $message .= "</table>";
        //         $message .= "</body></html>";
    
        //     $mail->isHTML(true);
        //     $mail->CharSet = 'UTF-8';
        //     $mail->Subject = 'Estado Solicitud Reserva';
        //     $mail->Body = $message;
    
        //     $mail->send();

        //     header('Location: ../sdo-bodega-pañol/reservar-herramientas.php?finalizado=true;');
    
        // }catch(Exception $e){
        //     echo $e->getMessage();
        // }

        
        
    }   

    if($nuevoEstado == 'Anulado'){

        $insertAnulados = "INSERT INTO solicitudes_reservas_anuladas (numReserva, folioSoliCompra, numeroCompra,fechaSoliReserva ,idPersonal, idDepartamento, email, estadoSoliReserva, nomArchivo, observaciones)  VALUES ('". 
        $numSolicitud . "','". $folioSoliCompra . "', '". $numCompra . "','". $fechaSoliReserva . "','". $idJefe . "','". $idDepartamento . "','". $email . "','". $nuevoEstado . "','". $pdf . "','". $observaciones . "')";       
        $resAnualdos = mysqli_query($conexion, $insertAnulados);


        $deleteAnulados = "DELETE FROM solicitudes_reserva WHERE idSoliReserva = ${idSoliReserva}";
        $resDelete = mysqli_query($conexion, $deleteAnulados);      
    }

    if($nuevoEstado == 'Anulado'){

        header('Location: ../sdo-bodega-pañol/reservar-soli-compra.php?anulado=true;');
        
    }else{

        header('Location: ../sdo-bodega-pañol/reservar-soli-compra.php?cambio=true;');
    }

    }else{
        header('Location: ../sdo-bodega-pañol/reservar-soli-compra.php?vacio=true;');
    }
    


    

}