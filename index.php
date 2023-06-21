<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}

// Conexión a la base de datos
 $conn = new mysqli('localhost', 'id20920072_cil', 'Can@lla123', 'id20920072_tickets');
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Consultar los tickets pendientes
$sql = "SELECT * FROM tickets WHERE estado = 'pendiente'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sistema de Tickets</title><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <div class="container">
    <h2>Bienvenido al Sistema de Tickets</h2>
    <?php


// Obtener los tickets pendientes de la base de datos
$sql = "SELECT * FROM tickets WHERE estado = 'Pendiente'";
$result = $conn->query($sql);

// Verificar si hay tickets pendientes
if ($result->num_rows > 0) {
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Descripción</th>";
  echo "<th>Estado</th>";
  echo "<th>Usuario</th>";
  echo "<th>Resolver</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";

  // Mostrar los tickets pendientes en la tabla
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['descripcion'] . "</td>";
    echo "<td>" . $row['estado'] . "</td>";
    echo "<td>" . $row['usuario'] . "</td>";
    echo "<td><form method='post' action='update_ticket.php'>";
    echo "<input type='hidden' name='ticketId' value='" . $row['id'] . "'>";
    echo "<input type='text' name='resolutionReason' placeholder='Motivo de resolución'>";
    echo "<input type='submit' name='resolve' value='Resolver' class='btn btn-primary'>";
    echo "</form></td>";
    echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";
} else {
  echo "No hay tickets pendientes";
}


// Cerrar la conexión a la base de datos
$conn->close();
?>

    <a href="logout.php" class="btn btn-primary">Cerrar sesión</a>
 
 

    <h3>Crear Nuevo Ticket</h3>
<form action="crear_ticket.php" method="POST">
  <div class="form-group">
    <label for="titulo">Título:</label>
    <input type="text" class="form-control" id="titulo" name="titulo" required>
  </div>
  <div class="form-group">
    <label for="descripcion">Descripción:</label>
    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Crear Ticket</button>
</form>

<br>
    
    <br>
    <!-- Agregar el enlace al listado de tickets realizados -->
<a href="tickets_realizados.php" class="btn btn-primary">Listado de Tickets Realizados</a>

  </div>
  <script src="ruta_al_archivo_bootstrap.min.js"></script>
</body>
</html>

