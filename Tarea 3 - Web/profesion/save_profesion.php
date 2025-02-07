<?php
if (!is_dir('../data')) {
    mkdir('../data', 0777, true);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_personaje    = trim($_POST['id_personaje']);
    $nombre_profesion= trim($_POST['nombre_profesion']);
    $categoria       = trim($_POST['categoria']);
    $nivel           = trim($_POST['nivel']);
    $salario         = floatval($_POST['salario']);

    $profesion = [
        'id_personaje'    => $id_personaje,
        'nombre_profesion'=> $nombre_profesion,
        'categoria'       => $categoria,
        'nivel'           => $nivel,
        'salario'         => $salario
    ];

    $data     = serialize($profesion);
    $filename = '../data/profession_' . $id_personaje . '_' . time() . '.dart';
    if(file_put_contents($filename, $data)){
        echo "Profesión registrada exitosamente. <a href='../index.php'>Volver al inicio</a>";
    } else {
        echo "Error al guardar la profesión.";
    }
} else {
    echo "Método no permitido.";
}
?>
