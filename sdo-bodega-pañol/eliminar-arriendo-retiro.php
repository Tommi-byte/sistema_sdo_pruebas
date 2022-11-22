<?php
include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $idSoli = $_POST['idSoli'];
    $codigo = $_POST['codigo'];
    $idDepa  = $_POST['idDepartamento'];
    $idSolicitante = $_POST['idSolicitante'];
    $fechaIngreso = $_POST['fechaIngreso'];

    // var_dump($fechaIngreso);
    // exit;



    //para ingresar los datos a tabla historial


    $selectHerra = "SELECT * FROM herra_en_arriendo WHERE idSolicitud = ${idSoli}";
    $resSelectHerra = mysqli_query($conexion, $selectHerra);


    foreach($resSelectHerra as $indice => $herramienta){

        $cantidadSacar = $herramienta['cantidadHerramienta'];
        $idHerramienta = $herramienta['idHerramienta'];
        $stockActual = $herramienta['stockActual'];

        //$nuevaCantidad = $stockActual +  $cantidadSacar;

        $herra = "SELECT * FROM pañol_herramientas WHERE idHerramienta = ${idHerramienta}";
        $resHerra = mysqli_query($conexion, $herra);

        while($row = $resHerra->fetch_assoc()){

            $cantidadActual = $row['cantHerramienta'];

        }

        $nuevaCantidad = $cantidadActual + $cantidadSacar;

        $updateHerra = "UPDATE pañol_herramientas SET cantHerramienta = ${nuevaCantidad} WHERE idHerramienta = ${idHerramienta}";
        $res = mysqli_query($conexion, $updateHerra);

        ?>
            <input type="text" value="<?php echo $herramienta['idHerramienta']?>">
        <?php

        if($res){

            $estadoSolicitud = "ELIMINADA";

            $insertHistorial = "INSERT INTO solicitudes_arriendo_retiro_finalizadas (idSoli,codSolicitud, fechaSolicitud, idSolicitante,idDepaSolicitante ,estadoSolicitud)  
            VALUES ('". $idSoli . "','". $codigo . "','". $fechaIngreso . "', '". $idSolicitante . "','". $idDepa . "','". $estadoSolicitud . "')";       
            $res1 = mysqli_query($conexion, $insertHistorial);


            $queryEliminar = "DELETE FROM solicitudes_arriendo_retiro WHERE idSoli = ${idSoli}";
            $resQueryEliminar = mysqli_query($conexion, $queryEliminar);


        }else{
            header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/listado-soli-ticket.php?errorEliminar=true');
        }

      
   
    }


    header('Location: /TrabajarSDO_Pruebas/sdo-bodega-pañol/listado-soli-ticket.php?eliminado=true');
    

  

}