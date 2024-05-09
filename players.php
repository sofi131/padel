<?php
include 'conexion.php';
session_start();

$success = false;

if (isset($_POST["username1"]) && isset($_POST["username2"]) && isset($_POST["username3"]) && isset($_POST["username4"])) {
    $success = true;
    // Aquí puedes agregar la lógica para guardar los datos en la base de datos
    if (!isset($_SESSION["idreserva"])) {
        if (isset($_SESSION['fecha']) && isset($_SESSION["opcion"])) {
            $fecha = $_SESSION["fecha"];
            $idtime = $_SESSION["opcion"];
            $idpista = $_SESSION["idpista"];
            $sql_reserva = "insert into reservation (idtimetable, idcourt, playdate) values (?,?,?)";
            $result = $conn->prepare($sql_reserva);
            $result->bindParam(1, $idtime);
            $result->bindParam(2, $idpista);
            $result->bindParam(3, $fecha);
            $result->execute();
            if ($result->rowCount() == 1) {
                $idreserva = $conn->lastInsertId();
                $_SESSION["idreserva"] = $idreserva;
                $success = true; // La reserva se completó
            } else {
                $success = false;
            }
        }
    }
}
?>

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
        <a class="navbar-brand d-flex align-items-center" href="index.php">
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
            <h1>Reserva tu <i>pista y horario</i></h1>
            <p class="lead" style="font-weight: bold;">Experiencia las mejores pistas de toda Galicia.</p>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1 id="jugador">Agregar jugadores:</h1>
            <form action="newplayer" method="post" class="text-center" style="margin: 20px;">
                <div class="player mb-3">
                    <label for="username1">Nombre jugador 1:</label>
                    <input type="text" name="username" placeholder="Nombre" required>
                </div>
                <div class="player mb-3">
                    <label for="username2">Nombre jugador 2:</label>
                    <input type="text" name="username2" placeholder="Nombre">
                </div>
                <div class="player mb-3">
                    <label for="username3">Nombre jugador 3:</label>
                    <input type="text" name="username3" placeholder="Nombre">
                </div>
                <div class="player mb-3">
                    <label for="username4">Nombre jugador 4:</label>
                    <input type="text" name="username4" placeholder="Nombre">
                </div>
                <!-- Botones -->
                <div class="mt-4">
                    <!-- Botón que activa el modal -->
                    <button type="submit" class="btn btn-secondary" style="background-color: #CAD021; color: white;">Finalizar reserva</button>
                    <a href="index.php" class="btn btn-danger">Cancelar reserva</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Reserva Exitosa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Pista guardada con éxito!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para error -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Por favor, complete todos los campos antes de continuar!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
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
    <script src="assets/js/players.js"></script>

</body>

</html>