<?php
// MODIFICAR PARA LICITACION

include("conexion.php");
include("funciones.php");


if (isset($_POST['usuarioRegistrado']) && isset($_POST['passwordRegistrado'])) {
  $usuarioRegistrado = trim($_POST['usuarioRegistrado']);
  $passwordRegistrado = trim($_POST['passwordRegistrado']);

  if (empty($usuarioRegistrado) || empty($passwordRegistrado) || $usuarioRegistrado == '' || $passwordRegistrado == '' || $usuarioRegistrado == ' ' || $passwordRegistrado == ' ') {
    header('Location: ../sdo-flujo/login.php?errorLogin=true');
  } else {

    $sqlAdmin = "SELECT * FROM administracion WHERE userAdministrador = '" . $usuarioRegistrado . "' AND passAdministrador = '" . $passwordRegistrado . "'";
    $resAdmin = mysqli_query($conexion, $sqlAdmin);
    $rowAdmin = $resAdmin->fetch_assoc();
    if ($rowAdmin) {

      // iniciar la sesion
      if (session_status() == PHP_SESSION_NONE) {
        ini_set('session.cache_expire', 200000);
        ini_set('session.cache_limiter', 'none');
        ini_set('session.cookie_lifetime', 2000000);
        ini_set('session.gc_maxlifetime', 200000);
        session_start();
        ini_set('session.cache_expire', 200000);
        ini_set('session.cache_limiter', 'none');
        ini_set('session.cookie_lifetime', 2000000);
        ini_set('session.gc_maxlifetime', 200000);
      }
      $_SESSION['userUsuario'] = $rowAdmin['userAdministrador'];
      $_SESSION['nomUsuario'] = $rowAdmin['nomAdministrador'];
      $_SESSION['idUsuario'] = $rowAdmin['idAdministrador'];
      $_SESSION['login'] = true;
      $_SESSION['cargoUsuario'] = $rowAdmin['rolAdministrador'];
      $_SESSION['rolUsuario'] = 'Administrador';
      $_SESSION['idUsuarioParaSubida'] = $rowAdmin['idAdministrador'];

      if ($passwordRegistrado == 'sdo2022' || $passwordRegistrado == 'SDO2022') {
        header('Location: ../sdo-flujo/cambiarPassword.php?cambiarPassword=true');
      } else {
        header('Location: ../sdo-administrador/index.php?loginExito=true');
      }
    } else {

      $sqlPersonal = "SELECT * FROM personal WHERE userPersonal = '" . $usuarioRegistrado . "' AND passPersonal = '" . $passwordRegistrado . "'";
      $resPersonal = mysqli_query($conexion, $sqlPersonal);
      $rowPersonal = $resPersonal->fetch_assoc();
      if ($rowPersonal) {

        $activoPersonal = $rowPersonal['activoPersonal'];

        if ($activoPersonal == 1) {
          // iniciar la sesion
          if (session_status() == PHP_SESSION_NONE) {
            ini_set('session.cache_expire', 200000);
            ini_set('session.cache_limiter', 'none');
            ini_set('session.cookie_lifetime', 2000000);
            ini_set('session.gc_maxlifetime', 200000);
            session_start();
            ini_set('session.cache_expire', 200000);
            ini_set('session.cache_limiter', 'none');
            ini_set('session.cookie_lifetime', 2000000);
            ini_set('session.gc_maxlifetime', 200000);
          }
          $_SESSION['userUsuario'] = $rowPersonal['userPersonal'];
          $_SESSION['nomUsuario'] = $rowPersonal['nomPersonal'];
          $_SESSION['idUsuario'] = $rowPersonal['idPersonal'];
          $_SESSION['cargoUsuario'] = $rowPersonal['cargoPersonal'];
          $_SESSION['login'] = true;
          $_SESSION['rolUsuario'] = 'Personal';
          $_SESSION['idDepartamento'] = $rowPersonal['departamentoPersonal'];
          $_SESSION['idSubDepartamento'] = $rowPersonal['idSubdepartamento'];
          $_SESSION['departamentoPersonal'] = getNomDepartamento($rowPersonal['departamentoPersonal']);
          $_SESSION['idUsuarioParaSubida'] = $rowPersonal['idPersonal'];

          if ($passwordRegistrado == 'sdo2022' || $passwordRegistrado == 'SDO2022') {
            header('Location: ../sdo-flujo/cambiarPassword.php?cambiarPassword=true');
          } else {
            header('Location: ../sdo-personal/index.php?loginExito=true');
          }
        } else {
          header('Location: ../sdo-flujo/login.php?faltaActivacion=true');
        }
      } else {

        $sqlDirectiva = "SELECT * FROM directivos WHERE userDirectivo = '" . $usuarioRegistrado . "' AND passDirectivo = '" . $passwordRegistrado . "'";
        $resDirectiva = mysqli_query($conexion, $sqlDirectiva);
        $rowDirectiva = $resDirectiva->fetch_assoc();
        if ($rowDirectiva) {
          // iniciar la sesion
          if (session_status() == PHP_SESSION_NONE) {
            ini_set('session.cache_expire', 200000);
            ini_set('session.cache_limiter', 'none');
            ini_set('session.cookie_lifetime', 2000000);
            ini_set('session.gc_maxlifetime', 200000);
            session_start();
            ini_set('session.cache_expire', 200000);
            ini_set('session.cache_limiter', 'none');
            ini_set('session.cookie_lifetime', 2000000);
            ini_set('session.gc_maxlifetime', 200000);
          }
          $_SESSION['userUsuario'] = $rowDirectiva['userDirectivo'];
          $_SESSION['nomUsuario'] = $rowDirectiva['nomDirectivo'];
          $_SESSION['idUsuario'] = $rowDirectiva['idDirectivo'];
          $_SESSION['login'] = true;
          $_SESSION['rolUsuario'] = 'Directiva';
          $_SESSION['idUsuarioParaSubida'] = $rowDirectiva['idDirectivo'];

          if ($passwordRegistrado == 'sdo2022' || $passwordRegistrado == 'SDO2022' || $passwordRegistrado == 'directiva2022' || $passwordRegistrado == 'DIRECTIVA2022') {
            header('Location: ../sdo-flujo/cambiarPassword.php?cambiarPassword=true');
          } else {
            header('Location: ../sdo-directiva/index.php?loginExito=true');
          }
        } else {

          $sqlJefeTecnico = "SELECT * FROM jefes_tecnicos WHERE userJefe = '" . $usuarioRegistrado . "' AND passJefe = '" . $passwordRegistrado . "'";
          $resJefeTecnico = mysqli_query($conexion, $sqlJefeTecnico);
          $rowJefeTecnico = $resJefeTecnico->fetch_assoc();
          if ($rowJefeTecnico) {
            // iniciar la sesion
            if (session_status() == PHP_SESSION_NONE) {
              ini_set('session.cache_expire', 200000);
              ini_set('session.cache_limiter', 'none');
              ini_set('session.cookie_lifetime', 2000000);
              ini_set('session.gc_maxlifetime', 200000);
              session_start();
              ini_set('session.cache_expire', 200000);
              ini_set('session.cache_limiter', 'none');
              ini_set('session.cookie_lifetime', 2000000);
              ini_set('session.gc_maxlifetime', 200000);
            }
            $_SESSION['userUsuario'] = $rowJefeTecnico['userJefe'];
            $_SESSION['nomUsuario'] = $rowJefeTecnico['nomJefe'];
            $_SESSION['idUsuario'] = $rowJefeTecnico['idJefe'];
            $_SESSION['idDepartamento'] = $rowJefeTecnico['idDepartamento'];
            $_SESSION['cargoJefe'] = $rowJefeTecnico['cargoJefe'];
            $_SESSION['idSubDepartamento'] = $rowJefeTecnico['idSubdepartamento'];
            $_SESSION['emailJefe'] = $rowJefeTecnico['emailJefe'];
            $_SESSION['login'] = true;
            $_SESSION['rolUsuario'] = 'Jefe Tecnico';
            $_SESSION['idUsuarioParaSubida'] = $rowJefeTecnico['idJefe'];

            if ($passwordRegistrado == 'sdo2022' || $passwordRegistrado == 'SDO2022') {
              header('Location: ../sdo-flujo/cambiarPassword.php?cambiarPassword=true');
            } else {
              header('Location: ../sdo-jefestecnicos/index.php?loginExito=true');
            }
          } else {

            $sqlAdmTec = "SELECT * FROM adm_tecnicos WHERE userAdmTecnicos = '" . $usuarioRegistrado . "' AND passAdmTecnicos = '" . $passwordRegistrado . "'";
            $resAdmTec = mysqli_query($conexion, $sqlAdmTec);
            $rowAdmTec = $resAdmTec->fetch_assoc();
            if ($rowAdmTec) {
              // iniciar la sesion
              if (session_status() == PHP_SESSION_NONE) {
                ini_set('session.cache_expire', 200000);
                ini_set('session.cache_limiter', 'none');
                ini_set('session.cookie_lifetime', 2000000);
                ini_set('session.gc_maxlifetime', 200000);
                session_start();
                ini_set('session.cache_expire', 200000);
                ini_set('session.cache_limiter', 'none');
                ini_set('session.cookie_lifetime', 2000000);
                ini_set('session.gc_maxlifetime', 200000);
              }
              $_SESSION['userUsuario'] = $rowAdmTec['userAdmTecnicos'];
              $_SESSION['nomUsuario'] = $rowAdmTec['nomAdmTecnicos'];
              $_SESSION['idUsuario'] = $rowAdmTec['idAdmTecnicos'];
              $_SESSION['idDepartamento'] = $rowAdmTec['idDepartamento'];
              $_SESSION['nomDepartamento'] =  getNomDepartamento($rowAdmTec['idDepartamento']);
              $_SESSION['login'] = true;
              $_SESSION['rolUsuario'] = 'Administrativo';
              $_SESSION['idUsuarioParaSubida'] = $rowJefeTecnico['idAdmTecnicos'];

              if ($passwordRegistrado == 'sdo2022' || $passwordRegistrado == 'SDO2022') {
                header('Location: ../sdo-flujo/cambiarPassword.php?cambiarPassword=true');
              } else {
                header('Location: ../sdo-admtec/index.php?loginExito=true');
              }
            } else {

              $sqlMesaAyuda = "SELECT * FROM mesa_ayuda WHERE userMesaAyuda = '" . $usuarioRegistrado . "' AND passMesaAyuda = '" . $passwordRegistrado . "'";
              $resMesaAyuda = mysqli_query($conexion, $sqlMesaAyuda);
              $rowMesaAyuda = $resMesaAyuda->fetch_assoc();
              if ($rowMesaAyuda) {
                // iniciar la sesion
                if (session_status() == PHP_SESSION_NONE) {
                  ini_set('session.cache_expire', 200000);
                  ini_set('session.cache_limiter', 'none');
                  ini_set('session.cookie_lifetime', 2000000);
                  ini_set('session.gc_maxlifetime', 200000);
                  session_start();
                  ini_set('session.cache_expire', 200000);
                  ini_set('session.cache_limiter', 'none');
                  ini_set('session.cookie_lifetime', 2000000);
                  ini_set('session.gc_maxlifetime', 200000);
                }
                $_SESSION['userUsuario'] = $rowMesaAyuda['userMesaAyuda'];
                $_SESSION['nomUsuario'] = $rowMesaAyuda['nomMesaAyuda'];
                $_SESSION['idUsuario'] = $rowMesaAyuda['idMesaAyuda'];
                $_SESSION['login'] = true;
                $_SESSION['rolUsuario'] = 'Mesa Ayuda';
                $_SESSION['idUsuarioParaSubida'] = $rowJefeTecnico['idMesaAyuda'];

                if ($passwordRegistrado == 'sdo2022' || $passwordRegistrado == 'SDO2022') {
                  header('Location: ../sdo-flujo/cambiarPassword.php?cambiarPassword=true');
                } else {
                  header('Location: ../sdo-mesa-ayuda/index.php?loginExito=true');
                }

              } else {

                $sqlBodegaPañol = "SELECT * FROM bodega_pañol WHERE userBodegaPañol = '" . $usuarioRegistrado . "' AND passBodegaPañol = '" . $passwordRegistrado . "'";
                $resBodegaPañol = mysqli_query($conexion, $sqlBodegaPañol);
                $rowBodegaPañol = $resBodegaPañol->fetch_assoc();
                
                if($rowBodegaPañol){
                  //Iniciar Sesión
                  if (session_status() == PHP_SESSION_NONE) {
                    ini_set('session.cache_expire', 200000);
                    ini_set('session.cache_limiter', 'none');
                    ini_set('session.cookie_lifetime', 2000000);
                    ini_set('session.gc_maxlifetime', 200000);
                    session_start();
                    ini_set('session.cache_expire', 200000);
                    ini_set('session.cache_limiter', 'none');
                    ini_set('session.cookie_lifetime', 2000000);
                    ini_set('session.gc_maxlifetime', 200000);
                  }
                  $_SESSION['userUsuario'] = $rowBodegaPañol['userBodegaPañol'];
                  $_SESSION['nomUsuario'] = $rowBodegaPañol['nomBodegaPañol'];
                  $_SESSION['idUsuario'] = $rowBodegaPañol['idBodegaPañol'];
                  $_SESSION['login'] = true;
                  $_SESSION['rolUsuario'] = 'Bodega Pañol';
                  $_SESSION['idUsuarioParaSubida'] = $rowJefeTecnico['idBodegaPañol'];

                  if ($passwordRegistrado == 'sdo2022' || $passwordRegistrado == 'SDO2022') {
                    header('Location: ../sdo-flujo/cambiarPassword.php?cambiarPassword=true');
                  } else {
                    header('Location: ../sdo-bodega-pañol/index.php?loginExito=true');
                  }


                }else{
                  header('Location: ../sdo-flujo/login.php?noExisteUsuario=true');
                }

         
              }
            }
          }
        }
      }
    }
  }
} else {
  header('Location: ../sdo-flujo/login.php?errorLogin=true');
}
