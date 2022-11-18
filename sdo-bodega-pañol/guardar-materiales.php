<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $cod = trim($_POST['codBarra']);
    $nombre = trim($_POST['nombre']);
    //$categoriaOrden = trim($_POST['categoriaOrden']);
    $marca = trim($_POST['marca']);
    $imagen = $_FILES['imagen'];

    if(empty($marca)){

        $marca = "Sin Información";
    }
    $modelo = trim($_POST['modelo']);

   
    if(empty($modelo)){

        $modelo = "Sin Información";
    }
    $cantidad = trim($_POST['cantidad']);
    $descripcion = trim($_POST['descripcion']);
    //$ingreso = date('Y/m/d');
    $vencimiento = $_POST['vencimiento'];

    if(empty($vencimiento)){

        $vencimiento = "Sin Fecha de vencimiento";
    }

    if(!empty($cod) && !empty($nombre) && !empty($marca) && !empty($modelo) && !empty($cantidad) && !empty($descripcion)){

        //Valida que la herramienta no este ingresada 
        $query = "SELECT * FROM pañol_materiales WHERE codMaterial = '${cod}'"; 
        $resultado = mysqli_query($conexion, $query);

        var_dump($query);
        
        if($resultado->num_rows){  

            header('Location: ../sdo-bodega-pañol/materiales-administrar.php?repetido=true');

        }else{

            if($imagen['type'] == 'image/png' || $imagen['type'] == 'image/jpeg'){

                //CREA CARPETA 
                $carpetaIMG = 'img/';
    
                if(!is_dir($carpetaIMG)){
                    mkdir($carpetaIMG);
                }
    
                //Generar un nombre único
                $nomArchivo = md5( uniqid(rand(), true) ) . ".jpeg";
    
                //SUBIR PDF
                //$carpeta = "/pdfSoliReserva"; 
                move_uploaded_file($imagen['tmp_name'], $carpetaIMG . $nomArchivo);
                
    
                $query = "INSERT INTO pañol_materiales ( imagen,codMaterial, nomMaterial, marcaMaterial, modeloMaterial, cantMaterial, fechaVencimiento ,descriptMaterial)";
                $query .=  "VALUES('$nomArchivo','$cod', '$nombre',  '$marca', '$modelo', '$cantidad', '$vencimiento','$descripcion')";
                $resultado = mysqli_query($conexion, $query);

                //Query Insert tabla pañol_herramientas_historial
                $descripcionHis = "En la jornada " . date('Y/m/d') . " Se ingresaron " . $cantidad . " unidades de la herramienta: " . $nombre;

                $query = "INSERT INTO pañol_materiales_historial ( imagen,codMaterial, nomMaterial,  marcaMaterial, modeloMaterial, cantMaterial, fechaVencimiento ,descriptMaterial)";
                $query .=  "VALUES('$nomArchivo','$cod', '$nombre',  '$marca', '$modelo', '$cantidad', '$vencimiento','$descripcion')";
                $resultado = mysqli_query($conexion, $query);

                if($resultado){

                    header('Location: ../sdo-bodega-pañol/listado-materiales.php?exitoCrearMaterial=true');
    
                }else{
                    header('Location: ../sdo-bodega-pañol/listado-materiales.php?exitoCrearMaterial=false');

                }

            }else{
    
                header('Location: ../sdo-bodega-pañol/materiales-administrar.php?solojpeg=true');
            }

            // if ($categoriaOrden == 0 || $categoriaOrden == 'Otro' || $categoriaOrden == 'otro') {
            //     if (isset($_POST['OtroCategoria'])) {
        
            //         $OtroCategoria = trim($_POST['OtroCategoria']);
        
            //         if (!empty($OtroCategoria)) {
            //             $OtroCategoria = str_replace("'", "\'", $OtroCategoria);
        
            //             $buscarCategoria = buscarCategoria($OtroCategoria);
        
            //             if($buscarCategoria == 0){
        
            //                 $queryOtroCategoria = "INSERT INTO categorias_material(idCategoria,nomCategoria) VALUES (NULL,'" . $OtroCategoria . "')";
        
            //                 // echo $queryOtroServicio;
            
            //                 $resOtroCategoria = mysqli_query($conexion, $queryOtroCategoria);
            
            //                 $categoriaOrden = mysqli_insert_id($conexion);
            //             }else{
            //                 $categoriaOrden = $buscarCategoria;
            //             }
        
                        
            //         } else {
            //         }
            //     } else {
            //     }
            // }

      

         
        }

        
    }else{
        header('Location: ../sdo-bodega-pañol/materiales-administrar.php?vacios=true');

    }

}
mysqli_close($conexion);
