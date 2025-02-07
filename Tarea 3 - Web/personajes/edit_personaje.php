<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = '../data/' . $file;
    if(file_exists($filepath)){
        $data = file_get_contents($filepath);
        $personaje = unserialize($data);
    } else {
        die("Archivo no encontrado.");
    }
} else {
    die("No se especificó archivo.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Personaje</title>
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
    /* Etiquetas */
    label {
      font-weight: bold;
      color: #ff66b2;
    }
    /* Botones */
    .btn-outline-primary {
      color: #ff66b2;
      border-color: #ff66b2;
      transition: background-color 0.3s, color 0.3s;
    }
    .btn-outline-primary:hover {
      background-color: #ff66b2;
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
    <h2 class="mt-5">Editar Personaje</h2>
    <form action="update_personaje.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="original_file" value="<?php echo htmlspecialchars($file); ?>">
      <div class="form-group">
        <label for="identificacion">Identificación:</label>
        <input type="text" name="identificacion" id="identificacion" class="form-control" value="<?php echo htmlspecialchars($personaje['identificacion']); ?>" required readonly>
      </div>
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($personaje['nombre']); ?>" required>
      </div>
      <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo htmlspecialchars($personaje['apellido']); ?>" required>
      </div>
      <div class="form-group">
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo htmlspecialchars($personaje['fecha_nacimiento']); ?>" required>
      </div>
      <div class="form-group">
        <label for="rol">Profesión o Rol en el Mundo Barbie:</label>
        <input type="text" name="rol" id="rol" class="form-control" value="<?php echo htmlspecialchars($personaje['rol']); ?>" required>
      </div>
      <div class="form-group">
        <label>Foto Actual:</label><br>
        <?php if(isset($personaje['foto'])): ?>
          <img src="../uploads/<?php echo $personaje['foto']; ?>" alt="Foto" width="100"><br>
        <?php endif; ?>
        <label for="foto">Cambiar Foto (opcional):</label>
        <input type="file" name="foto" id="foto" class="form-control-file" accept="image/*">
      </div>
      <button type="submit" class="btn btn-outline-primary">Actualizar</button>
    </form>
    <a href="list_personajes.php" class="btn btn-outline-secondary mt-2">Volver al listado</a>
  </div>
</body>
</html>
