<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idHerramienta = $_POST['codHerramienta'];
    //$nuevaCantidad = trim($_POST['total']);

    if(!empty($idHerramienta)){

        $nombre = $_POST['nomHerramienta'];
        $categoria = $_POST['idCategoria'];
        $marca = $_POST['marcaHerramienta'];
        $cantidad = $_POST['cantidadHerramienta'];
        $modelo = $_POST['modeloHerramienta'];
        $descripcion = $_POST['descripHerramienta'];
        

        //Modifica la tabla de la base de datos según el WHERE
        $query = "UPDATE pañol_herramientas SET nomHerramienta = '${nombre}' , idCategoria = '${categoria}' , marcaHerramienta = '${marca}' , modeloHerramienta = '${modelo}', cantHerramienta = '${cantidad}', descriptHerramienta = '${descripcion}' WHERE codHerramienta = '${idHerramienta}'"; 
   
        $resultado = mysqli_query($conexion, $query);

    
        if($resultado){
            header('Location: listado-herramientas.php?modificacion=true');
        }else{
            header('Location: bodega-administrar.php?modificacion=false');
        }
        

        
    }

}
mysqli_close($conexion);

?>




