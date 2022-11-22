<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('funciones.php');
include_once('conexion.php');


if (isset($_POST['addNomCategoria'], $_POST['idCategoria'])) {

    $addNomCategoria = trim($_POST['addNomCategoria']);
    $idCategoria = $_POST['idCategoria'];

    if(!empty($addNomCategoria) && !empty($idCategoria) && $idCategoria > 0){

        $existeSubcategoria = existeSubcategoria($addNomCategoria,$idCategoria);

        // echo $existeSubcategoria;
        if($existeSubcategoria == 0){
            $query = "INSERT INTO subcategorias(idSubcategoria,nomSubcategoria,idCategoria)";
            $query .=  "VALUES (NULL,'" . $addNomCategoria . "','" . $idCategoria . "')";
            $res = mysqli_query($conexion, $query);

            if ($res) {
                header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?exitoAgregarCategoria=true');
            } else {
                header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?errorAgregarCategoria=true');
            }
        }else{
            header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?existeCategoria=true');
        }
    }else{
        header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?errorAgregarCategoria=true');
    }

} else {
    header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?errorAgregarCategoria=true');
}

mysqli_close($conexion);
