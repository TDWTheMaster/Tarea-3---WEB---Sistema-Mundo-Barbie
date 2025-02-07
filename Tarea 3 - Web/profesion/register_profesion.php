<?php
// Obtener lista de personajes
$personajes = [];
if(is_dir('../data')){
    foreach(scandir('../data') as $file){
        if(strpos($file, 'character_') === 0){
            $data = file_get_contents('../data/' . $file);
            $personaje = unserialize($data);
            $personajes[] = $personaje;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Profesión</title>
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
    /* Etiquetas del formulario */
    label {
      font-weight: bold;
      color: #ff66b2;
    }
    /* Botón personalizado */
    .btn-outline-primary {
      color: #ff66b2;
      border-color: #ff66b2;
      transition: background-color 0.3s, color 0.3s;
    }
    .btn-outline-primary:hover {
      background-color: #ff66b2;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Registro de Profesiones y Salarios</h2>
    <form action="save_profesion.php" method="post">
      <div class="form-group">
        <label for="id_personaje">Seleccione el Personaje:</label>
        <select name="id_personaje" id="id_personaje" class="form-control" required>
          <option value="">-- Seleccione --</option>
          <?php foreach($personajes as $p): ?>
            <option value="<?php echo $p['identificacion']; ?>">
              <?php echo $p['nombre'] . " " . $p['apellido'] . " (ID: " . $p['identificacion'] . ")"; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="nombre_profesion">Nombre de la Profesión:</label>
        <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" class="form-control" required placeholder="Ej: Ciencia, Arte, Deporte, etc.">
      </div>
      <div class="form-group">
        <label for="nivel">Nivel de Experiencia:</label>
        <select name="nivel" id="nivel" class="form-control" required>
          <option value="">-- Seleccione --</option>
          <option value="Principiante">Principiante</option>
          <option value="Intermedio">Intermedio</option>
          <option value="Avanzado">Avanzado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="salario">Salario Mensual Estimado ($USD):</label>
        <input type="number" name="salario" id="salario" class="form-control" required step="0.01">
      </div>
      <button type="submit" class="btn btn-outline-primary">Registrar Profesión</button>
    </form>
  </div>
</body>
</html>
