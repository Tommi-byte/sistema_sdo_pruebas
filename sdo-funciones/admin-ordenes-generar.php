<?php

include_once 'conexion.php';
include_once 'funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['nomSolicitante'], $_POST['nomTecnicoRecepcionador'], $_POST['servicioOrden'], $_POST['departamentoSolicitante'], $_POST['recintoOrden'], $_POST['pmaOrden'], $_POST['coordenadasOrden'], $_POST['detalleTrabajo'], $_POST['comentariosTrabajos'], $_POST['fechaActualOrden'])) {

    $nomSolicitante = trim($_POST['nomSolicitante']);

    $nomTecnicoRecepcionador = trim($_POST['nomTecnicoRecepcionador']);

    $servicioOrden = trim($_POST['servicioOrden']);

    if ($servicioOrden == 0 || $servicioOrden == 'Otro' || $servicioOrden == 'otro') {
        if (isset($_POST['otroServicio'])) {

            $otroServicio = trim($_POST['otroServicio']);

            if (!empty($otroServicio)) {
                $otroServicio = str_replace("'", "\'", $otroServicio);

                $buscarServicio = buscarServicio($otroServicio);

                if($buscarServicio == 0){

                    $queryOtroServicio = "INSERT INTO servicios(idServicio,nomServicio) VALUES (NULL,'" . $otroServicio . "')";

                    // echo $queryOtroServicio;
    
                    $resOtroServicio = mysqli_query($conexion, $queryOtroServicio);
    
                    $servicioOrden = mysqli_insert_id($conexion);
                }else{
                    $servicioOrden = $buscarServicio;
                }

                
            } else {
            }
        } else {
        }
    }


    $recintoOrden = trim($_POST['recintoOrden']);
    $pmaOrden = trim($_POST['pmaOrden']);
    $coordenadasOrden = trim($_POST['coordenadasOrden']);
    $detalleTrabajo = trim($_POST['detalleTrabajo']);
    $comentariosTrabajos = trim($_POST['comentariosTrabajos']);
    $fechaActualOrden = $_POST['fechaActualOrden'];
    $departamentoSolicitante = trim($_POST['departamentoSolicitante']);
    $nomDepartamentoSolicitante = trim(getNomDepartamento($departamentoSolicitante));

    if (!empty($detalleTrabajo)) {

        $detalleTrabajo = str_replace("'", "\'", $detalleTrabajo);
    }

    if (!empty($comentariosTrabajos)) {

        $comentariosTrabajos = str_replace("'", "\'", $comentariosTrabajos);
    }

    if ($nomSolicitante == '' || $nomSolicitante == ' ' || empty($nomSolicitante) || $servicioOrden == '' || $servicioOrden == ' ' || empty($servicioOrden) || $recintoOrden == '' || $recintoOrden == ' ' || empty($recintoOrden)) {
        header('Location: ../sdo-administrador/ordenes-formulario.php?errorGenerar=true');
    } else {
        if ($pmaOrden == '' || $pmaOrden == ' ' || empty($pmaOrden) || $departamentoSolicitante == '' || $departamentoSolicitante == ' ' || empty($departamentoSolicitante) || $coordenadasOrden == '' || $coordenadasOrden == ' ' || empty($coordenadasOrden) || $detalleTrabajo == '' || $detalleTrabajo == ' ' || empty($detalleTrabajo)) {
            header('Location: ../sdo-administrador/ordenes-formulario.php?errorGenerar=true');
        } else {

            $queryOrden = "INSERT INTO ordenes_trabajos(idOrden,fechaOrden,nomSolicitante,nomTecnicoRecepcionador,idDepartamento,servicioOrden,recintoOrden,pmaOrden,coordenadasOrden,detalleTrabajo, comentariosTrabajos)
            VALUES (NULL,NOW(),'" . $nomSolicitante . "','" . $nomTecnicoRecepcionador . "','" . $departamentoSolicitante . "','" . $servicioOrden . "','" . $recintoOrden . "','" . $pmaOrden . "','" . $coordenadasOrden . "','" . $detalleTrabajo . "','" . $comentariosTrabajos . "')";

            // echo $queryOrden;
            $resOrden = mysqli_query($conexion, $queryOrden);

            if ($resOrden) {
                $idOrden = mysqli_insert_id($conexion);

                $_SESSION['idOrden'] = $idOrden;

                $pieces = explode(" ", $nomDepartamentoSolicitante);
                $str = "";
                foreach ($pieces as $piece) {
                    $str .= mb_strtoupper($piece[0], 'UTF-8');
                }

                $folioOrden = "HBQP-RT-" . $str . '-' . $idOrden;

                $nomOrden = "Recepcion de Trabajo: " . $folioOrden . ' - ' . $fechaActualOrden;

                $idSubDepartamento = '';

                if (isset($_POST['idSubDepartamento'])) {
                    $idSubDepartamento = trim($_POST['idSubDepartamento']);

                    if ($idSubDepartamento < 1 || empty($idSubDepartamento) || $idSubDepartamento == '') {

                        $idSubDepartamento = 0;
                    } else {
                        $idSubDepartamento = trim($_POST['idSubDepartamento']);
                    }
                } else {
                    $idSubDepartamento = 0;
                }

                $queryFolio = "UPDATE ordenes_trabajos SET folioOrden = '" . $folioOrden . "', nomOrden = '" . $nomOrden . "', idSubDepartamento = '" . $idSubDepartamento . "' WHERE idOrden =" . $idOrden;

                $resFolio = mysqli_query($conexion, $queryFolio);

                if ($resFolio) {

                    $usoMaterial = '';

                    $usoFoto = '';

                    if (isset($_POST['materialUsado'], $_POST['unidad'], $_POST['cantidad'])) {

                        $materialUsado = $_POST['materialUsado'];
                        $unidad = $_POST['unidad'];
                        $cantidad = $_POST['cantidad'];

                        if (!empty($materialUsado) && !empty($unidad) && !empty($cantidad)) {

                            for ($i = 0; $i < count($materialUsado); $i++) {
                                if (!empty($materialUsado[$i])) {
                                    $materialFor = $materialUsado[$i];
                                    $unidadFor = $unidad[$i];
                                    $cantidadFor = $cantidad[$i];

                                    $queryMaterial = "INSERT INTO material_orden(idMaterial,nomMaterial,unidadMaterial,cantidadMaterial,idOrden)
                                    VALUES(NULL,'" . $materialFor . "','" . $unidadFor . "','" . $cantidadFor . "'," . $idOrden . ")";

                                    $resMaterial = mysqli_query($conexion, $queryMaterial);

                                    if ($resMaterial) {
                                        $_SESSION['usoMaterial'] = 'Usando';
                                    } else {
                                        $_SESSION['usoMaterial'] = 'Vacio';
                                    }
                                } else {
                                    $_SESSION['usoMaterial'] = 'Vacio';
                                }
                            }
                        } else {
                            $_SESSION['usoMaterial'] = 'Vacio';
                        }
                    } else {
                        $_SESSION['usoMaterial'] = 'Vacio';
                    }

                    if (isset($_FILES["archivoImagenOrden"])) {
                        $tot = count($_FILES["archivoImagenOrden"]["name"]);
                        for ($i = 0; $i < $tot; $i++) {
                            $tmp_name = $_FILES["archivoImagenOrden"]["tmp_name"][$i];
                            $name = $_FILES["archivoImagenOrden"]["name"][$i];

                            if ($tmp_name == '' || $tmp_name == ' ' || empty($tmp_name)) {
                                $_SESSION['usoFoto'] = 'Vacio';
                                header('Location: ../sdo-funciones/admin-firmarOrdenTrabajo.php');
                                // if ($usoMaterial == 'Vacio') {
                                //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenSinFotoSinMaterial=true');
                                // } else if ($usoMaterial == 'Usando') {
                                //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenSinFotoConMaterial=true');
                                // } else {
                                //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenSinFotoSinMaterial=true');
                                // }
                            } else {

                                $directorio = "../sdo-archivos/O" . $idOrden . "/";

                                if (!file_exists($directorio)) {
                                    mkdir($directorio, 0777);
                                }

                                $dir = opendir($directorio);

                                $ruta = $directorio . $name;

                                $separarNombre = explode(".", $name);

                                $extImagen = end($separarNombre);

                                $extImagen = mb_strtolower($extImagen);


                                if ($extImagen == "jpg" || $extImagen == "png" || $extImagen == "jpeg" || $extImagen == "bmp" || $extImagen == "tif" || $extImagen == "webp" || $extImagen == "svg" || $extImagen == "jfif") {

                                    // if (is_dir($directorio) && is_writable($directorio)) {
                                    //     echo 'hola';
                                    // } else {
                                    //     echo 'Upload directory is not writable, or does not exist.';
                                    // }

                                    if (move_uploaded_file($tmp_name, $ruta)) {

                                        $queryImagen = "INSERT INTO imagenes(idImagen,nomImagen,extImagen,rutaImagen,idReporte,idOrden) VALUES (NULL,'" . $name . "','" . $extImagen . "','" . $ruta . "',0,'" . $idOrden . "')";

                                        $resImagen = mysqli_query($conexion, $queryImagen);

                                        if ($resImagen) {
                                            $_SESSION['usoFoto'] = 'Usando';
                                            header('Location: ../sdo-funciones/admin-firmarOrdenTrabajo.php');
                                            
                                            // if ($usoMaterial == 'Vacio') {

                                            //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenConFotoSinMaterial=true');
                                            // } else if ($usoMaterial == 'Usando') {
                                            //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenConFotoConMaterial=true');
                                            // } else {
                                            //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenConFotoSinMaterial=true');
                                            // }
                                        } else {

                                            $_SESSION['usoFoto'] = 'Error';
                                            header('Location: ../sdo-funciones/admin-firmarOrdenTrabajo.php');
                                            // if ($usoMaterial == 'Vacio') {
                                            //     header('Location: ../sdo-administrador/ordenes-administrar.php?errorCargaFotoSinMaterial=true');
                                            // } else if ($usoMaterial == 'Usando') {
                                            //     header('Location: ../sdo-administrador/ordenes-administrar.php?errorCargaFotoConMaterial=true');
                                            // } else {
                                            //     header('Location: ../sdo-administrador/ordenes-administrar.php?errorCargaFotoSinMaterial=true');
                                            // }
                                        }
                                    } else {
                                        $_SESSION['usoFoto'] = 'Error';
                                        header('Location: ../sdo-funciones/admin-firmarOrdenTrabajo.php');
                                        // if ($usoMaterial == 'Vacio') {
                                        //     header('Location: ../sdo-administrador/ordenes-administrar.php?errorCargaFotoSinMaterial=true');
                                        // } else if ($usoMaterial == 'Usando') {
                                        //     header('Location: ../sdo-administrador/ordenes-administrar.php?errorCargaFotoConMaterial=true');
                                        // } else {
                                        //     header('Location: ../sdo-administrador/ordenes-administrar.php?errorCargaFotoSinMaterial=true');
                                        // }
                                    }
                                } else {
                                    $_SESSION['usoFoto'] = 'formatoIncorrecto';
                                    header('Location: ../sdo-funciones/admin-firmarOrdenTrabajo.php');
                                    // if ($usoMaterial == 'Vacio') {
                                    //     header('Location: ../sdo-administrador/ordenes-administrar.php?formatoIncorrectoFotoSinMaterial=true');
                                    // } else if ($usoMaterial == 'Usando') {
                                    //     header('Location: ../sdo-administrador/ordenes-administrar.php?formatoIncorrectoFotoConMaterial=true');
                                    // } else {
                                    //     header('Location: ../sdo-administrador/ordenes-administrar.php?formatoIncorrectoFotoSinMaterial=true');
                                    // }
                                }
                            }
                        }
                    } else {
                        $_SESSION['usoFoto'] = 'Vacio';
                        header('Location: ../sdo-funciones/admin-firmarOrdenTrabajo.php');
                        // if ($usoMaterial == 'Vacio') {
                        //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenSinFotoSinMaterial=true');
                        // } else if ($usoMaterial == 'Usando') {
                        //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenSinFotoConMaterial=true');
                        // } else {
                        //     header('Location: ../sdo-administrador/ordenes-administrar.php?ordenSinFotoSinMaterial=true');
                        // }
                    }
                } else {
                    // $queryBorrar = "DELETE FROM ordenes_trabajos WHERE idOrden = " . $idOrden;
                    header('Location: ../sdo-administrador/ordenes-administrar.php?errorFolio=true');
                }
            } else {
                header('Location: ../sdo-administrador/ordenes-formulario.php?errorGenerar=true');
            }
        }
    }
} else {
    header('Location: ../sdo-administrador/ordenes-formulario.php?errorGenerar=true');
}
