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

<?php
   // Obtén los valores del formulario
   $titulo = $_POST['titulo'];
   $descripcion = $_POST['descripcion'];
   $estado = $_POST['estado'];

   // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'tickets');
   if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
   }

   // Inserta el nuevo ticket en la base de datos
   $sql = "INSERT INTO tickets (titulo, descripcion, estado, usuario) VALUES ('$titulo', '$descripcion', '$estado', '$usuarioActual')";
   if ($conn->query($sql) === TRUE) {
      echo "Ticket creado con éxito.";
   } else {
      echo "Error al crear el ticket: " . $conn->error;
   }

   // Cierra la conexión a la base de datos
   $conn->close();
?>
