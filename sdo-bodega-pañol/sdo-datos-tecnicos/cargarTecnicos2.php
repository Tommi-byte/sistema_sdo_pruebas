<?php

include '../../sdo-funciones/conexion.php';
include '../../sdo-funciones/funciones.php';

if (isset($_POST['idDepartamento'])) {

    $idDepartamento = trim($_POST['idDepartamento']);

    $cadena = '';

    if (!empty($_POST['idDepartamento'])) {

        $contarPersonal = contarJefe($idDepartamento);

        if ($contarPersonal > 0) {
            $queryPersonal = "SELECT idJefe, nomJefe, cargoJefe FROM jefes_tecnicos WHERE idDepartamento = '" . $idDepartamento . "'";

            $resPersonal = mysqli_query($conexion, $queryPersonal);


            $cadena = $cadena . '<div class="input-group-prepend">';

            $cadena = $cadena . '<span class="input-group-text"><i class="fas fa-user"></i></span>';

            $cadena = $cadena . '<select id="nomTecnicoRecepcionador" class="form-control" name="nomTecnicoRecepcionador">';

            while ($rowPersonal = mysqli_fetch_array($resPersonal)) {
                $cadena = $cadena . '<option id="idOptionTecnicoAdmin" value="' . $rowPersonal[0] . '">' . $rowPersonal[1] .  '' . "  -  " . '' . $rowPersonal[2] . '</option>';
            }

            $cadena = $cadena . '</select>';

            $cadena = $cadena . '</div>';
        } else {
            $cadena = $cadena . '0';
        }
    } else {
        $cadena = $cadena . 'Error';
    }



    echo $cadena;
}
