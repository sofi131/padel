<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Olvidé mi Contraseña - Padel App</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->
    <!-- Superposición negra con opacidad -->
    <div class="body-overlay"></div>

    <div class="container vh-100 d-flex justify-content-center align-items-center"> <!-- Centrar vertical y horizontal -->
        <div class="col-md-6 login-form"> <!-- Aplicar estilo de formulario -->
            <!-- Título de la página -->
            <h2 class="text-center text-white">Recuperar Contraseña</h2>
            
            <!-- Formulario para recuperar la contraseña -->
            <form method="POST" action="send_reset_link.php"> <!-- Ruta al script que maneja la recuperación -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu correo electrónico" required> <!-- Campo para el email -->
                </div>
                <button type="submit" class="btn btn-green btn-block">Enviar enlace de recuperación</button> <!-- Botón verde -->
            </form>
            
            <!-- Opciones adicionales -->
            <div class="text-center mt-3"> <!-- Espacio para opciones adicionales -->
                <a href="login.php" class="text-white">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
