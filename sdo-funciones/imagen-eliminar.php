<?php

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

// unlink('../sdo-archivos/O32/3.jpg');
// unlink('../sdo-archivos/O33/3 - copia.jpg');
// unlink('../sdo-archivos/O34/IMG 1.jfif');
// unlink('../sdo-archivos/O35/IMG 2.jpg');
// unlink('../sdo-archivos/O36/IMG 1.jfif');
// unlink('../sdo-archivos/O37/IMG 2.jpg');
// unlink('../sdo-archivos/O38/Captura 1.PNG');
// unlink('../sdo-archivos/O39/hospital3.jpg');
// unlink('../sdo-archivos/O4/hospital3.jpg');
// unlink('../sdo-archivos/O4/hospital4.jpg');


if(isset($_POST['idImagen'])){

    $idImagen = trim($_POST['idImagen']);

    $cadena = '';

    if(!empty($idImagen)){

        $rutaImagen = getRutaImagen($idImagen);
        
        $queryBorrar = "DELETE FROM imagenes WHERE idImagen=".$idImagen;

        if(mysqli_query($conexion, $queryBorrar)){

            
            
            $cadena .= '<br>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fa fa-check"></i>&nbsp;Imagen Eliminada con Exito.</h5>
            </div>';

            unlink($rutaImagen);
        }else{
            $cadena .= '<br>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fa fa-exclamation-triangle"></i>&nbsp;Error al Eliminar Imagen. Reintente.</h5>
            </div>';
        }

    }else{
        $cadena .= '<br>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="fa fa-exclamation-triangle"></i>&nbsp;Error al Eliminar Imagen. Reintente.</h5>
        </div>';
    }

    echo $cadena;

}
