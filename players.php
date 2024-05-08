
<?php
include 'conexion.php';
session_start();
if (isset($_POST["fecha"])) {
    $_SESSION["fecha"] =  $_POST["fecha"];
    $_SESSION["opcion"] = $_POST["opcion"];
}

if (!isset($_SESSION["idreserva"])) {
    if (isset($_SESSION['fecha']) && isset($_SESSION["opcion"])) {
        $fecha = $_SESSION["fecha"];
        $idtime = $_SESSION["opcion"];
        $idpista = $_SESSION["idpista"];
        $sql_reserva = "insert into reservation (idtimetable,idcourt,playdate) values (?,?,?)";
        $result = $conn->prepare($sql_reserva);
        $result->bindParam(1, $idtime);
        $result->bindParam(2, $idpista);
        $result->bindParam(3, $fecha);
        $result->execute();
        if ($result->rowCount() == 1) {
            $idreserva = $conn->lastInsertId();
            $_SESSION["idreserva"] = $idreserva;
            echo 'salio bien';
        } else {
            echo 'salio mal';
        }
    }
} else {
    $idreserva = $_SESSION["idreserva"];
}
?>




<!--mi parte-->
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top"> <!-- Navbar blanco -->
        <a class="navbar-brand d-flex align-items-center" href="/"> <!-- Logo e imagen -->
            <img src="https://assets-global.website-files.com/6127fb2c77e53513fea9657c/612d38df9b48bca5bd62f48b_padel-tech-logo.png" alt="Logo" width="200" height="auto" class="me-2"> <!-- Tamaño del logo -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> <!-- Menú alineado a la derecha -->
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/players">Players</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/reservas">Reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal PARA ELEGIR PISTA Y JUGADORES-->
    <h2>Reserva de pista y horario</h2>
        <p>Pista seleccionada: <?php echo $idpista; ?></p>
        <p>Fecha seleccionada: <?php echo $fecha; ?></p>

    <h2>Agregar jugadores:</h2>

    <form action="newplayer.php" method="post">
        <div class="player">
            <input type="hidden" name="iduser1" >
            <label for="username1">Nombre jugador 1:</label>
            <input type="text" name="username" id="username1" placeholder="Nombre" required>
        </div>

        <div class="player">
            <input type="hidden" name="iduser2" >
            <label for="username2">Nombre jugador 2:</label>
            <input type="text" name="username" id="username2" placeholder="Nombre" required>
        </div>

        <div class="player">
            <input type="hidden" name="iduser3" >
            <label for="username3">Nombre jugador 3:</label>
            <input type="text" name="username" id="username3" placeholder="Nombre" required>
        </div>

        <button type="submit">Guardar</button>
        <button type="submit" formaction="confirmacion_reserva.php">Finalizar reserva</button>
        <div class="button-container">
        <a href="index.php" class="button cancel-button">Cancelar reserva</a>
        </div>
    </form>
    <?php
            if(isset($error)){
                echo "<p>".$error."</p>";
            }
    ?>

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


