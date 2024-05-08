<?php
session_start();
$msg = null;
include ("conexion.php");
//Funcion de registro
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "insert into user (username,email,password) values(?,?,?)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(1, $username);
    $stm->bindParam(2, $email);
    $stm->bindParam(3, $password);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        header("Location: login");
    } else {
        $error = "No se ha podido crear el usuario";
    }
} else {
    $error = "No hay datos para enviar";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Padel App</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/register.css"> <!-- Vínculo al CSS de registro -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->

<div class="body-overlay"></div> <!-- Capa de superposición -->

<div class="container vh-100 d-flex justify-content-center align-items-center"> <!-- Centrar vertical y horizontal -->
    <div class="col-md-6 form-container"> <!-- Aplicar estilo al formulario -->
        <!-- Título del formulario -->
        <h2 class="text-center">Registro de Usuario</h2>
        
        <!-- Mostrar mensaje de confirmación o error -->
        <?php if ($msg): ?>
            <div class='alert alert-<?php echo (strpos($msg, "correctamente") !== false) ? "success" : "danger"; ?> text-center'><?php echo $msg; ?></div>
        <?php endif; ?>

        <!-- Formulario de registro -->
        <form method="POST" action="">
            <div class="form-group">
                <label para="username" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label para="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label para="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
           
            <!-- Botón verde -->
            <button type="submit" class="btn btn-green btn-block">Registrarse</button> <!-- Botón verde -->
        </form>
        
        <!-- Opciones adicionales -->
        <div class="text-center mt-3"> <!-- Espacio para opciones adicionales -->
            <a href="login.php" class="text-white">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
