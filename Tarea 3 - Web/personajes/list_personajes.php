<?php
$personajes = [];
if(is_dir('../data')){
    foreach(scandir('../data') as $file){
        if(strpos($file, 'character_') === 0){
            $data = file_get_contents('../data/' . $file);
            $personaje = unserialize($data);
            $personaje['filename'] = $file; // Para identificar en edición/eliminación
            $personajes[] = $personaje;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Personajes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Estilos personalizados para ambientar al Mundo Barbie -->
  <style>
    /* Fondo rosa pastel y tipografía divertida */
    body {
      background-color: #ffe6f2;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      color: #333;
    }
    /* Contenedor principal */
    .container {
      background: #fff;
      border: 2px dashed #ff66b2;
      border-radius: 15px;
      padding: 30px;
      margin-top: 50px;
      box-shadow: 0 0 15px rgba(255, 102, 178, 0.3);
    }
    /* Título */
    h2 {
      color: #ff66b2;
      text-align: center;
      text-shadow: 1px 1px 2px #fff;
    }
    /* Estilos para la tabla */
    table {
      margin-top: 20px;
    }
    thead th {
      background-color: #ff66b2;
      color: #fff;
      text-align: center;
    }
    tbody td {
      text-align: center;
    }
    /* Botones personalizados */
    .btn-outline-warning {
      color: #ff9900;
      border-color: #ff9900;
      transition: background-color 0.3s, color 0.3s;
    }
    .btn-outline-warning:hover {
      background-color: #ff9900;
      color: #fff;
    }
    .btn-outline-danger {
      color: #ff4d4d;
      border-color: #ff4d4d;
      transition: background-color 0.3s, color 0.3s;
    }
    .btn-outline-danger:hover {
      background-color: #ff4d4d;
      color: #fff;
    }
    .btn-outline-secondary {
      color: #ff66b2;
      border-color: #ff66b2;
      transition: background-color 0.3s, color 0.3s;
    }
    .btn-outline-secondary:hover {
      background-color: #ff66b2;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Listado de Personajes</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Identificación</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Fecha de Nacimiento</th>
          <th>Rol</th>
          <th>Foto</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($personajes as $p): ?>
          <tr>
            <td><?php echo $p['identificacion']; ?></td>
            <td><?php echo $p['nombre']; ?></td>
            <td><?php echo $p['apellido']; ?></td>
            <td><?php echo $p['fecha_nacimiento']; ?></td>
            <td><?php echo $p['rol']; ?></td>
            <td>
              <?php if(isset($p['foto'])): ?>
                <img src="../uploads/<?php echo $p['foto']; ?>" alt="Foto" width="50">
              <?php endif; ?>
            </td>
            <td>
              <a href="edit_personaje.php?file=<?php echo urlencode($p['filename']); ?>" class="btn btn-outline-warning">Editar</a>
              <a href="delete_personaje.php?file=<?php echo urlencode($p['filename']); ?>" class="btn btn-outline-danger" onclick="return confirm('¿Está seguro de eliminar este personaje?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="../index.php" class="btn btn-outline-secondary">Volver al inicio</a>
  </div>
</body>
</html>
