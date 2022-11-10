<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idHerramienta = $_POST['idHerramienta'];
    $nuevaCantidad = $_POST['total'];
    
    $cod = trim($_POST['codHerramienta']);
    $nombre = trim($_POST['nomHerramienta']);
    $categoriaOrden = trim($_POST['idCategoria']);
    $marca = trim($_POST['marcaHerramienta']);
    $modelo = trim($_POST['modeloHerramienta']);
    $cantidad = trim($_POST['numeroIngresar']);
    $descripcion = trim($_POST['descripHerramienta']);
    $cantidadActual = $_POST['cantidadHerramienta'];


    //$cantHerramienta = $_POST['cantidadHerramienta'];

    // var_dump($nuevaCantidad);

    // exit;
    if($nuevaCantidad == 'NaN'){
        $nuevaCantidad = $cantidadActual;
    }


    if(!empty($idHerramienta) && !empty($nuevaCantidad)){

      

        //Valida que la herramienta no este ingresada 
        $query = "UPDATE pañol_herramientas SET cantHerramienta = '". $nuevaCantidad . "'WHERE idHerramienta = '${idHerramienta}'"; 
        $resultado = mysqli_query($conexion, $query);


        $descripcionHis = "En la jornada " . date('Y/m/d') . " Se ingresaron " . $cantidad . " unidades de la herramienta de nombre: " . $nombre;


        //Inserta 
        $query1 = "INSERT INTO pañol_herramientas_historial( codHerramienta, nomHerramienta, idCategoria, marcaHerramienta, modeloHerramienta, cantHerramienta ,descriptHerramienta)";
        $query1 .=  "VALUES('$cod', '$nombre', '$categoriaOrden', '$marca', '$modelo', '$cantidad','$descripcionHis')";

       

        $res = mysqli_query($conexion, $query1);


    
        if($resultado){
            header('Location: bodega-administrar.php?cambioValido=true');
        }else{
            header('Location: bodega-administrar.php?cambioValido=false');
        }
        
        
        
    }

}
mysqli_close($conexion);

?>




