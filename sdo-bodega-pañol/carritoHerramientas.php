<?php

include '../sdo-funciones/conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mensaje = "";

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
              
                if(is_numeric($_POST['codigo'])){

                    $codigo = $_POST['codigo'];
                    $mensaje.= "  Código: " . $codigo . "<br>";
                }else{

                    $mensaje = "Upss... Código no valido " . $codigo;
                }
                if(is_numeric($_POST['sacar'])){

                    $sacar = $_POST['sacar'];
                    $mensaje.= "  Cantidad: " . $sacar . "<br>";
                }else{

                    $mensaje = "Upss... Código no valido " . $sacar;
                }

                $stock = $_POST['stock'];

                if(!isset($_SESSION['CARRITO'])){

                    $herramienta = array(

                        
                        'id' => $id,
                        'nombre' => $nombre,
                        'codigo' => $codigo,
                        'stock' => $stock,
                        'sacar' => $sacar

                    );

                if($herramienta['sacar'] <= 0 ){
                

                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?sacar=true');
                    return;
                }

                if($herramienta['sacar'] > $herramienta['stock'] ){
                

                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?stock=true');
                    return;
                }


                $_SESSION['CARRITO'][0] = $herramienta;
                header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?ingresado=true');


            }else{

                $idHerramientas = array_column($_SESSION['CARRITO'],'id');

                if(in_array($id, $idHerramientas)){


                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?repetido=true');
                    return;

                }else{
                    $numeroHerramientas = count($_SESSION['CARRITO']);
                    $herramienta = array(
    
                        
                        'id' => $id,
                        'nombre' => $nombre,
                        'codigo' => $codigo,
                        'stock' => $stock, 
                        'sacar' => $sacar
    
                    );

                    if($herramienta['sacar'] <= 0 ){
                

                        header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?sacar=true');
                        return;
                    }

                    if($herramienta['sacar'] > $herramienta['stock']){

                        header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?stock=true');
                        return;

                    }

                    array_push($_SESSION['CARRITO'], $herramienta);
                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?ingresado=true');
    
                }

                
            }
            break;

            case 'Eliminar':

                if(is_numeric($_POST['id'])){

                    $id = $_POST['id'];

                    foreach($_SESSION['CARRITO'] AS $indice => $herramienta){

                        if($herramienta['id']==$id){
                            unset($_SESSION['CARRITO'][$indice]);
                            header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?eliminado=true');
                        }
                    }
                }
            break;

            case 'Guardar':

                if(!empty($_SESSION['CARRITO'])){
                    foreach($_SESSION['CARRITO'] AS $indice => $herramienta){

                        $codigo = $herramienta['codigo'];
                        $nombre = $herramienta['nombre'];
                        $cantidad = $herramienta['sacar'];
                        $stock = $herramienta['stock'];
                        $idHerramienta = $herramienta['id'];

                        $resta = $stock - $cantidad;


                        $queryInsert = "INSERT INTO herra_en_arriendo(codHerramienta, nomHerramienta ,cantidadHerramienta,idAR,idHerramienta)
                        VALUES ($codigo, '$nombre', $cantidad, 1, $idHerramienta)";
                        $resInsert = mysqli_query($conexion, $queryInsert);

                        $queryUpdate = "UPDATE pañol_herramientas SET cantHerramienta = '${resta}' WHERE idHerramienta = '${idHerramienta}'";
                        $resUpdate = mysqli_query($conexion, $queryUpdate);

                        unset($_SESSION['CARRITO'][$indice]);
                    }

                    if($resInsert){
                        header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?guardado=true');
                    }
                }else{
                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?vacios=true');
                    
                }
                   
            break;
        }
    }