e                        <?php

include('funciones.php');
include_once('conexion.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$rolUsuario = '';
$rutaRol = '';

if (isset($_POST['rolUsuario'])) {

    $rolUsuario = trim($_POST['rolUsuario']);

    if (!empty($rolUsuario)) {
        if ($rolUsuario == "Administrador") {

            $rutaRol = "sdo-administrador/actas-administrar.php";
        } else if ($rolUsuario == "Personal") {

            $rutaRol = "sdo-personal/actas-listado.php";
        } else if ($rolUsuario == "Directiva") {

            $rutaRol = "sdo-directiva";
        } else if ($rolUsuario == "Jefe Tecnico") {

            $rutaRol = "sdo-jefestecnicos/actas-administrar.php";
        } else if ($rolUsuario == "Administrativo") {

            $rutaRol = "sdo-admtec/actas-listado.php";
        } else {

            header('Location: ../sdo-flujo/login.php?errorLogin=true');
        }

        if (isset($_POST['codigoTarjeta'], $_POST['idActa2'],$_POST['calidadContractual'],$_POST['nomTarjeta'],$_POST['rutTarjeta'],$_POST['numTelefono'],$_POST['unidadTarjeta'],$_POST['nomSolicitante'],$_POST['nomControlCentralizado'])) {

            $codigoTarjeta = trim($_POST['codigoTarjeta']);
            $idActa2 = trim($_POST['idActa2']);
            $calidadContractual = trim($_POST['calidadContractual']);
            $nomTarjeta = trim($_POST['nomTarjeta']);

            $nomTarjeta = mb_convert_case($nomTarjeta,MB_CASE_LOWER,"UTF-8");
            $nomTarjeta = mb_convert_case($nomTarjeta,MB_CASE_TITLE,"UTF-8");

            $rutTarjeta = trim($_POST['rutTarjeta']);
            $numTelefono = trim($_POST['numTelefono']);
            $unidadTarjeta = trim($_POST['unidadTarjeta']);
            $nomSolicitante = trim($_POST['nomSolicitante']);

            $nomSolicitante = mb_convert_case($nomSolicitante,MB_CASE_LOWER,"UTF-8");
            $nomSolicitante = mb_convert_case($nomSolicitante,MB_CASE_TITLE,"UTF-8");
            
            $nomControlCentralizado = trim($_POST['nomControlCentralizado']);

            if (empty($codigoTarjeta) || empty($idActa2) || empty($calidadContractual) || empty($nomTarjeta) || empty($rutTarjeta) || empty($unidadTarjeta) || empty($nomSolicitante)){
                header('Location: ../' . $rutaRol . '?errorModActa=true');
            } else {

                $cadenaTexto = "A-".$idActa2."-".$codigoTarjeta;

                $queryModificar = "UPDATE actas SET folioActa = '" . $cadenaTexto . "', fechaActa = NOW() , codigoTarjeta = '" . $codigoTarjeta . "', nomTarjeta = '" . $nomTarjeta . "', rutTarjeta = '" . $rutTarjeta . "', unidadTarjeta = '" . $unidadTarjeta . "', nomSolicitante = '" . $nomSolicitante . "', nomControlCentralizado = '" . $nomControlCentralizado . "', calidadContractual = '" . $calidadContractual . "', numTelefono = '" . $numTelefono . "', tipoActa = 'Actualización' WHERE idActa = " . $idActa2;

                $resModificar = mysqli_query($conexion, $queryModificar);

                if ($resModificar) {

                    header('Location: ../' . $rutaRol . '?exitoModActa=true');
                } else {
                    header('Location: ../' . $rutaRol . '?errorModActa=true');
                }

            }
        } else {
            header('Location: ../' . $rutaRol . '?errorModActa=true');
        }
    } else {
        header('Location: sdo-flujo/login.php?errorLogin=true');
    }
} else {
    header('Location: sdo-flujo/login.php?errorLogin=true');
}
