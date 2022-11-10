<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $cod = trim($_POST['codBarra']);
    $nombre = trim($_POST['nombre']);
    $categoriaOrden = trim($_POST['categoriaOrden']);

    // var_dump($categoriaOrden);
    // exit;
    $marca = trim($_POST['marca']);
    
    if(empty($marca)){

        $marca = "Sin Información";
    }
    $modelo = trim($_POST['modelo']);

    if(empty($modelo)){

        $modelo = "Sin Información";
    }

    $cantidad = trim($_POST['cantidad']);
    $descripcion = trim($_POST['descripcion']);
    $depa = trim($_POST['departamento']);



    //$ingreso = date('Y/m/d');
    //$vencimiento = $_POST['vencimiento'];

    if(!empty($cod) && !empty($nombre)  && !empty($modelo) && !empty($cantidad) && !empty($descripcion)){

        //Valida que la herramienta no este ingresada 
        $query = "SELECT * FROM pañol_herramientas WHERE codHerramienta = '${cod}'"; 
        $resultado = mysqli_query($conexion, $query);

        var_dump($query);
        
        if($resultado->num_rows){  

            header('Location: ../sdo-bodega-pañol/bodega-administrar.php?repetido=true');

        }else{


            if ($categoriaOrden == 0 || $categoriaOrden == 'Otro' || $categoriaOrden == 'otro') {
                if (isset($_POST['OtroCategoria'])) {
        
                    $OtroCategoria = trim($_POST['OtroCategoria']);
        
                    if (!empty($OtroCategoria)) {
                        $OtroCategoria = str_replace("'", "\'", $OtroCategoria);
        
                        $buscarCategoria = buscarCategoria($OtroCategoria);
        
                        if($buscarCategoria == 0){
        
                            $queryOtroCategoria = "INSERT INTO categorias_herramienta(idCategoria,nomCategoria) VALUES (NULL,'" . $OtroCategoria . "')";
        
                            // echo $queryOtroServicio;
            
                            $resOtroCategoria = mysqli_query($conexion, $queryOtroCategoria);
            
                            $categoriaOrden = mysqli_insert_id($conexion);
                        }else{
                            $categoriaOrden = $buscarCategoria;
                        }
        
                        
                    } else {
                    }
                } else {
                }
            }

            //Query Insert tabla pañol_herramientas
            $query = "INSERT INTO pañol_herramientas( codHerramienta, nomHerramienta, idCategoria, marcaHerramienta, modeloHerramienta, cantHerramienta ,descriptHerramienta, idDepartamento)";
            $query .=  "VALUES('$cod', '$nombre', '$categoriaOrden', '$marca', '$modelo', '$cantidad','$descripcion','$depa')";
            $resultado = mysqli_query($conexion, $query);


            //Query Insert tabla pañol_herramientas_historial
            $descripcionHis = "En la jornada " . date('Y/m/d') . " Se ingresaron " . $cantidad . " unidades de la herramienta: " . $nombre;

            $query = "INSERT INTO pañol_herramientas_historial( codHerramienta, nomHerramienta, idCategoria, marcaHerramienta, modeloHerramienta, cantHerramienta ,descriptHerramienta, idDepartamento)";
            $query .=  "VALUES('$cod', '$nombre', '$categoriaOrden', '$marca', '$modelo', '$cantidad','$descripcionHis', '$depa')";
            $res = mysqli_query($conexion, $query);


            
           

            if($resultado){

                header('Location: ../sdo-bodega-pañol/listado-herramientas.php?exitoCrearHerramienta=true');

            }else{
                header('Location: ../sdo-bodega-pañol/bodega-administrar.php?exitoCrearHerramienta=false');
            }
        }

        
    }else{
        header('Location: ../sdo-bodega-pañol/bodega-administrar.php?vacios=true');
    }

}
mysqli_close($conexion);
