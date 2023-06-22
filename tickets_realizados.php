
<!DOCTYPE html>
<html>
<head>
  <title>Sistema de Tickets</title><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <div class="container">
    <h2>Bienvenido al Sistema de Tickets</h2>
<a href="index.php" class="btn btn-primary">Inicio</a>

<?php
//session_start();
require_once 'config.php';

// Verificar si el usuario está autenticado
/*if (!isset($_SESSION['usuario'])) {
  // Redirigir al formulario de inicio de sesión si el usuario no está autenticado
  header("Location: login.php");
  exit();
}*/

// Obtener los tickets realizados de la base de datos (ajusta los valores según tu configuración)
//$conn = new mysqli('localhost', 'id20920072_cil', 'Can@lla123', 'id20920072_tickets');


// Crear la conexión
$conn = new mysqli($servername, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Obtener los tickets realizados de la base de datos
$sql = "SELECT * FROM tickets WHERE estado = 'Realizado'";
$result = $conn->query($sql);

// Verificar si hay tickets realizados
if ($result->num_rows > 0) {
  echo "<h2>Listado de Tickets Realizados</h2>";
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Descripción</th>";
  echo "<th>Estado</th>";
  echo "<th>Usuario</th>";
  echo "<th>Usuario Interviniente</th>";
  
  echo "<th>Resolucion</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";

  // Mostrar los tickets realizados en la tabla
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['descripcion'] . "</td>";
    echo "<td>" . $row['estado'] . "</td>";
    echo "<td>" . $row['usuario'] . "</td>";
    echo "<td>" . $row['usuario_interviene'] . "</td>";
     echo "<td>" . $row['resolucion'] . "</td>";
    echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";
} else {
  echo "No hay tickets realizados";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
