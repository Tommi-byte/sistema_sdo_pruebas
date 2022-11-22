<?php
include_once('conexion.php');
include_once('funciones.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['nomTarjeta'], $_POST['rutTarjeta'], $_POST['calidadContractual'], $_POST['codigoTarjeta'], $_POST['unidadTarjeta'], $_POST['nomSolicitante'], $_POST['nomTecnicoTurno'], $_POST['numTelefono'])) {

    $nomTarjeta = trim($_POST['nomTarjeta']);

    $nomTarjeta = mb_convert_case($nomTarjeta, MB_CASE_LOWER, "UTF-8");
    $nomTarjeta = mb_convert_case($nomTarjeta, MB_CASE_TITLE, "UTF-8");

    $codigoTarjeta = trim($_POST['codigoTarjeta']);
    $rutTarjeta = trim($_POST['rutTarjeta']);
    $calidadContractual = trim($_POST['calidadContractual']);
    $numTelefono = trim($_POST['numTelefono']);

    while (strlen($rutTarjeta) < 9) {
        $rutTarjeta = "0" . $rutTarjeta;
    }

    $unidadTarjeta = trim($_POST['unidadTarjeta']);
    $nomTecnicoTurno = trim($_POST['nomTecnicoTurno']);
    $nomSolicitante = trim($_POST['nomSolicitante']);

    $nomSolicitante = mb_convert_case($nomSolicitante, MB_CASE_LOWER, "UTF-8");
    $nomSolicitante = mb_convert_case($nomSolicitante, MB_CASE_TITLE, "UTF-8");

    date_default_timezone_set('America/Santiago');

    if (!empty($nomTarjeta) && !empty($codigoTarjeta) && !empty($unidadTarjeta) && !empty($nomSolicitante) && !empty($nomTecnicoTurno) && !empty($numTelefono)) {

        $query = "INSERT INTO actas(idActa,fechaActa,folioActa,codigoTarjeta,nomTarjeta,rutTarjeta,unidadTarjeta,nomSolicitante,nomControlCentralizado,calidadContractual,numTelefono,tipoActa)";
        $query .=  "VALUES (NULL,NOW(),'','" . $codigoTarjeta . "','" . $nomTarjeta . "','" . $rutTarjeta . "','" . $unidadTarjeta . "','" . $nomSolicitante . "','" . $nomTecnicoTurno . "','" . $calidadContractual . "','" . $numTelefono . "','Activación')";
        $res = mysqli_query($conexion, $query);

        if ($res) {

            $idActa = mysqli_insert_id($conexion);

            $anio = date("Y");

            $mes = date("m");

            $folioActa = "A-" . $idActa . "-" . $codigoTarjeta;

            $queryFolio = "UPDATE actas SET folioActa = '" . $folioActa . "' WHERE idActa =" . $idActa;

            $resFolio = mysqli_query($conexion, $queryFolio);

            if ($resFolio) {

                if (isset($_POST['patente1'], $_POST['patente2'], $_POST['modelo1'], $_POST['modelo2'])) {

                    $patente1 = trim($_POST['patente1']);
                    $patente2 = trim($_POST['patente2']);
                    $modelo1 = trim($_POST['modelo1']);
                    $modelo2 = trim($_POST['modelo2']);

                    if (empty($patente1) || empty($modelo1)) {
                        header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActa=true&vehiculo1Vacio=true');
                    } else {
                        if (buscarPatente($patente1) == 0 || empty(buscarPatente($patente1))) {
                            $queryParking1 = "INSERT INTO parking(idParking,patenteParking,modeloParking,rutParking)";
                            $queryParking1 .=  "VALUES (NULL,'" . $patente1 . "','" . $modelo1 . "','" . $rutTarjeta . "')";
                            $resParking1 = mysqli_query($conexion, $queryParking1);

                            if ($resParking1) {
                                if (empty($patente2) || empty($modelo2)) {
                                    header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActa=true&soloVehiculo1=true');
                                } else {
                                    if (buscarPatente($patente2) == 0 || empty(buscarPatente($patente2))) {
                                        $queryParking2 = "INSERT INTO parking(idParking,patenteParking,modeloParking,rutParking)";
                                        $queryParking2 .=  "VALUES (NULL,'" . $patente2 . "','" . $modelo2 . "','" . $rutTarjeta . "')";
                                        $resParking2 = mysqli_query($conexion, $queryParking2);

                                        if ($resParking2) {
                                            header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActaVehiculo1y2=true');
                                        } else {
                                            header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActa=true&soloVehiculo1=true&errorVehiculo2=true');
                                        }
                                    } else {
                                        header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActa=true&soloVehiculo1=true&existePatente2=true');
                                    }
                                }
                            } else {
                                header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActa=true&errorVehiculo1=true');
                            }
                        } else {
                            header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActa=true&existePatente1=true');
                        }
                    }
                } else {
                    header('Location: ../sdo-admtec/actas-listado.php?exitoCrearActa=true&sinEstacionamiento=true');
                }
            } else {
                header('Location: ../sdo-admtec/actas-listado.php?errorCrearFolio=true');
            }
        } else {
            header('Location: ../sdo-admtec/actas-listado.php?errorCrearActa=true');
        }
    } else {
        header('Location: ../sdo-admtec/actas-listado.php?errorCrearActa=true');
    }
} else {
    header('Location: ../sdo-admtec/actas-listado.php?errorCrearActa=true');
}

mysqli_close($conexion);
