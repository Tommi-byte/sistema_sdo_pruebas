<?php
//print_r($_POST);
$img = $_POST['base64'];

$folder_path = dirname('firmas/');
$img = str_replace('data:image/png;base64,', '', $img);
$fileData = base64_decode($img);
$fileName = $folder_path.uniqid() . '.png';

file_put_contents($fileName, $fileData);


// header("Location: ../sdo-personal/ordenes-firmar.php");

// $rutaActual = getcwd();
// $rutaActualModificada = $rutaActual . DIRECTORY_SEPARATOR.$nuevoNombre;

//sacamos por pantalla la ruta final
echo '<img src="'.$fileName.'" alt="'.$fileName.'">';
?>

<!-- <img src="<?php echo $rutaActualModificada; ?>" alt="<?php echo $nuevoNombre; ?>"> -->