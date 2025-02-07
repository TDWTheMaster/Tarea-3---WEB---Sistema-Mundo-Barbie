<?php
// Inicializar arrays
$personajes   = [];
$profesiones  = [];

// Leer archivos de la carpeta data
if(is_dir('data')){
    $files = scandir('data');
    foreach($files as $file){
        if(strpos($file, 'character_') === 0){
            $data = file_get_contents('data/' . $file);
            $p = unserialize($data);
            $personajes[] = $p;
        } elseif(strpos($file, 'profession_') === 0){
            $data = file_get_contents('data/' . $file);
            $prof = unserialize($data);
            $profesiones[] = $prof;
        }
    }
}

// Total de personajes y profesiones
$totalPersonajes = count($personajes);
$totalProfesiones= count($profesiones);

// Promedio de profesiones por personaje
$promedioProfesionesPorPersonaje = $totalPersonajes > 0 ? $totalProfesiones / $totalPersonajes : 0;

// Edad promedio de personajes
$sumaEdades = 0;
foreach($personajes as $p){
    $fechaNacimiento = $p['fecha_nacimiento'];
    $edad = floor((time() - strtotime($fechaNacimiento)) / (365.25*24*60*60));
    $sumaEdades += $edad;
}
$edadPromedio = $totalPersonajes > 0 ? $sumaEdades / $totalPersonajes : 0;

// Distribución de profesiones por categoría
$categorias = [];
foreach($profesiones as $prof){
    $cat = $prof['categoria'];
    if(!isset($categorias[$cat])){
        $categorias[$cat] = 0;
    }
    $categorias[$cat]++;
}

// Nivel de experiencia más común
$niveles = [];
foreach($profesiones as $prof){
    $nivel = $prof['nivel'];
    if(!isset($niveles[$nivel])){
        $niveles[$nivel] = 0;
    }
    $niveles[$nivel]++;
}
$nivelMasComun = '';
if(!empty($niveles)){
    arsort($niveles);
    $nivelMasComun = key($niveles);
}

// Profesión con mayor y menor salario
$mayorSalario   = null;
$menorSalario   = null;
$profesionMayor = null;
$profesionMenor = null;
$sumaSalarios   = 0;
foreach($profesiones as $prof){
    $salario = $prof['salario'];
    $sumaSalarios += $salario;
    if($mayorSalario === null || $salario > $mayorSalario){
        $mayorSalario = $salario;
        $profesionMayor = $prof;
    }
    if($menorSalario === null || $salario < $menorSalario){
        $menorSalario = $salario;
        $profesionMenor = $prof;
    }
}
$salarioPromedio = $totalProfesiones > 0 ? $sumaSalarios / $totalProfesiones : 0;

// Personaje con el salario total más alto (sumando los salarios de todas sus profesiones)
$salariosPersonajes = [];
foreach($profesiones as $prof){
    $id = $prof['id_personaje'];
    if(!isset($salariosPersonajes[$id])){
        $salariosPersonajes[$id] = 0;
    }
    $salariosPersonajes[$id] += $prof['salario'];
}
$maxSalarioPersonaje = null;
$idMaxSalario = null;
foreach($salariosPersonajes as $id => $totalSalario){
    if($maxSalarioPersonaje === null || $totalSalario > $maxSalarioPersonaje){
        $maxSalarioPersonaje = $totalSalario;
        $idMaxSalario = $id;
    }
}
// Obtener el nombre del personaje con mayor salario
$nombreMaxSalario = '';
if($idMaxSalario !== null){
    foreach($personajes as $p){
        if($p['identificacion'] == $idMaxSalario){
            $nombreMaxSalario = $p['nombre'] . ' ' . $p['apellido'];
            break;
        }
    }
}

// Preparar datos para Chart.js: Suma de salarios por categoría
$salariosPorCategoria = [];
foreach($profesiones as $prof){
    $cat = $prof['categoria'];
    if(!isset($salariosPorCategoria[$cat])){
        $salariosPorCategoria[$cat] = 0;
    }
    $salariosPorCategoria[$cat] += $prof['salario'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Estadísticas Mundo Barbie</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Se carga Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    /* Títulos */
    h2, h3 {
      color: #ff66b2;
      text-align: center;
      text-shadow: 1px 1px 2px #fff;
    }
    /* Estilos para la lista */
    .list-group-item {
      border: 1px solid #ff66b2;
      background-color: #fff;
      color: #333;
    }
    /* Botón personalizado */
    .btn-secondary {
      color: #ff66b2;
      border-color: #ff66b2;
      background: transparent;
      transition: background-color 0.3s, color 0.3s;
    }
    .btn-secondary:hover {
      background-color: #ff66b2;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Dashboard - Estadísticas del Mundo Barbie</h2>
    <ul class="list-group">
      <li class="list-group-item">Total de Personajes Registrados: <?php echo $totalPersonajes; ?></li>
      <li class="list-group-item">Total de Profesiones Registradas: <?php echo $totalProfesiones; ?></li>
      <li class="list-group-item">Promedio de Profesiones por Personaje: <?php echo number_format($promedioProfesionesPorPersonaje, 2); ?></li>
      <li class="list-group-item">Edad Promedio de los Personajes: <?php echo number_format($edadPromedio, 2); ?> años</li>
      <li class="list-group-item">Nivel de Experiencia más Común: <?php echo $nivelMasComun; ?></li>
      <li class="list-group-item">Profesión con Mayor Salario: <?php echo $profesionMayor ? $profesionMayor['nombre_profesion'] . " ($" . $mayorSalario . ")" : "N/A"; ?></li>
      <li class="list-group-item">Profesión con Menor Salario: <?php echo $profesionMenor ? $profesionMenor['nombre_profesion'] . " ($" . $menorSalario . ")" : "N/A"; ?></li>
      <li class="list-group-item">Salario Promedio en el Mundo Barbie: $<?php echo number_format($salarioPromedio, 2); ?></li>
      <li class="list-group-item">Personaje con el Salario Total más Alto: <?php echo $nombreMaxSalario ? $nombreMaxSalario . " ($" . $maxSalarioPersonaje . ")" : "N/A"; ?></li>
    </ul>
    
    <h3 class="mt-5">Distribución de Salarios por Categoría</h3>
    <canvas id="salaryChart" width="400" height="200"></canvas>
    
    <script>
      const ctx = document.getElementById('salaryChart').getContext('2d');
      const salaryChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: <?php echo json_encode(array_keys($salariosPorCategoria)); ?>,
              datasets: [{
                  data: <?php echo json_encode(array_values($salariosPorCategoria)); ?>,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.6)',
                      'rgba(54, 162, 235, 0.6)',
                      'rgba(255, 206, 86, 0.6)',
                      'rgba(75, 192, 192, 0.6)',
                      'rgba(153, 102, 255, 0.6)',
                      'rgba(255, 159, 64, 0.6)'
                  ]
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top',
                  },
                  title: {
                      display: true,
                      text: 'Salarios por Categoría'
                  }
              }
          }
      });
    </script>
    <a href="index.php" class="btn btn-secondary mt-3">Volver al inicio</a>
  </div>
</body>
</html>
