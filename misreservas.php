<?php
session_start();

// Verificar si el usuario está logeado
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está logeado
    exit();
}

// Conexión a la base de datos
include("conexion.php");

if(isset($_POST['eliminar_reserva'])) {
    $idreservation = $_POST['idreservation'];

    // Eliminar la reserva de la base de datos
    $sql_delete_reservation = "DELETE FROM reservation WHERE idreservation = :idreservation";
    $stmt = $conn->prepare($sql_delete_reservation);
    $stmt->bindParam(':idreservation', $idreservation, PDO::PARAM_INT);
    $stmt->execute();
}

// Obtener el ID del usuario actual
$username = $_SESSION["username"];
$iduser = $_SESSION["iduser"];


// Obtener las reservas del usuario actual

$sql_reservations = 'SELECT R.idreservation, R.playdate, C.name, C.img, COUNT(*) as jugadores 
FROM reservation R 
INNER JOIN play P ON R.idreservation = P.idreservation
INNER JOIN court C ON R.idcourt = C.idcourt
WHERE P.iduser = :user_id AND DATE(R.playdate) >= CURDATE() 
GROUP BY P.iduser, R.idreservation
ORDER BY R.playdate DESC;
';
$query_reservations = $conn->prepare($sql_reservations);
$query_reservations->bindParam(":user_id", $iduser, PDO::PARAM_INT);
$query_reservations->execute();
$reservations = $query_reservations->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- Vínculo al archivo CSS -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener footer al final -->

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
                    <a class="nav-link">
                        <?php
                        if (isset($_SESSION["username"])) {
                            echo $_SESSION["username"];
                        } ?></a>
                </li>

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

    <!-- Contenido Principal -->
    <div class="flex-grow-1"> <!-- Para empujar el footer hacia abajo -->
        <div class="container">
            <h2>Mis Reservas</h2>
            <div class="row mt-3">
                <?php foreach ($reservations as $reservation) : ?>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <img src="assets/img/<?php echo $reservation['img']; ?>" class="card-img-top" alt="...">

                                <h5 class="card-title"><?php echo $reservation['name']; ?></h5>
                                <p class="card-text">Horario: <?php echo $reservation['playdate']; ?></p>
                                <p class="card-text">Nº jugadores: <?php echo $reservation['jugadores']; ?></p>
                            
                            <form action="" method="POST">
                                <input type="hidden" name="idreservation" value="<?php echo $reservation['idreservation']; ?>">
                                <button type="submit" name="eliminar_reserva" class="btn btn-danger">Eliminar Reserva</button>
                            </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div> <!-- Fin de la sección de contenido -->

    <!-- Footer -->
    <footer class="footer bg-dark text-center text-white p-4"> <!-- Fondo negro -->
        <div class="container-fluid">
            <p class="mb-0" style="color: #CAD021;">App creada por Nico, Gabi, Sofía, Pablo y Adri.</p>
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>