<?php
session_start();
$msg = null;

if (isset($_POST["username"])) {
    include("conexion.php");
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Se puede agregar el manejo del archivo si se requiere cargar una imagen
    /*
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $image_uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    if ($image_uploaded) {
        $sql = "INSERT INTO user (username, email, password, image) VALUES (?, ?, ?, ?)";
        $stm = $conn->prepare($sql);
        $stm->bindParam(1, $username);
        $stm->bindParam(2, $email);
        $stm->bindParam(3, $password);
        $stm->bindParam(4, $target_file);
        $stm->execute();

        if ($stm->rowCount() > 0) {
            $msg = "Usuario creado correctamente";
        } else {
            $msg = "Error al crear el usuario";
        }
    } else {
        $msg = "Error al subir la imagen";
    }
    */
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
