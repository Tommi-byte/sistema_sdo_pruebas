<?php

include '../sdo-funciones/conexion.php';
include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $idReserva = trim($_POST['idReservado']);
    $solicitudCompra = trim($_POST['solicitudCompra']);
    $depaActual = $_POST['idDepartamento'];

    $anexoSoliCompra = $_FILES['anexoSoliCompra'];
    $observaciones = $_POST['observaciones'];
    // var_dump($anexoSoliCompra);
    // exit;

    $codigoMateialSC = $_POST['codigoSC'];
    $nomMaterialSC = $_POST['nombre'];
    $cantMaterialSC = $_POST['cantidad'];
    $medidaSC = $_POST['medida'];

    if (!empty($codigoMateialSC) && !empty($nomMaterialSC) && $cantMaterialSC > 0) {


        $queryDelete = "DELETE FROM material_soli_reserva WHERE idSoliReserva = ${idReserva}";
        $resDelete = mysqli_query($conexion, $queryDelete);

        for ($i = 0; $i < count($codigoMateialSC); $i++) {

            // var_dump( $codigoMateialSC);
            // exit;
            if (!empty($codigoMateialSC[$i])) {
                $materialSCFor = $codigoMateialSC[$i];
                $nombreSCFor = $nomMaterialSC[$i];
                $cantMaterialSCFor = $cantMaterialSC[$i];
                $medidaFor = $medidaSC[$i];
                

                $queryMaterialSC = "INSERT INTO material_soli_reserva(codigoMaterialSC,cantMaterialSC,nomMaterialSC,idSoliReserva, nomMedida)
                VALUES('" . $materialSCFor . "','" . $cantMaterialSCFor . "','" . $nombreSCFor . "'," . $idReserva . ",'" . $medidaFor . "')";

               
                // var_dump($queryMaterialSC);
                // exit;

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
    }



    if(!empty($_POST['departamentoSolicitante'])){

        $nuevoDepaSolicitante = $_POST['departamentoSolicitante'];

    }else{

        $nuevoDepaSolicitante = $depaActual;
    }
   

    if(isset($_POST['nomTecnicoRecepcionador'])){

        $nomTecnicoRecepcionador = trim($_POST['nomTecnicoRecepcionador']);

        //Query Email 
        $queryEmail = "SELECT *  FROM jefes_tecnicos WHERE idJefe = ${nomTecnicoRecepcionador}";
        $resEmail = mysqli_query($conexion, $queryEmail);

        while($rowEmail = $resEmail->fetch_assoc()){

            $datos = [];

            $datos['emailJefe'] = $rowEmail['emailJefe'];

            $emailjefe = $datos['emailJefe'];

        }

    }else{

        $nomTecnicoRecepcionador = trim($_POST['idPersonal']);

        //Query Email 
        $queryEmail = "SELECT * FROM jefes_tecnicos WHERE  idJefe = ${nomTecnicoRecepcionador}";

        // echo $queryEmail;
        // exit;
        $resEmail = mysqli_query($conexion, $queryEmail);
  
        while($rowEmail = $resEmail->fetch_assoc()){
  
              $datos = [];
  
              $datos['emailJefe'] = $rowEmail['emailJefe'];
  
              $emailjefe = $datos['emailJefe'];
  
          }
    }

    // echo $idReserva .  "<br>";
    
    // echo $solicitudCompra.  "<br>";
    // "<br>";
    // echo $nuevoDepaSolicitante.  "<br>";
    // "<br>";
    // echo $nomTecnicoRecepcionador.  "<br>";
    // exit;


    if(!empty($solicitudCompra) || !empty($nuevoDepaSolicitante) || !empty($nomTecnicoRecepcionador)){


        if(!$anexoSoliCompra['tmp_name'] == '' ){

            //CREA CARPETA 
            $carpetaPDF = 'pdfs/';

            if(!is_dir($carpetaPDF)){
                mkdir($carpetaPDF);
            }

            //Generar un nombre único
            $nomArchivo = md5( uniqid(rand(), true) ) . ".pdf";

            //SUBIR PDF
            //$carpeta = "/pdfSoliReserva"; 
            move_uploaded_file($anexoSoliCompra['tmp_name'], $carpetaPDF . $nomArchivo);

            $queryUpdatePDF = "UPDATE solicitudes_reserva SET folioSoliCompra =  '${solicitudCompra}', idPersonal =  ${nomTecnicoRecepcionador}, idPersonal =  ${nomTecnicoRecepcionador}, idDepartamento =  ${nuevoDepaSolicitante}, email =  '${emailjefe}', nomArchivo =  '${nomArchivo}', observaciones =  '${observaciones}'  WHERE idSoliReserva = ${idReserva}  "; 

          
            $resUpdatePDF = mysqli_query($conexion, $queryUpdatePDF);


            
            if($resUpdatePDF){

                header('Location: /trabajarSDO_pruebas/sdo-bodega-pañol/reservar-soli-compra.php?exitoModificacion=true');

            }
        }



        //QUERY ACTUALIZA RESERVA ACTUAL
        $queryUpdate = "UPDATE solicitudes_reserva SET folioSoliCompra =  '${solicitudCompra}', idPersonal =  ${nomTecnicoRecepcionador}, idPersonal =  ${nomTecnicoRecepcionador}, idDepartamento =  ${nuevoDepaSolicitante}, email =  '${emailjefe}', observaciones =  '${observaciones}' WHERE idSoliReserva = ${idReserva}  "; 
        $resUpdate = mysqli_query($conexion, $queryUpdate);




    
        if($resUpdate){

            header('Location: /trabajarSDO_pruebas/sdo-bodega-pañol/reservar-soli-compra.php?exitoModificacion=true');

        }


    }else{

    }



}