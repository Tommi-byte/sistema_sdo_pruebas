<?php

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$rolUsuario = $_SESSION['rolUsuario'];

$nomCreador = $_SESSION['nomUsuario'];

$rolUsuario2 = strtolower($rolUsuario);

$ruta = "";

if ($rolUsuario2 == "personal") {

    $ruta = "sdo-personal";
} else if ($rolUsuario2 == "administrativo") {

    $ruta = "sdo-admtec";
} else if ($rolUsuario2 == "jefe tecnico") {

    $ruta = "sdo-jefestecnicos";
} else if ($rolUsuario2 == "administrador") {

    $ruta = "sdo-administrador";

    $cargoUsuario = $_SESSION['cargoUsuario'];

    $cargoUsuario = trim($cargoUsuario);

    if(empty($cargoUsuario)){
        header('Location: ../sdo-flujo/login.php?errorSesion=true');
    }
} else if ($rolUsuario2 == "mesa ayuda") {
    $ruta = "sdo-mesa-ayuda";
} else {
    header('Location: ../sdo-flujo/login.php?errorSesion=true');
}

if (isset($_POST['idSolicitudSoporte'])) {

    $idSolicitudSoporte = trim($_POST['idSolicitudSoporte']);

    if ($idSolicitudSoporte !== 0) {

        if (isset($_POST['personalSC'], $_POST['cargoSC'], $_POST['deptoSC'])) {

            $personalSC = trim($_POST['personalSC']);
            $cargoSC = trim($_POST['cargoSC']);
            $deptoSC = trim($_POST['deptoSC']);
            $emailSC = trim($_POST['emailSC']);

            $archivoCotizacion = '';

            if ($rolUsuario2 == "administrador") {
                $nomCreadorSC = $personalSC;
        
                $deptoSC = $cargoSC;
            }else{
                $nomCreadorSC = $personalSC . ' (' . $cargoSC . ')';
            }

            if (!empty($personalSC) && !empty($cargoSC) && !empty($deptoSC) && !empty($emailSC)) {

                if (isset($_POST['argumentosNecesidad'])) {

                    $argumentosNecesidad = $_POST['argumentosNecesidad'];

                    if ($argumentosNecesidad == '' || $argumentosNecesidad == ' ') {
                        header("Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?errorCrearSC=true");
                    } else {
                        $argumentosNecesidad = str_replace("'", "\'", $argumentosNecesidad);
                    }

                    // $chkboxCotizacion = "";

                    // if (isset($_POST['customCheckbox1'])) {
                    //     $chkboxCotizacion = $_POST['customCheckbox1'];

                    //     if ($chkboxCotizacion == 1 || $chkboxCotizacion == 0) {
                    //     } else {
                    //         $chkboxCotizacion = "0";
                    //     }
                    // } else {
                    //     $chkboxCotizacion = "0";
                    // }

                    $querySC = "INSERT INTO solicitudes_compra_tickets_pm(idSoliCompra,numSoliCompra,folioSoliCompra,fechaSoliCompra,personalSoliCompra,unidadSoliCompra,emailSoliCompra,argumentosSoliCompra,adjuntaCotizacion,estadoSoliCompra,idSolicitudSoporte)
                    VALUES (NULL,0,'',NOW(),'" . $nomCreadorSC . "','" . $deptoSC . "','" . $emailSC . "','" . $argumentosNecesidad . "','0','Solicitada a Mesa de Ayuda','" . $idSolicitudSoporte . "')";

                    $resSC = mysqli_query($conexion, $querySC);

                    if ($resSC) {
                        $idSolicitudCompra = mysqli_insert_id($conexion);

                        $_SESSION['idSolicitudCompra'] = $idSolicitudCompra;

                        // if (isset($_FILES["archivoImagenOrden"])) {

                        //     $count = 0;
                        //     foreach ($_FILES['archivoImagenOrden']['tmp_name'] as $tmpFilee) {
                        //         if (is_uploaded_file($tmpFilee)) {
                        //             $count++;
                        //         }
                        //     }


                        //     if ($count > 0) {
                        //         $queryCotizacion1 = "UPDATE solicitudes_compra_tickets_pm SET adjuntaCotizacion = '1' WHERE idSoliCompra =" . $idSolicitudCompra;

                        //         $resCotizacion1 = mysqli_query($conexion, $queryCotizacion1);

                        //         if ($resCotizacion1) {
                        //             for ($i = 0; $i < $count; $i++) {
                        //                 $tmp_name = $_FILES["archivoImagenOrden"]["tmp_name"][$i];
                        //                 $name = $_FILES["archivoImagenOrden"]["name"][$i];

                        //                 if ($tmp_name == '' || $tmp_name == ' ' || empty($tmp_name)) {
                        //                     $archivoCotizacion = "Vacio";
                        //                 } else {

                        //                     $directorio = "../sdo-solicCompra/SC-" . $idSolicitudCompra . "/";

                        //                     if (!file_exists($directorio)) {
                        //                         mkdir($directorio, 0777);
                        //                     }

                        //                     $dir = opendir($directorio);

                        //                     $ruta = $directorio . $name;

                        //                     $separarNombre = explode(".", $name);

                        //                     $extImagen = end($separarNombre);

                        //                     $extImagen = mb_strtolower($extImagen);


                        //                     if ($extImagen == "pdf" || $extImagen == "doc" || $extImagen == "docx" || $extImagen == "xls" || $extImagen == "xlsx") {

                        //                         if (move_uploaded_file($tmp_name, $ruta)) {

                        //                             chmod($ruta, 0777);

                        //                             $queryCotizacion = "INSERT INTO cotizacion_solicompra(idCotizacionSC,nomCotizacionSC,rutaCotizacionSC,idSoliCompra) VALUES (NULL,'" . $name . "','" . $ruta . "','" . $idSolicitudCompra . "')";

                        //                             $resCotizacion = mysqli_query($conexion, $queryCotizacion);

                        //                             if ($resCotizacion) {
                        //                                 $archivoCotizacion = 'Usando';
                        //                             } else {

                        //                                 $archivoCotizacion = 'Error';
                        //                             }
                        //                         } else {
                        //                             $archivoCotizacion = 'Error';
                        //                         }
                        //                     } else {
                        //                         $archivoCotizacion = 'formatoIncorrecto';
                        //                     }
                        //                 }
                        //             }
                        //         } else {
                        //             $archivoCotizacion = "Vacio";
                        //         }
                        //     } else {
                        //         $archivoCotizacion = "Vacio";
                        //     }
                        // } else {
                        //     $archivoCotizacion = "Vacio";
                        // }


                        echo '<br><br>';

                        if (isset($_POST['materialSC'], $_POST['cantidadSC'], $_POST['observacionSC'], $_POST['empresaSC'])) {

                            $materialSC = $_POST['materialSC'];
                            $cantidadSC = $_POST['cantidadSC'];
                            $observacionSC = $_POST['observacionSC'];
                            $empresaSC = $_POST['empresaSC'];

                            if (!empty($materialSC) && !empty($cantidadSC) && $cantidadSC > 0) {

                                for ($i = 0; $i < count($materialSC); $i++) {
                                    if (!empty($materialSC[$i])) {
                                        $materialSCFor = $materialSC[$i];
                                        $cantidadSCFor = $cantidadSC[$i];
                                        $observacionSCFor = $observacionSC[$i];
                                        $empresaSCFor = $empresaSC[$i];

                                        $queryMaterialSC = "INSERT INTO material_solicompra_tickets_pm(idMaterialSC,nomMaterialSC,cantidadMaterialSC,observacionMaterialSC,empresaMaterialSC,idSoliCompra)
                                        VALUES(NULL,'" . $materialSCFor . "','" . $cantidadSCFor . "','" . $observacionSCFor . "','" . $empresaSCFor . "'," . $idSolicitudCompra . ")";

                                        $resMaterialSC = mysqli_query($conexion, $queryMaterialSC);

                                        if ($resMaterialSC) {
                                            $usoMaterial = "Con";
                                        } else {
                                            $usoMaterial = "Sin";
                                        }

                                        // echo $queryMaterialSC;
                                    } else {
                                        $usoMaterial = "Sin";
                                    }
                                }
                            } else {
                                $usoMaterial = "Sin";
                            }
                        } else {
                            $usoMaterial = "Sin";
                        }

                        if ($usoMaterial == "Con") {
                            echo "Creado Con Material!";
                        } else {
                            echo "Creado Sin Material!";
                        }

                        if ($idSolicitudCompra < 10) {
                            $idSolicitudCompra = "000" . $idSolicitudCompra;
                        } else if ($idSolicitudCompra > 9 && $idSolicitudCompra < 100) {
                            $idSolicitudCompra = "00" . $idSolicitudCompra;
                        } else if ($idSolicitudCompra > 99 && $idSolicitudCompra < 1000) {
                            $idSolicitudCompra = "0" . $idSolicitudCompra;
                        } else if ($idSolicitudCompra > 999) {
                            $idSolicitudCompra = $idSolicitudCompra;
                        } else {
                            $idSolicitudCompra = $idSolicitudCompra;
                        }

                        $iniciales = getIniciales($personalSC);

                        $folioSoliCompra = "SC-T" . $idSolicitudSoporte . "-" . $idSolicitudCompra . "-" . $iniciales;

                        $queryUpdateSC = "UPDATE solicitudes_compra_tickets_pm SET folioSoliCompra = '" . $folioSoliCompra . "' WHERE idSoliCompra = '" . $idSolicitudCompra . "'";

                        $resUpdateSC = mysqli_query($conexion, $queryUpdateSC);

                        if ($resUpdateSC) {

                            $queryUpdateSituacion = "UPDATE solicitudes_soportes SET situacionSolicitud = 'Este Ticket de Soporte cuenta con una Solicitud de Compra pendiente.' WHERE idSolicitud = '" . $idSolicitudSoporte . "'";

                            $resUpdateSituacion = mysqli_query($conexion, $queryUpdateSituacion);

                            if ($resUpdateSituacion) {

                                $rutaCorrecta = "Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?exitoCrearSC=true&material=" . $usoMaterial . "";
    
                                header($rutaCorrecta);
                            } else {
                                $rutaSinFolio = "Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?exitoCrearSC=true&material=" . $usoMaterial . "&sinFolio=true";
    
                                header($rutaSinFolio);
                            }

                        } else {
                            $rutaSinFolio = "Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?exitoCrearSC=true&material=" . $usoMaterial . "&sinFolio=true";

                            header($rutaSinFolio);
                        }
                    } else {
                        header("Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?errorCrearSC=true");
                    }
                } else {
                    header("Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?errorCrearSC=true");
                }
            } else {
                header("Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?errorCrearSC=true");
            }
        } else {
            header("Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?errorCrearSC=true");
        }
    } else {
        header("Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?errorCrearSC=true");
    }
} else {
    header("Location: ../sdo-jefestecnicos/tickets_solicitarCompras_pm.php?errorCrearSC=true");
}
