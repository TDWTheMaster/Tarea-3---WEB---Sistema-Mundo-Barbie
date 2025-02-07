<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = '../data/' . $file;
    if(file_exists($filepath)){
        unlink($filepath);
        echo "Profesión eliminada. <a href='list_profesiones.php'>Volver al listado</a>";
    } else {
        echo "Archivo no encontrado.";
    }
} else {
    echo "No se especificó archivo.";
}
?>
