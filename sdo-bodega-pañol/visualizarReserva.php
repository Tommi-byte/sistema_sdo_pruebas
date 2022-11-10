<?php 

include '../sdo-funciones/conexion.php';

include '../sdo-funciones/funciones.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../sdo-pdf/TCPDF/tcpdf.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $idReserva = $_POST['idReserva'];    
    $datosSoliReserva = array();
    $datosSoliReserva = getSoliReserva($idReserva);

    //$idSoliReserva2 = $datosSoliReserva['idSoliReserva'];
    $numReserva = $datosSoliReserva['numReserva'];
    $folioSoliCompra = $datosSoliReserva['folioSoliCompra'];
    $numeroCompra = $datosSoliReserva['numeroCompra'];
    $observaciones = $datosSoliReserva['observaciones'];
    $fechaSoliReserva = $datosSoliReserva['fechaSoliReserva'];
    $idPersonal = $datosSoliReserva['idPersonal'];
    $idDepartamento = $datosSoliReserva['idDepartamento'];
    $email = $datosSoliReserva['email'];
    $estadoSoliReserva = $datosSoliReserva['estadoSoliReserva'];

    //OBTIENE NOMBRE DEL SOLICITANTE
    $queryPersonal = "SELECT * FROM jefes_tecnicos WHERE idJefe = $idPersonal";
    $res = mysqli_query($conexion, $queryPersonal);

    
    while($row = $res->fetch_assoc()){

        $datos = [];

        $datos['nomJefe'] = $row['nomJefe'];
        $datos['email'] = $row['emailJefe'];

        $nomJefe = $datos['nomJefe'];
        $email = $datos['email'];


    }

    //OBTIENE DEPARTAMENTO
    $queryDepartamento = "SELECT * FROM departamentos WHERE idDepartamento = $idDepartamento";
    $res1 = mysqli_query($conexion, $queryDepartamento);

    
    while($row = $res1->fetch_assoc()){

        $datos = [];

        $datos['nomDepartamento'] = $row['nomDepartamento'];

        $departamento = $datos['nomDepartamento'];
        


    }



   
}

$tituloActa = "Acta entrega Herramientas y/o Materiales Soli. de Compra";

$GLOBALS['numReserva'] = $numReserva;
$GLOBALS['tituloActa'] = $tituloActa;

class MYPDF extends TCPDF
{
    public function Header()
    {

        $this->SetFont('helvetica', '', 9);
		$html = '<table cellpadding="10" border="1">
		<tr>
			<td style="text-align: center;" rowspan="3" width="20%;">
				<img src="../sdo-pdf/TCPDF/examples/images/LogoSSVQ.png" style="text-align: center; width:100px; height:100px; margin-top:100px;">
			</td>
			<td width="55%;" style="text-align: center; vertical-align: middle;">
				<b>HOSPITAL BIPROVINCIAL QUILLOTA - PETORCA</b>
			</td>
			<td rowspan="3" width="25%;" style="text-align: center; vertical-align: middle;">
			<h2 style="text-align: center; vertical-align: middle;"><center>N° Reserva</center></h2>
			<h2 style="text-align: center; vertical-align: middle;"><center>' . $GLOBALS['numReserva'] . '</center></h2>
			</td>
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle;">
			SUBDIRECCIÓN DE OPERACIONES
			</td> 
		</tr>
		<tr>
			<td style="text-align: center; vertical-align: middle;">
			'.$GLOBALS['tituloActa'].'
			
			<br>
			BODEGA PAÑOL
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>';
		$this->writeHTML($html, 0, 1, 1, true, true, true);
    }

    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, $GLOBALS['numReserva'], 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set document information
$folioSolicitudGuardar = $idReserva;
$no_permitidas2 = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã", "Ã", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "Ò", "Ã", "Ã„", "Ã‹", "à", "è", "ì", "ò", "ù");
$permitidas2 = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "ñ", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "Ñ", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "N", "a", "e", "i", "o", "u");
$texto2 = str_replace($no_permitidas2, $permitidas2, $folioSolicitudGuardar);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Administrador de Solicitudes de Compra');
$pdf->SetTitle($texto2);
$pdf->SetSubject($texto2);
$pdf->SetKeywords('Solicitud de Compra, PDF, SC, SDO');


// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));


// set header and footer fonts
// $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/spa.php')) {
    require_once(dirname(__FILE__) . '/lang/spa.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('Helvetica', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


// Set some content to print
//CAMBIAR NOMBRE ADMIN
$content = '

<h4 align="center"><br>&nbsp;<br>ACTA DE ENTREGA HERRAMIENTAS Y/O MATERIALES RESERVADO POR SOLICITUD DE COMPRA<br><br></h4>


';

$content .= '


<table cellpadding="8" cellspacing="10" border="0">

	<tr>
		<td style="vertical-align:middle; width:28%"><p><b>Fecha Solicitud: </b></p></td>
		<td border="1" style="vertical-align:middle; width:60%"><p>'. $fechaSoliReserva. '</p></td>
	</tr>
	<tr>
		<td style="vertical-align:middle; width:28%"><p><b>Solicitado por: </b></p></td>
		<td border="1" style="vertical-align:middle; width:60%"><p>'. $nomJefe . '</p></td>
	</tr>
	<tr>
		<td style="vertical-align:middle; width:28%"><p><b>Unidad o Servicio: </b></p></td>
		<td border="1" style="vertical-align:middle; width:60%"><p>' . $departamento. '</p></td>
	</tr>
	<tr>
		<td style="vertical-align:middle; width:28%"><p><b>Correo Electrónico: </b></p></td>
		<td border="1" style="vertical-align:middle; width:60%"><p>'. $email . '</p></td>
	</tr>
    <tr>
		<td style="vertical-align:middle; width:28%"><p><b>Folio Soli. Compra Referente </b></p></td>
		<td border="1" style="vertical-align:middle; width:60%"><p>'. $folioSoliCompra . '</p></td>
	</tr>
    <tr>
		<td style="vertical-align:middle; width:28%"><p><b>N° de Compra Referente </b></p></td>
		<td border="1" style="vertical-align:middle; width:60%"><p>'. $numeroCompra . '</p></td>
	</tr>
    
    

</table>

<br>

';

$contarMaterialSC = contarMaterialesSC($idReserva);

if ($contarMaterialSC > 0) {


    $content .= '

    <p style="font-weight:bold;">Descripción materiales reservados:</p>


    <table cellpadding="5" border="1">

        <tr>
            <td style="vertical-align:middle; text-align:center; width:30%; font-weight:bold; font-size: 14px;">Código de barras</td>
            
            <td style="vertical-align:middle; text-align:center; width:25%; font-weight:bold; font-size: 14px;">Nombre Herramienta y/o Material</td>
            <td style="vertical-align:middle; text-align:center; width:15%; font-weight:bold; font-size: 14px;">Cantidad</td>
            <td style="vertical-align:middle; text-align:center; width:35%; font-weight:bold; font-size: 14px;">Medida</td>
            
        </tr>

    ';


    $queryMaterialSC = 'SELECT * FROM material_soli_reserva WHERE idSoliReserva = ' . $idReserva . ' ORDER BY nomMaterialSC ASC';


    $resMaterialSC = mysqli_query($conexion, $queryMaterialSC);

    $numMaterialSC = 1;

    while ($rowMaterialSC = $resMaterialSC->fetch_assoc()) {

        $content .= '

    <tr>
        <td style="vertical-align:middle; text-align:center; width:30%; font-size: 14px;">' . $rowMaterialSC['codigoMaterialSC'] . '</td>
      
        <td style="vertical-align:middle; text-align:center; width:25%; font-size: 14px;">' . $rowMaterialSC['nomMaterialSC'] . '</td>
        <td style="vertical-align:middle; text-align:center; width:15%; font-size: 14px;">' . $rowMaterialSC['cantMaterialSC'] . '</td>
        <td style="vertical-align:middle; text-align:center; width:35%; font-size: 14px;">' . $rowMaterialSC['nomMedida'] . '</td>
        
       
	</tr>
 


    ';
    }


    $content .= '

</table>


<br>
<br pagebreak="true">
';
}

$content .= '


<p style="font-weight:bold;"><u>Observaciones:</u></p>

<table cellpadding="50" border="1">

<tr>
		<td style="vertical-align:middle; text-align:justify;">' . nl2br($observaciones) . '</td>
	</tr>

</table>


 ';

$content .= '

<br pagebreak="true" />

<p style="text-align:justify;"> Ante lo anterior, se deja constancia que el equipo/equipamiento/herramienta/material es entregado conforme para su uso al Jefe de Servicio o referente, llevado a cabo el control y cuidado del bien entregado, para fines exclusivamente institucionales </p>
<table cellpadding="0" border="0">

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <tr>
        <td style="vertical-align:middle; text-align:center; width:50%;">___________________________<br><b>Nombre y Firma De </b><br><br>Solicitante</td>
        <td style="vertical-align:middle; text-align:center; width:50%;">___________________________<br><b>Encargado Pañol</b><br><b>&nbsp;&nbsp;&nbsp;</b><br><b>V° B°</b></td>
    </tr>

</table>

<br>




';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã", "Ã", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "Ò", "Ã", "Ã‹", "à", "è", "ì", "ò", "ù");
$permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "ñ", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "Ñ", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "N", "a", "e", "i", "o", "u");
$texto = str_replace($no_permitidas, $permitidas, $idReserva);

$pdf->Output($texto . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

