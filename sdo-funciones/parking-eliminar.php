<?php

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if(isset($_POST['idParking'])){

    $idParking = trim($_POST['idParking']);

    $cadena = '';

    if(!empty($idParking)){
        
        $queryBorrar = "DELETE FROM parking WHERE idParking=".$idParking;

        if(mysqli_query($conexion, $queryBorrar)){

            $cadena .= '<br>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fa fa-check"></i>&nbsp;Parking Eliminado con Exito.</h5>
            </div>';

        }else{
            $cadena .= '<br>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fa fa-exclamation-triangle"></i>&nbsp;Error al Eliminar Parking. Reintente.</h5>
            </div>';
        }

    }else{
        $cadena .= '<br>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="fa fa-exclamation-triangle"></i>&nbsp;Error al Eliminar Parking. Reintente.</h5>
        </div>';
    }

    echo $cadena;

}else{
    echo '<br>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="fa fa-exclamation-triangle"></i>&nbsp;Error al Eliminar Parking. Reintente.</h5>
    </div>';
}
