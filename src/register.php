<!DOCTYPE html>
<html>
<head>
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <!-- Resto del código -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<body>
  <div class="container">
    <h2>Registro de Usuario</h2>
    <form action="register.php" method="POST">
      <div class="form-group">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
  </div>
  <script src="ruta_al_archivo_bootstrap.min.js"></script>
</body>
</html>
<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los valores enviados por el formulario
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Aquí puedes realizar validaciones adicionales, como verificar si el usuario ya existe

  // Conexión a la base de datos
  $conn = new mysqli($servername, $user, $pass, $dbname);
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Insertar el usuario en la base de datos
  $sql = "INSERT INTO usuarios (usuario, clave) VALUES ('$username', '$password')";
  if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
  } else {
    echo "Error al registrar el usuario: " . $conn->error;
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
}
?>
