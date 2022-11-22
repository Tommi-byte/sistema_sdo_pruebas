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
                header("Location: ../$ruta/soliCompra_administracion.php?errorCrearSC=true");
            } else {
                $argumentosNecesidad = str_replace("'", "\'", $argumentosNecesidad);
            }


            $querySC = "INSERT INTO solicitudes_compra_pm(idSoliCompra,numSoliCompra,folioSoliCompra,fechaSoliCompra,personalSoliCompra,unidadSoliCompra,emailSoliCompra,argumentosSoliCompra,adjuntaCotizacion,estadoSoliCompra)
            VALUES (NULL,0,'',NOW(),'" . $nomCreadorSC . "','" . $deptoSC . "','" . $emailSC . "','" . $argumentosNecesidad . "','0','Solicitada a Mesa de Ayuda')";

            $resSC = mysqli_query($conexion, $querySC);

            if ($resSC) {
                $idSolicitudCompra = mysqli_insert_id($conexion);

                $_SESSION['idSolicitudCompra'] = $idSolicitudCompra;


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

                                $queryMaterialSC = "INSERT INTO material_solicompra_pm(idMaterialSC,nomMaterialSC,cantidadMaterialSC,observacionMaterialSC,empresaMaterialSC,idSoliCompra)
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

                $folioSoliCompra = "SC-PM-" . $idSolicitudCompra . "-" . $iniciales;

                $queryUpdateSC = "UPDATE solicitudes_compra_pm SET folioSoliCompra = '" . $folioSoliCompra . "' WHERE idSoliCompra = '" . $idSolicitudCompra . "'";

                $resUpdateSC = mysqli_query($conexion, $queryUpdateSC);

                if ($resUpdateSC) {

                    $rutaCorrecta = "Location: ../".$ruta."/soliCompra_administracion.php?exitoCrearSC=true&material=" . $usoMaterial . "";

                    header($rutaCorrecta);
                } else {
                    $rutaSinFolio = "Location: ../".$ruta."/soliCompra_administracion.php?exitoCrearSC=true&material=" . $usoMaterial . "&sinFolio=true";

                    header($rutaSinFolio);
                }
            } else {
                header("Location: ../".$ruta."/soliCompra_administracion.php?errorCrearSC=true");
            }
        } else {
            header("Location: ../".$ruta."/soliCompra_administracion.php?errorCrearSC=true");
        }
    } else {
        header("Location: ../".$ruta."/soliCompra_administracion.php?errorCrearSC=true");
    }
} else {
    header("Location: ../".$ruta."/soliCompra_administracion.php?errorCrearSC=true");
}