<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (isset($_POST['idBitacora'], $_POST['modObservacionBitacora'], $_POST['subcategoriaModificar'])) {

    $idBitacora = $_POST['idBitacora'];
    $modObservacionBitacora = $_POST['modObservacionBitacora'];
    $subcategoriaModificar = $_POST['subcategoriaModificar'];

    if (!empty($modObservacionBitacora)) {

        $modObservacionBitacora = str_replace("'", "\'", $modObservacionBitacora);
    }

    if ($idBitacora > 0) {

        if ($idBitacora == '' || empty($idBitacora) || $modObservacionBitacora == '' || empty($modObservacionBitacora) || $subcategoriaModificar == '' || empty($subcategoriaModificar)) {
            header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorModificarObservacion=true');
        } else {

            $queryModificar = "UPDATE bitacora SET observacionBitacora = '" . $modObservacionBitacora . "', idSubcategoria = '" . $subcategoriaModificar . "' WHERE idBitacora = " . $idBitacora;

            $resModificar = mysqli_query($conexion, $queryModificar);

            if ($resModificar) {
                header('Location: ../sdo-jefestecnicos/bitacora-listado.php?exitoModificarObservacion=true');
            } else {
                header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorModificarObservacion=true');
            }
        }
    } else {
        header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorModificarObservacion=true');
    }
} else {
    header('Location: ../sdo-jefestecnicos/bitacora-listado.php?errorModificarObservacion=true');
}
