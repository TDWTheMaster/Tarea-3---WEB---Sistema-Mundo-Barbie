<?php
// Verifica o crea la carpeta 'data'
if (!is_dir('../data')) {
    mkdir('../data', 0777, true);
}

// Verifica o crea la carpeta 'uploads' para las fotos
if (!is_dir('../uploads')) {
    mkdir('../uploads', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $identificacion    = trim($_POST['identificacion']);
    $nombre            = trim($_POST['nombre']);
    $apellido          = trim($_POST['apellido']);
    $fecha_nacimiento  = $_POST['fecha_nacimiento'];
    $rol               = trim($_POST['rol']);

    // Procesar la foto
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoTmp    = $_FILES['foto']['tmp_name'];
        $fotoName   = basename($_FILES['foto']['name']);
        $fotoExt    = pathinfo($fotoName, PATHINFO_EXTENSION);
        $fotoNuevoNombre = $identificacion . '_' . time() . '.' . $fotoExt;
        $destino    = '../uploads/' . $fotoNuevoNombre;
        if(!move_uploaded_file($fotoTmp, $destino)){
            die("Error al subir la foto.");
        }
    } else {
        die("Error: No se ha subido la foto correctamente.");
    }

    // Crear array de datos del personaje
    $personaje = [
        'identificacion'   => $identificacion,
        'nombre'           => $nombre,
        'apellido'         => $apellido,
        'fecha_nacimiento' => $fecha_nacimiento,
        'foto'             => $fotoNuevoNombre,
        'rol'              => $rol
    ];

    // Serializar y guardar en un archivo .dart
    $data     = serialize($personaje);
    $filename = '../data/character_' . $identificacion . '.dart';
    if(file_put_contents($filename, $data)) {
        echo "Personaje registrado exitosamente. <a href='../index.php'>Volver al inicio</a>";
    } else {
        echo "Error al guardar los datos del personaje.";
    }
} else {
    echo "Método no permitido.";
}
?>
