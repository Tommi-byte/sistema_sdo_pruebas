<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('funciones.php');
include_once('conexion.php');


if (isset($_POST['addNomEquipo'], $_POST['categoriaAgregar'])) {

    $addNomEquipo = trim($_POST['addNomEquipo']);
    $categoriaAgregar = $_POST['categoriaAgregar'];

    if(!empty($addNomEquipo) && !empty($categoriaAgregar) && $categoriaAgregar > 0){

        $existeEquipo = existeEquipo($addNomEquipo,$categoriaAgregar);

        // echo $existeEquipo;

        // echo '<br><br>';

        // echo $addNomEquipo;

        // echo '<br><br>';

        // echo $categoriaAgregar;

        // echo '<br><br>';
        if($existeEquipo == 0){
            $query = "INSERT INTO equipos(idEquipo,nomEquipo,idSubCategoria,forzadoEquipo,forzadoEncendido,forzadoApagado,forzadoVariable,modoAutomatico)";
            $query .=  "VALUES (NULL,'" . $addNomEquipo . "','" . $categoriaAgregar . "',0,0,0,0,1)";
            $res = mysqli_query($conexion, $query);

            if ($res) {
                header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?exitoAgregarEquipo=true');
            } else {
                header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?errorAgregarEquipo=true');
            }
        }else{
            header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?existeEquipo=true');
        }
    }else{
        header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?errorAgregarEquipo=true');
    }

} else {
    header('Location: ../sdo-jefestecnicos/sistemas-visualizar.php?errorAgregarEquipo=true');
}

mysqli_close($conexion);
