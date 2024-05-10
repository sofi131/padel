<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Players</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- CSS personalizado -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->

    <!-- Navbar -->
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
                        session_start();
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
            <h1>Reserva tu <i>pista y horario</i></h1>
            <p class="lead" style="font-weight: bold;">Experiencia las mejores pistas de toda Galicia.</p>
        </div>
    </div>

    <!-- Contenido principal con mensaje de confirmación -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center"> <!-- Centro horizontal y vertical -->
        <div class="text-center">
            <h2 class="display-4">¡Tu reserva ha sido confirmada!</h2> <!-- Título grande -->
            <p class="lead">Te esperamos en nuestras pistas. ¡Disfruta tu juego!</p> <!-- Texto de bienvenida -->

            <!-- Botón para reservar de nuevo -->
            <a href="index.php" class="btn btn-lg btn-primary" style="background-color: #CAD021; color: white;">¿Reservar de nuevo?</a> <!-- Botón para redirigir al index -->
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