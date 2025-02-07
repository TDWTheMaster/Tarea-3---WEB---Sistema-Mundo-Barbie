<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mundo Barbie - Gestión</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #ffe6f2; 
      font-family: 'Comic Sans MS', cursive, sans-serif; 
      color: #333;
    }
    .container {
      background: #fff;
      border: 2px dashed #ff66b2;
      border-radius: 15px;
      padding: 30px;
      margin-top: 50px;
      box-shadow: 0 0 15px rgba(255, 102, 178, 0.3);
    }

    h1 {
      color: #ff66b2;
      text-align: center;
      text-shadow: 1px 1px 2px #fff;
    }
    .nav-pills .nav-item .btn {
      color: #ff66b2;
      border-color: #ff66b2;
      transition: background-color 0.3s, color 0.3s;
      font-weight: bold;
    }
    .nav-pills .nav-item .btn:hover {
      background-color: #ff66b2;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="mt-3">Sistema de Gestión del Mundo Barbie</h1>
    <nav class="mt-4">
      <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
          <a class="btn btn-outline-primary m-2" href="personajes/register_personaje.php">Registrar Personaje</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-primary m-2" href="profesion/register_profesion.php">Registrar Profesión</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-primary m-2" href="personajes/list_personajes.php">Listar Personajes</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-primary m-2" href="profesion/list_profesiones.php">Listar Profesiones</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-primary m-2" href="dashboard.php">Dashboard - Estadisticas</a>
        </li>
      </ul>
    </nav>
  </div>
</body>
</html>
