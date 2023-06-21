<?php
   session_start();
   if (!isset($_SESSION['usuario'])) {
      // Si el usuario no ha iniciado sesión, redirige al formulario de login
      header("Location: login.php");
      exit();
   }

   // Obtén el usuario actual de la sesión
   $usuarioActual = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
<head>
   <title>Detalles del ticket</title>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <h1>Detalles del ticket</h1>

   <?php
      // Obtén el ID del ticket desde la URL
      $id = $_GET['id'];

      // Conexión a la base de datos
       $conn = new mysqli('localhost', 'root', '', 'tickets');
      if ($conn->connect_error) {
         die("Error de conexión: " . $conn->connect_error);
      }

      // Consulta los detalles del ticket específico
      $sql = "SELECT * FROM tickets WHERE id = $id";
      $result = $conn->query($sql);

      // Muestra los detalles del ticket
      if ($row = $result->fetch_assoc()) {
         echo "<h2>" . $row['titulo'] . "</h2>";
         echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
         echo "<p><strong>Estado:</strong> " . $row['estado'] . "</p>";

         // Comprueba si el usuario actual puede cambiar el estado a "Realizado"
         if ($usuarioActual == $row['usuario'] && $row['estado'] == "Pendiente") {
            echo "<form action='update_ticket.php?id=" . $row['id'] . "' method='POST'>";
            echo "<label for='intervencion'>Intervención:</label>";
            echo "<textarea id='intervencion' name='intervencion'></textarea>";
            echo "<input type='hidden' name='estado' value='Realizado'>";
            echo "<input type='submit' value='Marcar como Realizado'>";
            echo "</form>";
         }
      }

      // Cierra la conexión a la base de datos
      $conn->close();
   ?>
</body>
</html>
