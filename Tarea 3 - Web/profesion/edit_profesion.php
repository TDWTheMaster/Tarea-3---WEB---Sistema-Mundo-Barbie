<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = '../data/' . $file;
    if(file_exists($filepath)){
        $data = file_get_contents($filepath);
        $profesion = unserialize($data);
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
  <title>Editar Profesión</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Estilos personalizados para ambientar al Mundo Barbie -->
  <style>
    /* Fondo rosa pastel y tipografía divertida */
    body {
      background-color: #ffe6f2;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      color: #333;
    }
    /* Contenedor principal decorativo */
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
    /* Botones personalizados */
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
    <h2 class="mt-5">Editar Profesión</h2>
    <form action="update_profesion.php" method="post">
      <input type="hidden" name="original_file" value="<?php echo htmlspecialchars($file); ?>">
      <div class="form-group">
        <label for="id_personaje">ID del Personaje:</label>
        <input type="text" name="id_personaje" id="id_personaje" class="form-control" value="<?php echo htmlspecialchars($profesion['id_personaje']); ?>" required readonly>
      </div>
      <div class="form-group">
        <label for="nombre_profesion">Nombre de la Profesión:</label>
        <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" value="<?php echo htmlspecialchars($profesion['nombre_profesion']); ?>" required>
      </div>
      <div class="form-group">
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" class="form-control" value="<?php echo htmlspecialchars($profesion['categoria']); ?>" required>
      </div>
      <div class="form-group">
        <label for="nivel">Nivel de Experiencia:</label>
        <select name="nivel" id="nivel" class="form-control" required>
          <option value="Principiante" <?php if($profesion['nivel']=='Principiante') echo 'selected'; ?>>Principiante</option>
          <option value="Intermedio" <?php if($profesion['nivel']=='Intermedio') echo 'selected'; ?>>Intermedio</option>
          <option value="Avanzado" <?php if($profesion['nivel']=='Avanzado') echo 'selected'; ?>>Avanzado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="salario">Salario Mensual Estimado ($USD):</label>
        <input type="number" name="salario" id="salario" class="form-control" value="<?php echo htmlspecialchars($profesion['salario']); ?>" required step="0.01">
      </div>
      <button type="submit" class="btn btn-outline-primary">Actualizar Profesión</button>
    </form>
    <a href="list_profesiones.php" class="btn btn-outline-secondary mt-2">Volver al listado</a>
  </div>
</body>
</html>
