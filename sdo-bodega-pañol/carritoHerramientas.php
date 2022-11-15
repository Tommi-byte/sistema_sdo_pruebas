<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mensaje = "";


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['btnAccion'])){


        switch($_POST['btnAccion']){


            case 'Agregar':

                if(is_numeric($_POST['id'])){

                    $id = $_POST['id'];
                    $mensaje.= "  ID: " . $id . "<br>";
                }else{
                   

                    $mensaje = "Upss... ID no valido " . $id;
                }
                if(is_string($_POST['nombre'])){

                    $nombre = $_POST['nombre'];
                    $mensaje.= "  Nombre: " . $nombre . "<br>";
                }else{

                    $mensaje = "Upss... Nombre no valido " . $nombre;
                }
                if(is_numeric($_POST['cantidad'])){

                    $cantidad = $_POST['cantidad'];
                    $mensaje.= "  Cantidad: " . $cantidad . "<br>";
                }else{

                    $mensaje = "Upss... ID no valido " . $id;
                }
                if(is_numeric($_POST['codigo'])){

                    $codigo = $_POST['codigo'];
                    $mensaje.= "  Código: " . $codigo . "<br>";
                }else{

                    $mensaje = "Upss... Código no valido " . $codigo;
                }

                $stock = $_POST['stock'];


            if(!isset($_SESSION['CARRITO'])){

                $herramienta = array(

                    
                    'id' => $id,
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'stock' => $stock

                );
                $_SESSION['CARRITO'][0] = $herramienta;

            }else{

                $idHerramientas = array_column($_SESSION['CARRITO'],'id');

                if(in_array($id, $idHerramientas)){


                    echo "<script>alert('Producto ya añadido al carrito')</script>";
                    $mensaje = "";

                }else{
                    $numeroHerramientas = count($_SESSION['CARRITO']);
                    $herramienta = array(
    
                        
                        'id' => $id,
                        'nombre' => $nombre,
                        'cantidad' => $cantidad,
                        'codigo' => $codigo,
                        'stock' => $stock
    
                    );
                    array_push($_SESSION['CARRITO'], $herramienta);
    
                }

                
            }
            
            

            break;

            case 'Eliminar':

                if(is_numeric($_POST['id'])){

                    $id = $_POST['id'];

                    foreach($_SESSION['CARRITO'] AS $indice => $herramienta){

                        if($herramienta['id']==$id){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script>
                            
                                alert('Herramienta seleccionada eliminada')
                            
                            </script>";
                        }
                    }


                }
            
            
            break;


        
        }
    }

}