<?php
session_start();
include("conexion.php");
$email = $_SESSION["email"];
$password = $_SESSION["password"];
$username = $_SESSION["username"];
$iduser = $_SESSION["iduser"];
if (isset($_POST["username"])) {
    $newname = $_POST["username"];
    $newemail = $_POST["email"];
    $newpassword = $_POST["password"];
    $sql = 'UPDATE user 
    SET username = ?, email = ?, password = ? 
    WHERE iduser = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $newname);
    $stmt->bindParam(2, $newemail);
    $stmt->bindParam(3, $newpassword);
    $stmt->bindParam(4, $iduser);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "Usuario actualizado con éxito";
        $_SESSION["username"] = $newname;
        $_SESSION["email"] = $newemail;
        $_SESSION["password"] = $newpassword;
        header("Location: " . $_SERVER['PHP_SELF']); // Recargar la misma página
        exit(); // Asegurarse de que no haya más ejecución de código después del header
    } else {
        echo "No se realizó ninguna actualización";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar Información del Usuario - Padel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- CSS personalizado -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->

    <!-- Navbar -->
   <!-- Barra de Navegación -->
   <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <a class="navbar-brand d-flex align-items-center" href="./">
            <img src="https://assets-global.website-files.com/6127fb2c77e53513fea9657c/612d38df9b48bca5bd62f48b_padel-tech-logo.png" alt="Logo" width="200" height="auto" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link">
                        <?php
                        if (isset($_SESSION["username"])) {
                            echo $_SESSION["username"];
                        } ?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="partidas">Partidas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mis_reservas">Mis reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuario">Usuario</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fas fa-sign-out-alt"></i> Salir</a> <!-- Enlace para cerrar sesión -->
                </li>
            </ul>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron text-center">
        <div class="overlay"></div>
        <div class="content">
            <h1>Actualiza tu <i>información</i></h1>
            <p class="lead" style="font-weight: bold;">Mantén tus datos al día para una mejor experiencia.</p>
        </div>
    </div>

    <!-- Formulario para actualizar datos del usuario -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center"> <!-- Centro horizontal y vertical -->
        <div class="col-md-6"> <!-- Ancho del formulario -->
            <h2 class="text-center">Tus datos de usuario</h2> <!-- Título para el formulario -->
            <form method="POST" action=""> <!-- Cambia a la ruta correcta -->
                <div class="form-group mb-3"> <!-- Margen entre campos -->
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>" placeholder="Nuevo nombre de usuario">
                </div>
                <div class="form-group mb-3"> <!-- Margen entre campos -->
                    <label para="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" placeholder="Nuevo correo electrónico">
                </div>
                <div class="form-group mb-3"> <!-- Margen entre campos -->
                    <label para="password">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>" placeholder="Nueva contraseña">
                </div>

                <!-- Botón para actualizar con margen para separación -->
                <button type="submit" class="btn btn-primary mt-3" style="background-color: #CAD021; color: white;">Actualizar</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-center text-white p-4">
        <div class="container-fluid">
            <p class="mb-0" style="color: #CAD021;">App creada por Nico, Gabi, Sofía, Pablo y Adri</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/players.js"></script> <!-- Archivo para control de JavaScript -->
</body>

</html>