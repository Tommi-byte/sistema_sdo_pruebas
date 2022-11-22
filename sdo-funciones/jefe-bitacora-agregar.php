<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('funciones.php');
include_once('conexion.php');

if (isset($_POST['categoriaBitacora'], $_POST['observacionBitacora'], $_POST['tecnicoBitacora'])) {

    $categoriaBitacora = $_POST['categoriaBitacora'];
    $observacionBitacora = $_POST['observacionBitacora'];
    $tecnicoBitacora = $_POST['tecnicoBitacora'];

    if (!empty($observacionBitacora)) {

        $observacionBitacora = str_replace("'", "\'", $observacionBitacora);
    }


    if (!empty($categoriaBitacora) && !empty($observacionBitacora)  && !empty($tecnicoBitacora) && $categoriaBitacora > 0 && $tecnicoBitacora > 0) {

        $nomTecnico = getNomJefeTecnico($tecnicoBitacora) . ' (Jefe Tecnico)';

        $query = "INSERT INTO bitacora(idBitacora,observacionBitacora,fechaBitacora,tecnicoBitacora,idSubcategoria)";
        $query .=  "VALUES (NULL,'" . $observacionBitacora . "',NOW(),'" . $nomTecnico . "'," . $categoriaBitacora . ")";
        
        // echo $query;

        $res = mysqli_query($conexion, $query);

        if ($res) {
            header('Location: ../sdo-jefestecnicos/bitacora-listado.php?exitoAgregarObservacion=true');
        } else {
            header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorAgregarObservacion1=true');
        }
    } else {
        header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorAgregarObservacion2=true');
    }
} else {
    header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorAgregarObservacion3=true');
}

mysqli_close($conexion);
