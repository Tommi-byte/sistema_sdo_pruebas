<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';



if (isset($_POST['buscUser'])) {
    $buscUser = trim($_POST['buscUser']);
    if(empty($buscUser) || $buscUser == ''){ 
        header('Location: ../sdo-funciones/password-buscar.php?errorUser=true'); 

}else{
    $sqlAdmin = "SELECT passAdministrador, userAdministrador FROM administracion WHERE userAdministrador = '".$buscUser."'";
    $resAdmin = mysqli_query($conexion, $sqlAdmin);
    $rowAdmin = $resAdmin->fetch_assoc();
    if ($rowAdmin) {
    $_SESSION['passUsuario'] = $rowAdmin['passAdministrador'];
    $_SESSION['userUsuario'] = $rowAdmin['userAdministrador'];
    //$_SESSION['idUsuario'] = $rowAdmin['idAdministrador'];
    //if($id == 3){
        $nombre = $_SESSION['userUsuario'];
        $password1 = $_SESSION['passUsuario'];
        $email = '"No Existe Correo"';
    //}
    //$id = $_SESSION['idUsuario'];
    $nombre = $_SESSION['userUsuario'];
    $password1 = $_SESSION['passUsuario'];
    $email = '"No Existe Correo"';
    //header('Location: ../sdo-administrador/datos-password.php?userExito=true');
    } else{
        $sqlDirectiva = "SELECT passDirectivo, userDirectivo FROM directivos WHERE userDirectivo = '".$buscUser."'";
        $resDirectiva = mysqli_query($conexion, $sqlDirectiva);
        $rowDirectiva = $resDirectiva->fetch_assoc();
        if ($rowDirectiva) {
            $_SESSION['passUsuario'] = $rowDirectiva['passDirectivo'];
            $_SESSION['userUsuario'] = $rowDirectiva['userDirectivo']; 
            $nombre = $_SESSION['userUsuario'];
            $password1= $_SESSION['passUsuario'];
            $email = '"No Existe Correo"';
        
        } else{
        $sqlPersonal = "SELECT passPersonal, userPersonal, emailPersonal, activoPersonal FROM personal WHERE userPersonal = '".$buscUser."'";
        $resPersonal= mysqli_query($conexion, $sqlPersonal);
        $rowPersonal = $resPersonal->fetch_assoc();
        if($rowPersonal) {

            $activoPersonal = $rowPersonal['activoPersonal'];
            if ($activoPersonal == 1) {
            $_SESSION['passUsuario'] = $rowPersonal['passPersonal'];
            $_SESSION['userUsuario'] = $rowPersonal['userPersonal'];
            $_SESSION['emailUsuario'] = $rowPersonal['emailPersonal'];  
            $nombre = $_SESSION['userUsuario'];
            $password1 = $_SESSION['passUsuario'];
            $email = $_SESSION['emailUsuario'];
            } 
        } else{ 
        $sqlJefeTecnico = "SELECT passJefe, userJefe, emailJefe FROM jefes_tecnicos WHERE userJefe = '".$buscUser."'";
        $resJefeTecnico = mysqli_query($conexion, $sqlJefeTecnico);
        $rowJefeTecnico = $resJefeTecnico->fetch_assoc();
        if($rowJefeTecnico){
            //$idDepartamento = $rowJefeTecnico['idDepartamento'];
            //if ($idDepartamento == 1){
                $_SESSION['passUsuario'] = $rowJefeTecnico['passJefe'];
                $_SESSION['userUsuario'] = $rowJefeTecnico['userJefe']; 
                $_SESSION['emailUsuario'] = $rowJefeTecnico['emailJefe'];   
                $nombre = $_SESSION['userUsuario'];
                $password1 = $_SESSION['passUsuario'];
                $email = $_SESSION['emailUsuario'];    
           // } else{
            
            
           // }
        
        }else {
            $sqlAdmTec = "SELECT passAdmTecnicos, userAdmTecnicos, emailAdmTecnicos  FROM adm_tecnicos WHERE userAdmTecnicos = '".$buscUser."'";
            $resAdmTec = mysqli_query($conexion, $sqlAdmTec);
            $rowAdmTec = $resAdmTec->fetch_assoc();
            if($rowAdmTec){
                $_SESSION['passUsuario'] = $rowAdmTec['passAdmTecnicos'];
                $_SESSION['userUsuario'] = $rowAdmTec['userAdmTecnicos']; 
                $_SESSION['emailUsuario'] = $rowAdmTec['emailAdmTecnicos'];  
                $nombre = $_SESSION['userUsuario'];
                $password1 = $_SESSION['passUsuario'];
                $email = $_SESSION['emailUsuario'];
            } else{
            $sqlMesaAyuda = "SELECT passMesaAyuda, userMesaAyuda,emailMesaAyuda FROM mesa_ayuda WHERE userMesaAyuda = '" .$buscUser."'";
            $resMesaAyuda = mysqli_query($conexion, $sqlMesaAyuda);
            $rowMesaAyuda = $resMesaAyuda->fetch_assoc();
            if($rowMesaAyuda){
                $_SESSION['passUsuario'] = $rowMesaAyuda['passMesaAyuda'];
                $_SESSION['userUsuario'] = $rowMesaAyuda['userMesaAyuda'];  
                $_SESSION['emailUsuario'] = $rowMesaAyuda['emailMesaAyuda']; 
                $nombre = $_SESSION['userUsuario'];
                $password1 = $_SESSION['passUsuario'];
                $email = $_SESSION['emailUsuario'];

            } else{
                header('Location: ../sdo-administrador/datos-password.php?errorBuscarPersonal=true');
            
            }
            }
          } //echo 'No Existe el Usuario'; 
        }
         } 
        
        }

} 

}
 else{
    header('Location: ../sdo-funciones/password-buscar.php?errorBuscarPersonal=true');
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
</head>

<div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow border">
                    <div class="card-header text-center">
                        <a href="#" class="h3"><b>Visor de Codigos</b></a>
                        <br>
                        <br>
                        <input type=image src="../dist/img/ssvq1.png">
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                    <form action="../sdo-flujo/enviar-correo-1.php" method="POST">
                        <div class="input-group mb-3">
                            <table>
                        <!-- <tr> 
                                    <td> 
                                        <h4><b>El ID es: <input type="text" class="form-control" value=<?//php echo $id?>></b></h4>
                                    </td>
                                </tr>-->
                                <tr> 
                                    <td> 
                                        <h4><b>El nombre de Usuario es: <input type="text" id="nombre" required name="nombre" class="form-control" value=<?php echo $nombre?>></b></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><b>La clave del Usuario es: </b> <input type="text" id="password1" required name="password1" class="form-control" value=<?php echo $password1?>></b></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4><b>El Email es: </b> <input type="text" id="email" required name="email" class="form-control" value=<?php echo $email ?>></b></h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <div class="social-auth-links text-center mt-2 mb-3">
                                <button type="submit" class="btn btn-primary btn-block">Enviar Correo</button>
                                <a href="../sdo-administrador/buscar-password.php" class="btn btn-block btn-warning">
                                    Volver
                                </a>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
