<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = '../data/' . $file;
    if(file_exists($filepath)){
        // Leer datos del personaje para obtener su ID
        $personaje = unserialize(file_get_contents($filepath));
        // Eliminar foto asociada
        if(isset($personaje['foto']) && file_exists('uploads/' . $personaje['foto'])){
            unlink('../uploads/' . $personaje['foto']);
        }
        // Eliminar archivo del personaje
        unlink($filepath);
        
        // Eliminar profesiones asociadas a este personaje
        foreach(scandir('../data') as $f){
            if(strpos($f, 'profession_' . $personaje['identificacion'] . '_') === 0){
                unlink('../data/' . $f);
            }
        }
        echo "Personaje y profesiones asociadas eliminados. <a href='list_personajes.php'>Volver al listado</a>";
    } else {
        echo "Archivo no encontrado.";
    }
} else {
    echo "No se especificó archivo.";
}
?>
