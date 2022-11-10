<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idMaterial = $_POST['idMaterial'];
    //$nuevaCantidad = trim($_POST['total']);

    if(!empty($idMaterial)){

        //Valida que la herramienta no este ingresada 
        $query = "DELETE FROM pañol_materiales WHERE idMaterial = ${idMaterial}"; 
        $resultado = mysqli_query($conexion, $query);

       
        if($resultado){
            header('Location: listado-materiales.php?eliminado=true');
        }else{
            header('Location: listado-materiales.php?eliminado=false');
        }
        

        
    }

}
mysqli_close($conexion);

?>




