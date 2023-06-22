<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los valores enviados por el formulario
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Conexión a la base de datos
  $conn = new mysqli($servername, $user, $pass, $dbname);
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Consultar el usuario en la base de datos
  $sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND clave = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    // Usuario válido, iniciar sesión
    $_SESSION['usuario'] = $username;
    header("Location: index.php");
    exit();
  } else {
    echo "Nombre de usuario o contraseña incorrectos.";
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
}
?>





<!DOCTYPE html>
<html>
<head>
  <title>Iniciar Sesión</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
  </div>
  <script src="ruta_al_archivo_bootstrap.min.js"></script>
</body>
</html>

