<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('funciones.php');
include_once('conexion.php');


if (isset($_POST['addNombre'], $_POST['addUser'], $_POST['addPassword'], $_POST['departamentoAgregar'])) {

    $nomPersonal = trim($_POST['addNombre']);
    $nomPersonal = ucwords(strtolower($nomPersonal));
    $userPersonal = trim($_POST['addUser']);
    $passPersonal = trim($_POST['addPassword']);
    $departamentoAgregar = trim($_POST['departamentoAgregar']);

    $subdepartamentoAgregar = 0;

    if(isset($_POST['idSubDepartamento'])){
        $idSubDepartamento = trim($_POST['idSubDepartamento']);

        if($idSubDepartamento > 0){
            $subdepartamentoAgregar = $idSubDepartamento;
        }else{
            $subdepartamentoAgregar = 0;
        }
    }else{
        $subdepartamentoAgregar = 0;
    }


    if (empty($nomPersonal) || empty($userPersonal) || empty($passPersonal) || empty($departamentoAgregar) || $nomPersonal == '' || $userPersonal == '' || $passPersonal == '' || $departamentoAgregar == '') {
        header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorAgregarTecnico=true');
    } else {
        $existePersonal = existePersonal($userPersonal);

        $existeAdministrador = existeAdministrador($userPersonal);

        if ($existePersonal == 0) {

            if ($existeAdministrador == 0) {

                $query = "INSERT INTO personal(idPersonal,nomPersonal,userPersonal,passPersonal,activoPersonal,departamentoPersonal,idSubdepartamento)";
                $query .=  "VALUES (NULL,'" . $nomPersonal . "','" . $userPersonal . "','" . $passPersonal . "',1,'" . $departamentoAgregar . "','" . $subdepartamentoAgregar . "')";
                $res = mysqli_query($conexion, $query);

                if ($res) {
                    header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?exitoAgregarTecnico=true');
                } else {
                    header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorAgregarTecnico=true');
                }
            } else {
                header('Location: ..sdo-jefestecnicos/tecnicos-listado.php?existeUsuario=true');
            }
        } else {
            header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?existeUsuario=true');
        }
    }
} else {
    header('Location: ../sdo-jefestecnicos/tecnicos-listado.php?errorAgregarTecnico=true');
}

mysqli_close($conexion);
