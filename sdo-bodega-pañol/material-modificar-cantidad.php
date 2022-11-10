<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idMaterial = $_POST['idMaterial'];
    $nuevaCantidad = trim($_POST['total']);
    $cantidadActual = $_POST['cantidadHerramienta'];
   

    $numeroIngresar = $_POST['numeroIngresar'];
    $cod = $_POST['codHerramienta'];
    $nombre = $_POST['nomHerramienta'];
    $idCategoria = $_POST['idCategoria'];
    $marca = $_POST['marcaHerramienta'];
    $modelo = $_POST['modeloHerramienta'];
    $vencimiento = $_POST['fechavencimientoHerramienta'];

    if(empty($vencimiento)){

        $vencimiento = "Sin Fecha de vencimiento";
    }


    $descripcion = $_POST['descripHerramienta'];




    if($nuevaCantidad == 'NaN'){
        $nuevaCantidad = $cantidadActual;
    }

    if(!empty($idMaterial) && !empty($nuevaCantidad)){

        //Valida que la herramienta no este ingresada 
        $query = "UPDATE pañol_materiales SET cantMaterial = '". $nuevaCantidad . "'WHERE idMaterial = '${idMaterial}'"; 
        $resultado = mysqli_query($conexion, $query);

        $descripcionHis = "En la jornada " . date('Y/m/d') . " Se ingresaron " . $numeroIngresar . " unidades de la herramienta de nombre: " . $nombre;


        //Query insert nueva cantidades tabla historial
        $query1 = "INSERT INTO pañol_materiales_historial ( codMaterial, nomMaterial, idCategoria, marcaMaterial, modeloMaterial, cantMaterial, fechaVencimiento ,descriptMaterial)";
        $query1 .=  "VALUES('$cod', '$nombre', '$idCategoria', '$marca', '$modelo', '$numeroIngresar', '$vencimiento','$descripcionHis')";
        $resultado = mysqli_query($conexion, $query1);

    
        if($resultado){
            header('Location: materiales-administrar.php?cambioValido=true');
        }else{
            header('Location: materiales-administrar.php?cambioValido=false');
        }
        

        
    }

}
mysqli_close($conexion);

?>




