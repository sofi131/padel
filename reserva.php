<?php
include 'conexion.php';
session_start();
$iduser = $_SESSION["iduser"];

// Obtener horas de la base de datos
$sql = "select * from timetable";
$stm = $conn->prepare($sql);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
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

    <!-- Contenido principal -->
    <div class="container flex-grow-1 my-5"> <!-- Margen para separar el contenido -->
        <h1>Reserva de pista</h1>

        <!-- Formulario principal -->
        <form action="players.php" method="post">
            <div class="mb-3"> <!-- Grupo de fecha con margen -->
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required> <!-- Form-control -->
            </div>

            <div class="mb-3"> <!-- Grupo de opciones con margen -->
                <label class="form-label">Selecciona una opción:</label>
                <?php foreach ($result as $opcion) : ?>
                    <div class="form-check"> <!-- Radio buttons -->
                        <input type="radio" class="form-check-input" id="opcion_<?php echo $opcion["idtimetable"]; ?>" name="opcion" value="<?php echo $opcion["idtimetable"]; ?>">
                        <label for="opcion_<?php echo $opcion["idtimetable"]; ?>" class="form-check-label"><?php echo $opcion["time"]; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-3"> <!-- Margen superior para botones -->
                <button type="submit" class="btn" style="background-color: #CAD021; color: white;">Seleccionar</button> <!-- Botón verde -->
            </div>
        </form>

        <!-- Formulario para agregar usuarios -->
        <form method="post" action="newplayer.php" class="mt-4"> <!-- Margen superior -->
            <div class="mb-3"> <!-- Grupo de usuario con margen -->
                <label for="username1" class="form-label">Ingrese un usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required> <!-- Form-control -->
            </div>
            <button type="submit" class="btn" style="background-color: #CAD021; color: white;">Enviar</button> <!-- Botón verde -->
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-center text-white p-4"> <!-- Fondo oscuro -->
        <div class="container-fluid"> <!-- Ancho completo -->
            <p class="mb-0" style="color: #CAD021;">App creada por Nico, Gabi, Sofía, Pablo y Adri</p> <!-- Texto de crédito -->
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>