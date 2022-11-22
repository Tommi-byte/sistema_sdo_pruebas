<?php

include 'conexion.php';

ini_set( 'upload_max_size' , '256M' );
ini_set( 'post_max_size', '256M');
ini_set( 'max_execution_time', '300' );

if(isset($_POST['idReporte'],$_POST['quedanVideos'])){

    $idReporte = trim($_POST['idReporte']);
    $quedanVideos = trim($_POST['quedanVideos']);

    if(!empty($idReporte) && !empty($quedanVideos)){

        if (isset($_FILES["archivoImagen"])) {
            $tot = count($_FILES["archivoImagen"]["name"]);

            if($tot > $quedanVideos || $tot == 0){
                header('Location: ../sdo-personal/reportes-listado.php?sobrepasoImagen=true');
            }else{
                for ($i = 0; $i < $tot; $i++) {
                    $tmp_name = $_FILES["archivoImagen"]["tmp_name"][$i];
                    $name = $_FILES["archivoImagen"]["name"][$i];
    
                    if ($tmp_name == '' || $tmp_name == ' ' || empty($tmp_name)) {
                        header('Location: ../sdo-personal/reportes-listado.php?reporteSinFoto=true');
                    } else {
    
                        $directorio = "../sdo-archivos/R".$idReporte."/";
    
                        if (!file_exists($directorio)) {
                            mkdir($directorio, 0777);
                        }
    
                        $dir = opendir($directorio);
    
                        $ruta = $directorio . $name;
    
                        $separarNombre = explode(".", $name);
    
                        $extImagen = end($separarNombre);                                
    
                        $extImagen = mb_strtolower($extImagen);
    
    
                        if ($extImagen == "jpg" || $extImagen == "png" || $extImagen == "jpeg" || $extImagen == "bmp" || $extImagen == "tif" || $extImagen == "webp" || $extImagen == "svg" || $extImagen == "jfif") {
    
                            if (move_uploaded_file($tmp_name, $ruta)) {
    
                                $queryImagen = "INSERT INTO imagenes(idImagen,nomImagen,extImagen,rutaImagen,idReporte,idOrden) VALUES (NULL,'" . $name . "','" . $extImagen . "','" . $ruta . "','" . $idReporte . "',0)";
    
                                $resImagen = mysqli_query($conexion, $queryImagen);
    
                                // echo $queryImagen;

                                // echo '<br><br>';

                                // var_dump($resImagen);

                                // echo '<br><br>';
                                if ($resImagen) {
                                    header('Location: ../sdo-personal/reportes-listado.php?reporteConFoto=true');
                                } else {
                                    header('Location: ../sdo-personal/reportes-listado.php?errorCargaFoto=true');
                                }
                            } else {
                                header('Location: ../sdo-personal/reportes-listado.php?errorCargaFoto=true');
                            }
                        } else {
    
                            header('Location: ../sdo-personal/reportes-listado.php?formatoIncorrectoFoto=true');
                        }
                    }
                }
            }

            
        } else {
        }

    }else{

    }

}else{

}
