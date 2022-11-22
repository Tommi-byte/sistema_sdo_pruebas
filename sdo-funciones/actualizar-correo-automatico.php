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

if (isset($_POST['id1'],$_POST['nombre'], $_POST['password1'], $_POST['actualizar'], $_POST['rolusuario1'])) {
$id1 = trim($_POST['id1']);
$nombre = trim($_POST['nombre']);
$password1 = trim($_POST['password1']);
$actualizaremail = trim($_POST['actualizar']);
$rolusuario1 = trim($_POST['rolusuario1']);
 if(empty($id1) || $id1 == '' || empty($nombre) || $nombre == '' || empty($password1) || $password1 == '' || empty($actualizaremail) || $actualizaremail == '' || empty($rolusuario1) || $rolusuario1 == '')
 {
    header('Location: ../sdo-funciones/mandar-errores-1.php?ErrorActualizarEmail=true'); 

 } else{
      if($rolusuario1 == 'Personal'){
        $sqlactualizarPersonal = "UPDATE personal SET emailPersonal = '".$actualizaremail."' WHERE idPersonal = ". $id1;
        $resModificarPersonal = mysqli_query($conexion, $sqlactualizarPersonal);
        echo "Correo Personal Actualizado";
      } else{
        if($rolusuario1 == 'Jefe Tecnico'){
            $sqlactualizarJefeTecnico = "UPDATE jefes_tecnicos SET emailJefe = '".$actualizaremail."' WHERE idJefe = ". $id1;
            $resModificarJefesTecnico = mysqli_query($conexion, $sqlactualizarJefeTecnico);
            //header('Location: ../sdo-flujo/mandar-errores-1.php?CorreoActualizado=true');
            //  $rowJefesTecnicos = $resJefesTecnicos->fetch_assoc();
            echo "Correo de Jefe Tecnico Actualizado";
              ?>
             <!-- <script>
               Swal.fire(
                '!Conseguido!',
                'EL correo fue actualizado correctamente',
                'success' 
            )   
             </script> --> 
              <?php
             //echo '<script language="javascript"> Swal.fire("Personal no se encuentra activado","You clicked the button!");</script>';
            //echo '<script language="javascript">alert(""El Correo del Jefe/a Tecnico/a Fue Actualizado.");</script>';
        } else {
            if($rolusuario1 == 'Administrador Tecnico'){
                $sqlactualizarAdministradorTecnico = "UPDATE adm_tecnicos SET emailAdmTecnicos = '".$actualizaremail."' WHERE idAdmTecnicos = ". $id1;
                $resModificarAdministradorTecnico = mysqli_query($conexion, $sqlactualizarAdministradorTecnico);
                echo "Correo de Administrador Tecnico Actualizado"; 
            } else {
                if( $rolusuario1 == 'Mesa Ayuda'){
                    $sqlactualizarMesaAyuda = "UPDATE mesa_ayuda SET emailMesaAyuda = '".$actualizaremail."' WHERE idMesaAyuda = ". $id1;
                    $resModificarMesaAyuda = mysqli_query($conexion, $sqlactualizarMesaAyuda);
                    echo "Correo de Mesa Ayuda Actualizado";
                } else {
                    if($rolusuario1 == 'Administrador'){
                        $sqlactualizarAdministrador = "UPDATE administracion SET emailAdministrador = '".$actualizaremail."' WHERE idAdministrador = ". $id1;
                        $resModificarAdministrador = mysqli_query($conexion, $sqlactualizarAdministrador);
                        echo "Correo de Administrador Actualizado";
                    } else{
                        if($rolusuario1 == 'Directivo'){
                            $sqlactualizarDirectivo = "UPDATE directivos SET emailDirectivo = '".$actualizaremail."' WHERE idDirectivo = ". $id1;
                            $resModificarDirectivo = mysqli_query($conexion, $sqlactualizarDirectivo);
                            echo "Correo de Directivo Actualizado";
                        } else{ 
                            header('Location: ../sdo-flujo/mandar-errores-1.php?ErrorCambiarEmail=true');
                            
                        } // else del if del Directivo
                    }// else del if Adminitrador
                }// else de if Mesa Ayuda 
            } // else del if Administrador Tecnico
        } // else del if Jefe Tecnico
      } // else del if personal
    }// else del if general
  //  header('Location: ../sdo-flujo/mandar-errores-1.php?ErrorCambiarEmail=true');  
}// if general 

?>
<?php

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset ($nombre , $password1,$actualizaremail)) {
   // $nombre = $_POST['nombre'];
   // $password1 = $_POST['password1'];
   // $actualizaremail = $_POST['actualizaremail'];
    if(empty($nombre) || $nombre == '' || empty($password1) || $password1 == '' || empty($actualizaremail) || $actualizaremail == ''){ 
        //header('Location: ../sdo-flujo/receptor_de_errores.php?errorMandar=true');
       // echo 'ERROR: Lo mas seguro es que trato de enviar un correo donde no existe un correo';
       // echo '<script language="javascript">alert("ERROR: Lo mas seguro es que trato de enviar un correo donde no existe un correo");</script>';
    header('Location: ../sdo-flujo/mandar-errores-1.php?CorreoNoExiste=true');
            
    } else {
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
        //$mail->addReplyTo('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');

        //Set who the message is to be sent to
        $mail->addAddress($actualizaremail);
        //$mail->addCC('yorgocasimis@hotmail.cl', 'Yorgo Casimis');
        //$mail->addCC('saladecontrolhbqp@gmail.com', 'Sala de Control Centralizado - HBQP');
        //$mail->addCC('tecnicos.cc.hbqp@redsalud.gob.cl', 'Técnicos de Control Centralizado');
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
        $message .= "<td><br><h2 align='center'>Entrega de Contraseña<br>&nbsp;<br><img src='https://cdnimg.bnamericas.com/QNBIixQugonFwhWLMWquGdAuLNTdViLJxwJUeVCETPAVucFxvIjNFgkxIIkUJUbK.png' alt='SSVQ' width='100' height='100'></h2><hr></td>";
        
        

        $message .= "<tr>";
        $message .= "<td colspan='4' style='padding:15px;'>";
        $message .= "<p style='font-size:20px; ' align= 'center'>Estimado(a): ".$nombre." </p>";
        $message .= "</td>";
        $message .= "</tr>";

        $message .= "<tr>";
        $message .= "<td colspan='4' style='padding:15px;'>";
        $message .= "<p style='font-size:20px;' align='center'>Junto con saludar, Quiero notificarle que esta es su contraseña solicitada: ".$password1."</p>";
        $message .= "</td>";
        $message .= "</tr>";

        $message .= "<tr>";
        $message .= "<td colspan='4' style='padding:15px;'>";
        $message .= "<p style='font-size:20px;' align='center'>Saludos cordiales. Sala de Control Centralizado - HBQP<br><br></p>";
        $message .= "<br><br></td>";
        $message .= "</tr>";

        $message .= "</tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Entrega de Contraseñas';
        $mail->Body    = $message;
        //$mail->AltBody = $altMessage;

        if ($mail->send()) {
          //  header('Location: ../sdo-flujo/mandar-errores-1.php?MensajeEnviadoCorrectamente=true');
        } else {
            header('Location: ../sdo-flujo/mandar-errores-1.php?errorEnviarMail=true');
        }
        



    }catch (Exception $e) {
    echo $e->getMessage();
    }
}
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver Contraseña</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/modelo.css">

    <script src="../dist/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../dist/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/sweetalert2/dist/sweetalert2.min.css">
    <link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<!--<?php
   // if (isset($_GET['activacionFalla'])) {
    ?>  echo '<script>
    Swal.fire({
     icon: "success",
     title: "Conseguido",
     text: "¡Correo de Jefe Tecnicos Actualizado!",
     showConfirmButton: true,
     confirmButtonText: "Cerrar"
     }).then(function(result){
        if(result.value){                   
         window.location = "../xUsuarios.php";
        }
     });
    </script>'; 
        <script>
            Swal.fire(
                '! Ha ocurrido un problema !',
                'Personal no esta activado. Reintente.',
                'error'
            )
        </script>
    <?php
   // }


?>-->
<body class="hold-transition sidebar-mini" style="background-color:aliceblue";>
<div class="wrapper">
<?php
        include '../sdo-templates/admin-sidebar.php';
        ?>
<!--   <video id="videofondo" class="video-background" loading="lazy" poster="https://carontestudio.com/img/contacto.jpg" autoplay="autoplay" no-controls="" muted="muted" loop=""><source src="https://carontestudio.com/img/f4.mp4" type="video/mp4" ;="" codecs="avc1.42E01E, mp4a.40.2"></video> -->
<div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow border">
                    <div class="card-header text-center">
                        <a href="#" class="h3"><b>Correo Actualizado</b></a>
                        <br>
                        <br>
                        <input type=image src="../dist/img/ssvq1.png">
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                  <!--  <form action="../sdo-flujo/enviar-correo-1.php" method="POST"> -->
                        <div class="input-group mb-3">
                            <table>
                         <tr> 
                                    <td> 
                                        <h4><input type="hidden"  id="id2" required name="nombre" class="form-control" value=<?php echo $id1?>></b></h4>
                                    </td>
                                </tr>
                                <tr> 
                                    <td> 
                                        <h4><b>El Usuario es: <input type="text" id="nombre" required name="nombre" class="form-control" value=<?php echo $nombre?> readonly></b></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><b></b> <input type="hidden" id="password1" required name="password1" class="form-control" value=<?php echo $password1?> readonly></b></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><b>Su correo fue actualizado y se envio exitosamente</b> <input size= 40 style="" type="hidden" id="actualizaremail" required name="actualizaremail" class="form-control" readonly value=<?php echo $actualizaremail ?> </b></h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <div class="social-auth-links text-center mt-2 mb-3">
                            <!--    <button type="submit" class="btn btn-primary btn-block">Enviar Correo</button> -->
                                <a href="../sdo-administrador/buscar-password.php" class="btn btn-block btn-warning">
                                    Volver
                                </a>
                            </div>
                <!--   </form>  -->
                </div>
            </div>
        </div>

    </div>
    </div>
    <footer class="main-footer">
            <strong>Copyright &copy; 2022.</strong> Derechos Reservados.
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</div>
</body>
