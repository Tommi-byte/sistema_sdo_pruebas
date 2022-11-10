<?php

include '../../sdo-funciones/conexion.php';
include '../../sdo-funciones/funciones.php';

if (isset($_POST['idDepartamento'])) {

    $idDepartamento = trim($_POST['idDepartamento']);


    $cadena = '';

    if ($idDepartamento == "Otro" || $idDepartamento == "otro") {

        // $cadena .= '<label for="exampleNomServicio">Nuevo Departamento:</label>';
        // $cadena .= '<div class="input-group mb-3">';
        // $cadena .= '<div class="input-group-prepend">';
        // $cadena .= '<span class="input-group-text"><i class="fas fa-server"></i></span>';
        // $cadena .= '</div>';
        // $cadena .= '<input type="text" style="text-transform:capitalize" class="form-control" id="OtroDepartamento" name="OtroDepartamento" >';
        // $cadena .= '</div>';
        ?>

     
                <label for="exampleNomServicio">Nuevo Departamento:</label>
                
                <div class="input-group mb-6">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-server"></i></span>
                    </div>
                    <select class="form-control" id="nuevoDepartamento" name="nuevoDepartamento">

                        <?php 

                            $query = "SELECT * FROM departamentos ORDER BY nomDepartamento ASC";
                            $res = mysqli_query($conexion, $query);

                            
                            while($row = $res->fetch_assoc()){

                                $datos = [];
                                $datos['idDepartamento'] = $row['idDepartamento'];
                                $datos['nomDepartamento'] = $row['nomDepartamento'];

                                $idDepartamentoNuevo = $datos['idDepartamento'];
                                $nomDepartamento = $datos['nomDepartamento'];
                                ?>

                                    <option value="<?php echo $idDepartamentoNuevo ?>">
                                        <?php echo $nomDepartamento ?>
                                    </option>

                                    

                                        
                                <?php

                               
                            }
                            
                            ?>

                                
                            <?php
                        ?>
                    </select>

                    
                </div>
        <?php
    } else {
    }

        
}



