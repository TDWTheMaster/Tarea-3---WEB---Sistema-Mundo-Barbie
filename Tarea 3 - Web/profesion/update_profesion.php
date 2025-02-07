<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $original_file = $_POST['original_file'];
    $filepath = '../data/' . $original_file;
    if(!file_exists($filepath)){
        die("Archivo no encontrado.");
    }
    
    $profesion = unserialize(file_get_contents($filepath));
    
    // Actualizar datos (la clave id_personaje se mantiene)
    $profesion['nombre_profesion'] = trim($_POST['nombre_profesion']);
    $profesion['categoria']        = trim($_POST['categoria']);
    $profesion['nivel']            = trim($_POST['nivel']);
    $profesion['salario']          = floatval($_POST['salario']);
    
    $data = serialize($profesion);
    if(file_put_contents($filepath, $data)){
        echo "Profesión actualizada exitosamente. <a href='list_profesiones.php'>Volver al listado</a>";
    } else {
        echo "Error al actualizar la profesión.";
    }
} else {
    echo "Método no permitido.";
}
?>
