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

            break;
        }
    }

}