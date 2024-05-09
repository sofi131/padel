<?php
session_start();
$error = null;

if (isset($_POST["email"])) {
    try {
        require_once("conexion.php");
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        // Consulta SQL para verificar usuario y contraseña
        $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
        $stm = $conn->prepare($sql);
        $stm->bindParam(1, $email);
        $stm->bindParam(2, $password);
        $stm->execute();
        
        // Si el usuario es encontrado, inicia la sesión y redirige
        if ($stm->rowCount() > 0) {
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            $username = $result["username"];
            $iduser = $result["iduser"];
            
            $_SESSION["username"] = $username;
            $_SESSION["iduser"] = $iduser;
            
            header("Location: ./");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } catch (Exception $e) {
        $error = "Error interno: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión - Padel App</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->
 <!-- Superposición negra con opacidad -->
 <div class="body-overlay"></div> <!-- Capa de superposición -->

    <div class="container vh-100 d-flex justify-content-center align-items-center"> <!-- Centrar vertical y horizontal -->
        <div class="col-md-6 login-form"> <!-- Aplicar estilo de formulario -->
            <!-- Título de la página -->
            <h2 class="text-center text-white">Iniciar Sesión</h2>
            
            <!-- Mostrar mensaje de error si existe -->
            <?php if ($error): ?>
                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Formulario de inicio de sesión -->
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label para="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-green btn-block">Iniciar Sesión</button> <!-- Botón verde -->
            </form>
            
            <!-- Opciones adicionales -->
            <div class="text-center mt-3"> <!-- Espacio para opciones adicionales -->
                <a href="register.php" class="text-white">¿No tienes una cuenta? Regístrate</a><br>
                <a href="forgot_password.php" class="text-white">¿Olvidaste tu contraseña?</a> <!-- Texto blanco -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
