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


if (isset($_POST['buscUser'])) {
    $buscUser = trim($_POST['buscUser']);
    if(empty($buscUser) || $buscUser == ''){ 
    header('Location: ../sdo-funciones/password-buscar.php?errorUser=true'); 
}else{
    $sqlAdmin = "SELECT passAdministrador, userAdministrador, idAdministrador FROM administracion WHERE userAdministrador = '".$buscUser."'";
    $resAdmin = mysqli_query($conexion, $sqlAdmin);
    $rowAdmin = $resAdmin->fetch_assoc();
    if ($rowAdmin){
        $_SESSION['passUsuario'] = $rowAdmin['passAdministrador'];
        $_SESSION['userUsuario'] = $rowAdmin['userAdministrador'];
        $_SESSION['idUsuario'] = $rowAdmin['idAdministrador'];
        $id = $_SESSION['idUsuario'];
        $rolUsuario1 = 'Administrador';
        $nombre = $_SESSION['userUsuario'];
        $password1 = $_SESSION['passUsuario'];
        $email = '';

    } else{
        $sqlPersonal = "SELECT passPersonal, userPersonal, emailPersonal, idPersonal FROM personal WHERE userPersonal = '".$buscUser."'";
        $resPersonal= mysqli_query($conexion, $sqlPersonal);
        $rowPersonal = $resPersonal->fetch_assoc();
        if($rowPersonal) {
           // $activoPersonal = $rowPersonal['activoPersonal'];
         //   if ($activoPersonal == 1) {
            
            $_SESSION['passUsuario'] = $rowPersonal['passPersonal'];
            $_SESSION['userUsuario'] = $rowPersonal['userPersonal'];
            $_SESSION['emailUsuario'] = $rowPersonal['emailPersonal'];  
            $_SESSION['idPersonal'] = $rowPersonal['idPersonal'];
            //$_SESSION['rolUsuario'] = '"Personal"';
            $rolUsuario1 = 'Personal';
            $nombre = $_SESSION['userUsuario'];
            $password1 = $_SESSION['passUsuario'];
            $email = $_SESSION['emailUsuario'];
            $id = $_SESSION['idPersonal'];

           // } else{
               // echo '<script language="javascript"> Swal.fire("Personal no se encuentra activado","You clicked the button!");</script>';
            
               //echo '<script language="javascript"> Swal.fire("Esta es una alerta");</script>';
               // echo '<div class="alert alert-warning alert-dismissible">
                // <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                // <h5><i class="fa fa-exclamation-triangle"></i>&nbsp;Personal no se encuentra activado</h5></div>';  
                //echo '<script language="javascript">alert("Personal no se encuentra activado");</script>';     
             //   header('Location: ../sdo-flujo/mandar-errores-1.php?activacionFalla=true');
               //return;
           // }
        } else{
            $sqlDirectiva = "SELECT passDirectivo, userDirectivo, idDirectivo FROM directivos WHERE userDirectivo = '".$buscUser."'";
            $resDirectiva = mysqli_query($conexion, $sqlDirectiva);
            $rowDirectiva = $resDirectiva->fetch_assoc();
            if ($rowDirectiva) {
            $_SESSION['passUsuario'] = $rowDirectiva['passDirectivo'];
            $_SESSION['userUsuario'] = $rowDirectiva['userDirectivo']; 
            $_SESSION['idUsuario'] = $rowDirectiva['idDirectivo']; 
            $id = $_SESSION['idUsuario'];
            $rolUsuario1 = 'Directivo';
            $nombre = $_SESSION['userUsuario'];
            $password1= $_SESSION['passUsuario'];
            $email = '';
            } else{
                $sqlJefeTecnico = "SELECT passJefe, userJefe, emailJefe,idJefe FROM jefes_tecnicos WHERE userJefe = '".$buscUser."'";
                $resJefeTecnico = mysqli_query($conexion, $sqlJefeTecnico);
                $rowJefeTecnico = $resJefeTecnico->fetch_assoc();
                if($rowJefeTecnico){
                    $_SESSION['passUsuario'] = $rowJefeTecnico['passJefe'];
                    $_SESSION['userUsuario'] = $rowJefeTecnico['userJefe']; 
                    $_SESSION['emailUsuario'] = $rowJefeTecnico['emailJefe']; 
                    $_SESSION['idUsuario'] = $rowJefeTecnico['idJefe'];  
                   // $_SESSION['rolUsuario'] = 'Jefe Tecnico';
                    $rolUsuario1 = '"Jefe Tecnico"';
                    $nombre = $_SESSION['userUsuario'];
                    $password1 = $_SESSION['passUsuario'];
                    $email = $_SESSION['emailUsuario'];    
                    $id = $_SESSION['idUsuario'];
                } else{
                    $sqlAdmTec = "SELECT idAdmTecnicos,passAdmTecnicos, userAdmTecnicos, emailAdmTecnicos FROM adm_tecnicos WHERE userAdmTecnicos = '".$buscUser."'";
                    $resAdmTec = mysqli_query($conexion, $sqlAdmTec);
                    $rowAdmTec = $resAdmTec->fetch_assoc();
                    if($rowAdmTec){
                        $_SESSION['passUsuario'] = $rowAdmTec['passAdmTecnicos'];
                        $_SESSION['userUsuario'] = $rowAdmTec['userAdmTecnicos']; 
                        $_SESSION['emailUsuario'] = $rowAdmTec['emailAdmTecnicos'];  
                        $_SESSION['idUsuario'] = $rowAdmTec['idAdmTecnicos'];
                        $rolUsuario1 = '"Administrador Tecnico"';
                        $nombre = $_SESSION['userUsuario'];
                        $password1 = $_SESSION['passUsuario'];
                        $email = $_SESSION['emailUsuario'];
                        $id = $_SESSION['idUsuario'];
                    } else{
                        $sqlMesaAyuda = "SELECT passMesaAyuda, userMesaAyuda,emailMesaAyuda,idMesaAyuda FROM mesa_ayuda WHERE userMesaAyuda = '" .$buscUser."'";
                        $resMesaAyuda = mysqli_query($conexion, $sqlMesaAyuda);
                        $rowMesaAyuda = $resMesaAyuda->fetch_assoc();
                        if($rowMesaAyuda){
                            $_SESSION['passUsuario'] = $rowMesaAyuda['passMesaAyuda'];
                            $_SESSION['userUsuario'] = $rowMesaAyuda['userMesaAyuda'];  
                            $_SESSION['emailUsuario'] = $rowMesaAyuda['emailMesaAyuda']; 
                            $_SESSION['idUsuario'] = $rowMesaAyuda['idMesaAyuda'];
                            $rolUsuario1 = '"Mesa Ayuda"';
                            $nombre = $_SESSION['userUsuario'];
                            $password1 = $_SESSION['passUsuario'];
                            $email = $_SESSION['emailUsuario'];
                            $id = $_SESSION['idUsuario'];
                        } else{
                        header('Location:../sdo-flujo/mandar-errores-1.php?UsuarioNoExiste=true');
                            //echo '<script language="javascript">;</script>';
                            return;
                        } // else de Mesa de Ayuda
                    } // else de rowAdmTec
                } // else de  rowJefeTecnico
            } // else de row Directiva
        } // else del row Personal
    } // else del row Admin
} // else del if general
}// if general

?>
<?php
$mail = new PHPMailer(true);
if (isset($nombre, $password1, $email)) {

    if(empty($nombre) || $nombre == '' || empty($password1) || $password1 == ''){ 
        //header('Location: ../sdo-flujo/receptor_de_errores.php?errorMandar=true');
    // echo 'ERROR: Lo mas seguro es que trato de enviar un correo donde no existe un correo';
    // echo '<script language="javascript">alert("ERROR: Lo mas seguro es que trato de enviar un correo donde no existe un correo");</script>';
    header('Location: ../sdo-flujo/mandar-errores-1.php?Error=true');      
    }
    
    if(empty($email) || $email == ''){
    //header('Location: ../sdo-funciones/actualizar-correo.php');
    $ver = "Este usuario no posee un correo ingresado. Si lo desea puede colocar un nuevo correo";    
    $ver1 = "da";
    } else{
        $ver = "Se envio el correo correctamente";
        $ver1 = 2;
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
        if($email == ''){
            header('Location: ../sdo-flujo/mandar-errores-1.php?errorEnviarMail=true');
            return;
        }
        $mail->addAddress($email);
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
           // header('Location: ../sdo-flujo/mandar-errores-1.php?MensajeEnviadoCorrectamente=true');
        } else {
            header('Location: ../sdo-flujo/mandar-errores-1.php?errorEnviarMail=true');
        }
        



    }catch (Exception $e) {
    echo $e->getMessage();
    }}

    
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
    ?>
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
                        <a href="#" class="h3"><b>Vista del Usuario</b></a>
                        <br>
                        <br>
                        <input type=image src="../dist/img/ssvq1.png">
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <form action="../sdo-funciones/actualizar-correo.php" method="POST">
                 <!--   <form action="../sdo-flujo/enviar-correo-1.php" method="POST"> -->
                        <div class="input-group mb-3">
                            <table>
                                <tr> 
                                    <td> 
                                        <h4><input type="hidden"  id="rolusuario1" required name="rolusuario1" class="form-control" value=<?php echo $rolUsuario1?>></b></h4>
                                    </td>
                                    <td> 
                                        <h4><input type="hidden"  id="id1" required name="id1" class="form-control" value=<?php echo $id?>></b></h4>
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
                                        <h4><b><?php echo $ver ?></b> <input type="hidden" id="email" required name="email" class="form-control" value=<?php echo $email ?>></h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <div class="social-auth-links text-center mt-2 mb-3">
                                <?php
                                if ($ver1 == 'da'  ){
                               // echo  "<input class='custom-control-input' type='checkbox' id='checkboxCorreo' name='checkboxCorreo' value='option1'>";
                              //  echo " <label for='checkboxParking' class='custom-control-label'>Necesita Cambiar el Correo</label>";
                                echo "<input type=text id=actualizar required name='actualizar' class='form-control' placeholder='Colocar Correo Nuevo'>";    
                                echo "<br>";
                                echo "<button type='submit' class='btn btn-primary btn-block'>Ingresar Correo</button>";     
                                }
                                ?>
                              <!--   <button type="submit" class="btn btn-primary btn-block"></button> -->
                                <a href="../sdo-administrador/buscar-password.php" class="btn btn-block btn-warning">
                                    Volver
                                </a>
                            </div>
                        </form>
                  <!--  </form> while ($seleccionado =@pg_fetch_array($resultado)):
       $nroapto = $seleccionado['nroapto'];
       $cedula = $seleccionado['cedula'];
       $monto = $seleccionado['deuda'];
echo"         <tr>
                  <td><input type='text' value='$nroapto' name='nroapto' readonly='true'></td>
                  <td width='50'><input type='text' value='$cedula' name='cedula' readonly='true'></td>
                  <td width='50'><input type='text' value='$monto' size='8' readonly='true' name='deuda'></td>
			  </tr>";
endwhile;
                  echo"</table><br>";
 
  if ($monto = 0){
echo"<input type='submit' class='color1' readonly='true' name='action' value='Procesar pago' align='right' onClick='return myFunction()'>";
   }
   else{
echo"<input type='submit' class='color1' name='action' value='Procesar pago' align='right' onClick='return myFunction()'>";
 
   } -->
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




