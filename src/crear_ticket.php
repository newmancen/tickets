<?php
session_start();
require_once '../config.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}

// Verificar si se ha enviado el formulario de creación de tickets
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $usuario = $_SESSION['usuario'];

  // Conexión a la base de datos
  $conn = new mysqli($servername, $user, $pass, $dbname);
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Insertar el nuevo ticket en la base de datos
  $sql = "INSERT INTO tickets (titulo, descripcion, estado, usuario) VALUES ('$titulo', '$descripcion', 'pendiente', '$usuario')";
  if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
  } else {
    echo "Error al crear el ticket: " . $conn->error;
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
}
?>
