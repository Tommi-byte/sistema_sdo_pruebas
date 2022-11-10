<?php

include '../../sdo-funciones/conexion.php';
include '../../sdo-funciones/funciones.php';

if (isset($_POST['idCategoria'])) {

    $idCategoria = trim($_POST['idCategoria']);

    $cadena = '';

    if ($idCategoria == "Otro" || $idCategoria == "otro") {

        $cadena .= '<label for="exampleNomServicio">Agregar Categoria:</label>';
        $cadena .= '<div class="input-group mb-3">';
        $cadena .= '<div class="input-group-prepend">';
        $cadena .= '<span class="input-group-text"><i class="fas fa-server"></i></span>';
        $cadena .= '</div>';
        $cadena .= '<input type="text" style="text-transform:capitalize" class="form-control" id="OtroCategoria" name="OtroCategoria" placeholder="Nombre Categoria">';
        $cadena .= '</div>';


    } else {
    }

    echo $cadena;
}
