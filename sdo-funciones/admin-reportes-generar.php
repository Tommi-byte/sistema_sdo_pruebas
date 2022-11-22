<?php

include_once 'conexion.php';

if (isset($_POST['idUsuario'], $_POST['fechaActualReporte'], $_POST['nomEncargadoTurno'], $_POST['nomFuncionariosTurno'], $_POST['nomEncargadoTurnoAnterior'], $_POST['listaTurno'])) {

    $fechaActualReporte = $_POST['fechaActualReporte'];
    $nomEncargadoTurno = trim($_POST['nomEncargadoTurno']);
    $nomFuncionariosTurno = trim($_POST['nomFuncionariosTurno']);
    $nomEncargadoTurnoAnterior = trim($_POST['nomEncargadoTurnoAnterior']);
    $idUsuario = trim($_POST['idUsuario']);

    $nomEncargadoTurno = ucwords(strtolower($nomEncargadoTurno));
    $nomFuncionariosTurno = ucwords(strtolower($nomFuncionariosTurno));
    $nomEncargadoTurnoAnterior = ucwords(strtolower($nomEncargadoTurnoAnterior));

    if ($idUsuario == "" || $idUsuario == " " || empty($idUsuario) || $nomEncargadoTurno == "" || $nomEncargadoTurno == " " || empty($nomEncargadoTurno) || $nomFuncionariosTurno == "" || $nomFuncionariosTurno == " " || empty($nomFuncionariosTurno) || $nomEncargadoTurnoAnterior == "" || $nomEncargadoTurnoAnterior == " " || empty($nomEncargadoTurnoAnterior)) {
        header('Location: ../sdo-administrador/reportes-formulario.php?errorGenerar=true');
    } else {

        $listaTurno = trim($_POST['listaTurno']);

        if ($listaTurno == "" || $listaTurno == " " || empty($listaTurno)) {
            header('Location: ../sdo-administrador/reportes-formulario.php?errorGenerar=true');
        } else {

            if (isset($_POST['tareasControlCentralizado'], $_POST['tareasInstalaciones'], $_POST['tareasEquiposIndustriales'], $_POST['tareasIncendiosCombustibles'], $_POST['tareasDeteccionElectrica'], $_POST['pendientesCoordinacion'])) {

                $tareasControlCentralizado = trim($_POST['tareasControlCentralizado']);
                $tareasInstalaciones = trim($_POST['tareasInstalaciones']);
                $tareasEquiposIndustriales = trim($_POST['tareasEquiposIndustriales']);
                $tareasIncendiosCombustibles = trim($_POST['tareasIncendiosCombustibles']);
                $tareasDeteccionElectrica = trim($_POST['tareasDeteccionElectrica']);
                $pendientesCoordinacion = trim($_POST['pendientesCoordinacion']);
                $turno = "";

                if ($tareasControlCentralizado == '' || empty($tareasControlCentralizado) || $tareasInstalaciones == '' || empty($tareasInstalaciones) || $tareasEquiposIndustriales == '' || empty($tareasEquiposIndustriales) || $tareasIncendiosCombustibles == '' || empty($tareasIncendiosCombustibles) || $tareasDeteccionElectrica == '' || empty($tareasDeteccionElectrica) || $pendientesCoordinacion == '' || empty($pendientesCoordinacion)) {
                } else {
                    $tareasControlCentralizado = str_replace("'", "\'", $tareasControlCentralizado);
                    $tareasInstalaciones = str_replace("'", "\'", $tareasInstalaciones);
                    $tareasEquiposIndustriales = str_replace("'", "\'", $tareasEquiposIndustriales);
                    $tareasIncendiosCombustibles = str_replace("'", "\'", $tareasIncendiosCombustibles);
                    $tareasDeteccionElectrica = str_replace("'", "\'", $tareasDeteccionElectrica);
                    $pendientesCoordinacion = str_replace("'", "\'", $pendientesCoordinacion);
                }

                $tareasControlCentralizado = ucfirst($tareasControlCentralizado);
                $tareasInstalaciones = ucfirst($tareasInstalaciones); 
                $tareasEquiposIndustriales = ucfirst($tareasEquiposIndustriales);
                $tareasIncendiosCombustibles = ucfirst($tareasIncendiosCombustibles);
                $tareasDeteccionElectrica = ucfirst($tareasDeteccionElectrica);
                $pendientesCoordinacion = ucfirst($pendientesCoordinacion);


                if ($listaTurno == "Dia") {
                    $turno = "D";
                } else if ($listaTurno == "Noche") {
                    $turno = "N";
                } else {
                    header('Location: ../sdo-administrador/reportes-administrar.php?errorGenerar=true');
                }

                $query = "INSERT INTO reportes_generales(idReporte,nomReporte,turnoReporte,fechaReporte,folioReporte,nomEncargadoTurno,nomFuncionariosTurno,nomEncargadoTurnoAnterior,tareasControlCentralizado,tareasInstalaciones,tareasEquiposIndustriales,tareasIncendiosCombustibles,tareasDeteccionElectrica,pendientesCoordinacion)
                VALUES (NULL,'Reporte General de Eventos - " . $listaTurno . " - " . $fechaActualReporte . "','" . $listaTurno . "',NOW(),'','" . $nomEncargadoTurno . "','" . $nomFuncionariosTurno . "','" . $nomEncargadoTurnoAnterior . "','" . $tareasControlCentralizado . "','" . $tareasInstalaciones . "','" . $tareasEquiposIndustriales . "','" . $tareasIncendiosCombustibles . "','" . $tareasDeteccionElectrica . "','" . $pendientesCoordinacion . "')";

                $res = mysqli_query($conexion, $query);

                if ($res) {

                    $idReporte = mysqli_insert_id($conexion);

                    $folioReporte = "HBQP-RGE-" . $turno . "-" . $idReporte;

                    $queryFolio = "UPDATE reportes_generales SET folioReporte = '" . $folioReporte . "' WHERE idReporte =" . $idReporte;

                    $res = mysqli_query($conexion, $queryFolio);

                    if (isset($_FILES["archivoImagen"])) {
                        $tot = count($_FILES["archivoImagen"]["name"]);
                        for ($i = 0; $i < $tot; $i++) {
                            $tmp_name = $_FILES["archivoImagen"]["tmp_name"][$i];
                            $name = $_FILES["archivoImagen"]["name"][$i];

                            if ($tmp_name == '' || $tmp_name == ' ' || empty($tmp_name)) {
                                header('Location: ../sdo-administrador/reportes-administrar.php?reporteSinFoto=true');
                            } else {

                                $directorio = "../sdo-archivos/R".$idReporte."/";

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

                                        $queryImagen = "INSERT INTO imagenes(idImagen,nomImagen,extImagen,rutaImagen,idReporte,idOrden) VALUES (NULL,'" . $name . "','" . $extImagen . "','" . $ruta . "','" . $idReporte . "',0)";

                                        $resImagen = mysqli_query($conexion, $queryImagen);

                                        if ($resImagen) {
                                            header('Location: ../sdo-administrador/reportes-administrar.php?reporteConFoto=true');
                                        } else {
                                            header('Location: ../sdo-administrador/reportes-administrar.php?errorCargaFoto=true');
                                        }
                                    } else {
                                        header('Location: ../sdo-administrador/reportes-administrar.php?errorCargaFoto=true');
                                    }
                                } else {

                                    header('Location: ../sdo-administrador/reportes-administrar.php?formatoIncorrectoFoto=true');
                                }
                            }
                        }
                    } else {
                        header('Location: ../sdo-administrador/reportes-administrar.php?reporteSinFoto=true');
                    }
                } else {
                    header('Location: ../sdo-administrador/reportes-formulario.php?errorGenerar1=true');
                }
            } else {

                header('Location: ../sdo-administrador/reportes-formulario.php?errorGenerar2=true');
            }
        }
    }
} else {

    header('Location: ../sdo-administrador/reportes-formulario.php?errorGenerar3=true');
}
