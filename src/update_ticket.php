<?php
session_start();
require_once '../config.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
  // Redirigir al formulario de inicio de sesión si el usuario no está autenticado
  header("Location: login.php");
  exit();
}

// Verificar si se envió el formulario de resolución del ticket
if (isset($_POST['resolve'])) {
  // Obtener el ID del ticket desde el formulario
  $ticketId = $_POST['ticketId'];

  // Obtener el usuario que interviene en la resolución del ticket
  $usuarioInterviene = $_SESSION['usuario'];
   $resolucion = $_SESSION['usuario'];
   $resolutionReason = $_POST['resolutionReason'];

  // Realizar la conexión a la base de datos (ajusta los valores según tu configuración)
  //$conn = new mysqli('localhost', 'id20920072_cil', 'Can@lla123', 'id20920072_tickets');


  // Crear la conexión
  $conn = new mysqli($servername, $user, $pass, $dbname);

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
  }

  // Actualizar el estado del ticket en la base de datos
  $sql = "UPDATE tickets SET estado = 'Realizado', usuario_interviene = '$usuarioInterviene', resolucion = '$resolutionReason' WHERE id = $ticketId";

  if ($conn->query($sql) === TRUE) {
    // La actualización fue exitosa
    header("Location: index.php");
    exit();
  } else {
    // Ocurrió un error al actualizar el ticket
    echo "Error al resolver el ticket";
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
} else {
  // Redirigir a index.php si no se envió el formulario de resolución del ticket
  header("Location: index.php");
  exit();
}
?>
