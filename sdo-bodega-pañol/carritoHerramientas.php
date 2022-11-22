<?php

include '../sdo-funciones/conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mensaje = "";

    if(isset($_POST['btnAccion'])){


        switch($_POST['btnAccion']){

            //RECUPERAR Y GUARDAR LA INFORMACIÓN DE LA  HERRAMIENTA EN UN ARRAY 
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

            //RECUPERAR Y GUARDAR LA INFORMACIÓN DEL MATERIAL EN UN ARRAY 
            case 'AgregarMaterial':

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

                if(!isset($_SESSION['CARRITOMATERIAL'])){

                    $material = array(

                        
                        'id' => $id,
                        'nombre' => $nombre,
                        'codigo' => $codigo,
                        'stock' => $stock,
                        'sacar' => $sacar

                    );

                if($material['sacar'] <= 0 ){
                

                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?sacar1=true');
                    return;
                }

                if($material['sacar'] > $material['stock'] ){
                

                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?stock1=true');
                    return;
                }


                $_SESSION['CARRITOMATERIAL'][0] = $material;
                header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?ingresado1=true');


            }else{

                $idMaterial = array_column($_SESSION['CARRITOMATERIAL'],'id');

                if(in_array($id, $idMaterial)){


                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?repetido1=true');
                    return;

                }else{
                    $numeroMateriales = count($_SESSION['CARRITOMATERIAL']);
                    $material = array(
    
                        
                        'id' => $id,
                        'nombre' => $nombre,
                        'codigo' => $codigo,
                        'stock' => $stock, 
                        'sacar' => $sacar
    
                    );

                    if($material['sacar'] <= 0 ){
                

                        header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?sacar1=true');
                        return;
                    }

                    if($material['sacar'] > $material['stock']){

                        header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?stock1=true');
                        return;

                    }

                    array_push($_SESSION['CARRITOMATERIAL'], $material);
                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?ingresado1=true');
    
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

            case 'EliminarMaterial':

                if(is_numeric($_POST['id'])){

                    $id = $_POST['id'];

                    foreach($_SESSION['CARRITOMATERIAL'] AS $indice => $material){

                        if($material['id']==$id){
                            unset($_SESSION['CARRITOMATERIAL'][$indice]);
                            header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?eliminado1=true');
                        }
                    }
                }
            break;


            case 'Guardar':

                if(!empty($_SESSION['CARRITOMATERIAL']) || !empty($_SESSION['CARRITO'])){

                    if(!empty($_POST['depa']) && !empty($_POST['personal'])){

                        $idSolicitante = $_POST['personal'];
                        $idDepa = $_POST['depa'];
                        $estadoSolicitud = "Pendiente";
                        //$fecha = date('d/m/Y');


                        $queryInsertSoli = "INSERT solicitudes_arriendo_retiro (codSolicitud,  idSolicitante, idDepaSolicitante,estadoSolicitud) 
                        VALUES('1', '${idSolicitante}', '${idDepa}', '${estadoSolicitud}')";

                        $resInsertSoli = mysqli_query($conexion, $queryInsertSoli);

                        // var_dump($queryInsertSoli);
                        // exit;

                        $idSoli = mysqli_insert_id($conexion);

                        if ($idSoli < 10) {
                            $solicitudReferente = "000" . $idSoli;
                        } else if ($idSoli > 9 && $idSoli < 100) {
                            $solicitudReferente = "00" . $idSoli;
                        } else if ($idSoli > 99 && $idSoli < 1000) {
                            $solicitudReferente = "0" . $idSoli;
                        } else if ($idSoli > 999) {
                            $solicitudReferente = $idSoli;
                        } else {
                            $solicitudReferente = $idSoli;
                        }

                        $numeroRes = "NS-" . $solicitudReferente ;

                        $queryUpdateSoli = "UPDATE solicitudes_arriendo_retiro SET codSolicitud = '${numeroRes}' WHERE idSoli = ${idSoli}";
                        $resUpdateSoli = mysqli_query($conexion, $queryUpdateSoli);

                        if(!empty($_SESSION['CARRITOMATERIAL'])){
                            foreach($_SESSION['CARRITOMATERIAL'] AS $indice => $material){
    
                                $codigo = $material['codigo'];
                                $nombre = $material['nombre'];
                                $cantidad = $material['sacar'];
                                $stock = $material['stock'];
                                $idMaterial = $material['id'];
    
                                $resta = $stock - $cantidad;
    
    
                                $queryInsertMate = "INSERT INTO material_retirado(codMaterial, nomMaterial  ,cantidadMaterial,idSolicitud,idMaterial)
                                VALUES ($codigo, '$nombre',$cantidad, $idSoli, $idMaterial)";
                                $resInsertMate = mysqli_query($conexion, $queryInsertMate);
    
                                $queryUpdateMate = "UPDATE pañol_materiales SET cantMaterial = '${resta}' WHERE idMaterial = '${idMaterial}'";
                                $resUpdateMate = mysqli_query($conexion, $queryUpdateMate);
    
                                unset($_SESSION['CARRITOMATERIAL'][$indice]);
                            }
    
                            if($resInsertMate){
                                header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?guardado=true');
                            }
                        }
    
                        if(!empty($_SESSION['CARRITO'])){
                            foreach($_SESSION['CARRITO'] AS $indice => $herramienta){
    
                                $codigo = $herramienta['codigo'];
                                $nombre = $herramienta['nombre'];
                                $cantidad = $herramienta['sacar'];
                                $stock = $herramienta['stock'];
                                $idHerramienta = $herramienta['id'];
    
                                $resta = $stock - $cantidad;
    
    
                                $queryInsert = "INSERT INTO herra_en_arriendo(codHerramienta, nomHerramienta  ,cantidadHerramienta,idSolicitud,idHerramienta)
                                VALUES ($codigo, '$nombre' ,$cantidad, $idSoli, $idHerramienta)";
                                $resInsert = mysqli_query($conexion, $queryInsert);
    
                                $queryUpdate = "UPDATE pañol_herramientas SET cantHerramienta = '${resta}' WHERE idHerramienta = '${idHerramienta}'";
                                $resUpdate = mysqli_query($conexion, $queryUpdate);
    
                                unset($_SESSION['CARRITO'][$indice]);
                            }
    
                            if($resInsert){
                                header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?guardado=true');
                            }
                        } 
                    }else{
                        header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?vaciopersona=true');

                    }
                }else{
                    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/arriendo-retiro-ticket.php?vacios=true');

                }


            break;
        }
    }