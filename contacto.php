<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - Padel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- CSS personalizado -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="https://assets-global.website-files.com/6127fb2c77e53513fea9657c/612d38df9b48bca5bd62f48b_padel-tech-logo.png" alt="Logo" width="200" height="auto" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="players.php">Players</a></li>
                <li class="nav-item"><a class="nav-link" href="reserva.php">Reservas</a></li>
                <li class="nav-item"><a class="nav-link" href="usuario.php">Usuario</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron text-center">
        <div class="overlay"></div>
        <div class="content">
            <h1>¿Necesitas nuestra ayuda?</h1>
            <p class="lead" style="font-weight: bold;">Estamos aquí para ayudarte con cualquier pregunta o problema.</p>
        </div>
    </div>

    <!-- Formulario de contacto -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center"> <!-- Centro horizontal y vertical -->
        <div class="col-md-6"> <!-- Ancho del formulario -->
            <h3 class="text-center">Formulario de Contacto</h3> <!-- Título para el formulario -->
            <form method="POST" action="send_contact.php"> <!-- Cambia a la ruta correcta -->
                <div class="form-group mb-3"> <!-- Margen entre campos -->
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre" required>
                </div>
                <div class="form-group mb-3"> <!-- Margen entre campos -->
                    <label para="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Tu correo electrónico" required>
                </div>
                <div class="form-group mb-3"> <!-- Margen entre campos -->
                    <label para="subject">Asunto</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Asunto" required>
                </div>
                <div class="form-group mb-3"> <!-- Margen entre campos -->
                    <label para="message">Mensaje</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Escribe tu mensaje aquí" required></textarea>
                </div>
               
                <!-- Botón para enviar el formulario con margen -->
                <button type="submit" class="btn btn-primary mt-3" style="background-color: #CAD021; color: white;">Enviar</button>
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
</body>
</html>