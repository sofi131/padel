<?php
include 'conexion.php';
session_start();
$iduser = $_SESSION["iduser"];
//traer horas de la base de datos
$sql = "select * from timetable";
$stm = $conn->prepare($sql);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- Vínculo al archivo CSS -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener footer al fondo -->

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <a class="navbar-brand d-flex align-items-center" href="/">
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
    <div class="flex-grow-1 text-center"> <!-- Flex-grow para empujar el footer hacia abajo -->
        <h1>Reserva</h1>
        <?php
        if (isset($_POST["idpista"])) {
            $_SESSION["idpista"] = $_POST["idpista"];
            echo "el id de la pista es " . $_POST["idpista"];
        }
        ?>

        <form action="players" method="post">
            <div>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div>
                <label>Selecciona una opción:</label>
                <?php

                foreach ($result as $opcion) {
                    echo '<div>
            <input type="radio" id="opcion_' . $opcion["idtimetable"] . '" name="opcion" value="' . $opcion["idtimetable"] . '">
            <label for="opcion_' . $opcion["idtimetable"] . '">' . $opcion["time"] . '</label>
            </div>';
                }
                ?>
            </div>
            <div>
                <button type="submit" name="accion" value="seleccionar">Seleccionar</button>
            </div>

        </form>


        <form method="post" action="newplayer">
            <label for="username1">Ingrese un usuario </label>
            <input type="text" id="username" name="username" required><br><br>

            <input type="submit" value="Enviar">
        </form>
        <?php
        if (isset($_SESSION["error"])) echo $error;
        ?>
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