<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $original_file = $_POST['original_file'];
    $filepath = '../data/' . $original_file;
    if(!file_exists($filepath)){
        die("Archivo no encontrado.");
    }
    
    $personaje = unserialize(file_get_contents($filepath));
    // Actualizar datos
    $personaje['nombre'] = trim($_POST['nombre']);
    $personaje['apellido'] = trim($_POST['apellido']);
    $personaje['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
    $personaje['rol'] = trim($_POST['rol']);
    
    // Procesar nueva foto si se sube
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        if(!is_dir('uploads')){
            mkdir('uploads', 0777, true);
        }
        $fotoTmp    = $_FILES['foto']['tmp_name'];
        $fotoName   = basename($_FILES['foto']['name']);
        $fotoExt    = pathinfo($fotoName, PATHINFO_EXTENSION);
        $identificacion = $personaje['identificacion'];
        $fotoNuevoNombre = $identificacion . '_' . time() . '.' . $fotoExt;
        $destino = '../uploads/' . $fotoNuevoNombre;
        if(move_uploaded_file($fotoTmp, $destino)){
            // Borrar foto antigua (si existe)
            if(isset($personaje['foto']) && file_exists('../uploads/' . $personaje['foto'])){
                unlink('../uploads/' . $personaje['foto']);
            }
            $personaje['foto'] = $fotoNuevoNombre;
        } else {
            die("Error al subir la nueva foto.");
        }
    }
    
    // Guardar datos actualizados
    $data = serialize($personaje);
    if(file_put_contents($filepath, $data)){
        echo "Personaje actualizado exitosamente. <a href='list_personajes.php'>Volver al listado</a>";
    } else {
        echo "Error al actualizar el personaje.";
    }
} else {
    echo "Método no permitido.";
}
?>
