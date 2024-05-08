<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- CSS personalizado -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="https://assets-global.website-files.com/6127fb2c77e53513fea9657c/612d38df9b48bca5bd62f48b_padel-tech-logo.png" alt="Logo" width="200" height="auto" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="players.php">Players</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reserva.php">Reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuario.php">Usuario</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal centrado -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center"> <!-- Centro horizontal y vertical -->
        <div class="text-center"> <!-- Centrar el contenido -->
            <h2>Reserva de pista y horario</h2>
            <p>Pista seleccionada: <?php echo $idpista; ?></p>
            <p>Fecha seleccionada: <?php echo $fecha; ?></p>

            <!-- Formulario centrado con margen -->
            <h2>Agregar jugadores:</h2>
            <form action="newplayer.php" method="post" class="text-center" style="margin: 20px;"> <!-- Espacio para el formulario -->
                <!-- Campo del primer jugador con margen -->
                <div class="player mb-3"> <!-- Margen inferior para espacio -->
                    <label for="username1">Nombre jugador 1:</label>
                    <input type="text" name="username" id="username1" placeholder="Nombre" required>
                </div>

                <!-- Campo del segundo jugador con margen -->
                <div class="player mb-3"> <!-- Margen inferior para espacio -->
                    <label for="username2">Nombre jugador 2:</label>
                    <input type="text" name="username" id="username2" placeholder="Nombre" required>
                </div>

                <!-- Campo del tercer jugador con margen -->
                <div class="player mb-3"> <!-- Margen inferior para espacio -->
                    <label for="username3">Nombre jugador 3:</label>
                    <input type="text" name="username" id="username3" placeholder="Nombre" required>
                </div>

                <!-- Botones con margen superior -->
                <div class="mt-3"> <!-- Margen superior -->
                    <button type="submit" class="btn btn-primary" style="background-color: #CAD021; color: white;">Guardar</button>
                    <button type="submit" class="btn btn-secondary" formaction="confirmacion_reserva.php">Finalizar reserva</button>
                    <a href="index.php" class="btn btn-danger">Cancelar reserva</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-center text-white p-4"> <!-- Fondo oscuro -->
        <div class="container-fluid"> <!-- Ancho completo -->
            <p class="mb-0" style="color: #CAD021;">App creada por Nico, Gabi, Sofía, Pablo y Adri</p>
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>