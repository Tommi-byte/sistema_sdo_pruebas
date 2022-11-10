<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idHerramienta = $_POST['idHerramienta'];
    //$nuevaCantidad = trim($_POST['total']);

    if(!empty($idHerramienta)){

        //Valida que la herramienta no este ingresada 
        $query = "DELETE FROM pañol_herramientas WHERE idHerramienta = '${idHerramienta}'"; 
        $resultado = mysqli_query($conexion, $query);

    
        if($resultado){
            header('Location: listado-herramientas.php?eliminado=true');
        }else{
            header('Location: bodega-administrar.php?eliminado=false');
        }
        

        
    }

}
mysqli_close($conexion);

?>




