<?php

include '../../sdo-funciones/conexion.php';
include '../../sdo-funciones/funciones.php';

if (isset($_POST['idCategoria'])) {

    $idCategoria = trim($_POST['idCategoria']);

    $cadena = '';

    if ($idCategoria == "Otro" || $idCategoria == "otro") {

        ?>

            <label for="exampleInputNomTarjeta">Cambia Categoria:<code></code></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                    <select id="categoriaOrden" class="form-control" name="idCategoria">
                                                                
                        <?php

                            $queryCategorias = "SELECT * FROM categorias_herramienta  ORDER BY nomCategoria ASC";

                            $resCategorias = mysqli_query($conexion, $queryCategorias);

                                while ($rowCategorias = $resCategorias->fetch_assoc()) {

                                    if($rowCategorias){

                                            $datos1 = array();
                                            $datos1['idCategoria'] = $rowCategorias['idCategoria'];
                                            $datos1['nomCategoria'] = $rowCategorias['nomCategoria'];
                                                                        
                                            $idCategoria = $datos1['idCategoria'];
                                            $nomCategoria = $datos1['nomCategoria'];

                                    }
                                    ?>
                                    <option value="<?php echo $idCategoria?>">
                                        <?php echo $nomCategoria;?>
                                    </option>
                                                                <?php

                                                                }


                                                                ?>
                                                              
                    </select>
                                                        

                </div>

        <?php


    } else {
    }

    echo $cadena;
}
