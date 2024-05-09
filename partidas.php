<?php
session_start();
include "conexion.php";

$sql_pistas = "SELECT R.idreservation, R.idtimetable, R.idcourt, c.name, c.img, t.time, r.playdate,
COUNT(*) AS Players, (4 - COUNT(*)) AS espacios_libres
FROM padel.reservation R
INNER JOIN play P ON R.idreservation = P.idreservation
JOIN court c ON R.idcourt = c.idcourt
JOIN timetable t ON R.idtimetable = t.idtimetable
JOIN (
    SELECT idreservation, COUNT(*) AS num_players
    FROM play
    GROUP BY idreservation
) AS player_counts ON R.idreservation = player_counts.idreservation
GROUP BY R.idreservation, R.idtimetable, R.idcourt, c.name, c.img, t.time, r.playdate
HAVING Players < 4;";
$stm = $conn->prepare($sql_pistas);
$stm->execute();
$pistas = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Partidas Disponibles - Padel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- CSS personalizado -->
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <a class="navbar-brand d-flex align-items-center" href="./"> <!-- Logo e imagen -->
            <img src="https://assets-global.website-files.com/6127fb2c77e53513fea9657c/612d38df9b48bca5bd62f48b_padel-tech-logo.png" alt="Logo" width="200" height="auto" class="me-2"> <!-- Tamaño del logo -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> <!-- Menú alineado a la derecha -->
            <li class="nav-item"><a class="nav-link" href="partidas">Partidas</a></li>
                <li class="nav-item"><a class="nav-link" href="mis_reservas">Mis reservas</a></li>
                <li class="nav-item"><a class="nav-link" href="usuario">Usuario</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron text-center">
        <div class="overlay"></div> <!-- Superposición verde -->
        <div class="content"> <!-- Texto del jumbotron -->
            <h1>Partidas Disponibles</h1>
            <p class="lead" style="font-weight: bold;">Únete a las partidas con plazas disponibles.</p>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="flex-grow-1"> <!-- Para empujar el footer hacia abajo -->
    <div class="container mt-4"> <!-- Margen superior -->
        <div class="row mt-3"> <!-- Uso de filas para organizar las cards -->
            <?php foreach ($pistas as $pista) : ?>
                <div class="col-md-4 mb-4"> <!-- Columnas más estrechas -->
                    <div class="card"> <!-- Tarjeta para la pista -->
                        <img src="assets/img/<?php echo $pista["img"]; ?>" class="card-img-top" alt="Imagen de la pista" style="height:100px width:auto;"> <!-- Imagen más baja -->
                        <div class="card-body"> <!-- Contenido de la tarjeta -->
                            <h5 class="card-title"><?php echo $pista["name"]; ?></h5> <!-- Nombre de la pista -->
                            <p>En esta partida hay <?php echo $pista["espacios_libres"]; ?> espacios libres.</p> <!-- Espacios disponibles -->
                            <p>Horario: <?php echo $pista["playdate"]; ?> a las <?php echo $pista["time"]; ?></p> <!-- Fecha y hora -->
                            
                            <!-- Formulario para inscribirse a la pista -->
                            <form action="" method="post">
                                <input type="hidden" name="idreserva" value="<?php echo $pista["idreservation"]; ?>">
                                <input type="hidden" name="idpista" value="<?php echo $pista["idcourt"]; ?>">
                                <label class="mb-3" >Ingresa tu nombre para inscribirte:</label>
                                <input  type="text" name="user" class="form-control mb-3" required> <!-- Campo para el nombre -->
                                <button type="submit" class="btn btn-primary" style="background-color: #CAD021; color: white;">Inscribirse</button> <!-- Botón para inscribirse -->
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-center text-white p-4"> <!-- Fondo negro -->
        <div class="container-fluid"> <!-- Ancho completo -->
            <p class="mb-0" style="color: #CAD021;">App creada por Nico, Gabi, Sofía, Pablo y Adri</p> <!-- Texto de crédito -->
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
