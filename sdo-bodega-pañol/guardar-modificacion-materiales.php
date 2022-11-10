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

        $nombre = $_POST['nomMaterial'];
        $categoria = $_POST['idCategoria'];
        $marca = $_POST['marcaMaterial'];
        $cantidad = $_POST['cantidadMaterial'];
        $modelo = $_POST['modeloMaterial'];
        $descripcion = $_POST['descripMaterial'];
        

        //Modifica la tabla de la base de datos según el WHERE
        $query = "UPDATE pañol_materiales SET nomMaterial = '${nombre}' , idCategoria = '${categoria}' , marcaMaterial = '${marca}' , modeloMaterial = '${modelo}', cantMaterial = '${cantidad}', descriptMaterial = '${descripcion}' WHERE idMaterial = '${idMaterial}'"; 
        $resultado = mysqli_query($conexion, $query);

        // var_dump($query);

        // exit;

    
        if($resultado){
            header('Location: listado-materiales.php?modificacion=true');
        }else{
            header('Location: listado-materiales.php?modificacion=false');
        }
        

        
    }

}
mysqli_close($conexion);

?>




