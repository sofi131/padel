<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION["iduser"])) {
    header("Location: login");
    exit();
}
$iduser = $_SESSION["iduser"];
$_SESSION["idpista"] = $_GET["idcourt"];
//traer horas de la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió la fecha oculta
    if (isset($_POST["fecha_seleccionada"])) {
        // Obtener la fecha recibida
        $fecha_seleccionada = $_POST["fecha_seleccionada"];
    }
}
$fecha_seleccionada = isset($_POST["fecha_seleccionada"]) ? $_POST["fecha_seleccionada"] : date('Y-m-d');

// Formatear la fecha en el formato adecuado "yyyy-MM-dd"
$fecha_formateada = date('Y-m-d', strtotime($fecha_seleccionada));
// Obtener horas de la base de datos
$sql = "SELECT T.idtimetable, T.time
FROM timetable T
LEFT JOIN (
    SELECT idtimetable, playdate, COUNT(DISTINCT p.username) AS num_reservas
    FROM reservation r
    JOIN play p ON r.idreservation = p.idreservation
    WHERE r.playdate = ?
    GROUP BY idtimetable, playdate
) R ON T.idtimetable = R.idtimetable
WHERE R.num_reservas < 4 OR R.num_reservas IS NULL";
$stm = $conn->prepare($sql);
$stm->execute([$fecha_seleccionada]);
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

    <body class="d-flex flex-column min-vh-100"> <!-- Flex para mantener el footer al fondo -->
        <!-- Jumbotron -->
        <div class="jumbotron text-center">
            <div class="overlay"></div>
            <div class="content">
                <h1>Reserva tu <i>pista</i></h1>
                <p class="lead" style="font-weight: bold;">Experiencia las mejores pistas de toda Galicia.</p>
            </div>
        </div>
        <!-- Contenido principal -->
        <div class="container flex-grow-1 my-5"> <!-- Margen para separar el contenido -->


            <!-- Formulario principal -->
            <form action="players" method="post">
                <div class="mb-3"> <!-- Grupo de fecha con margen -->
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required value="<?php echo $fecha_seleccionada; ?>"> <!-- Form-control -->
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


            <form id="formulario" method="POST" action="">
                <input type="hidden" id="fecha_seleccionada" name="fecha_seleccionada">
            </form>

            <!-- Formulario para agregar usuarios -->

        </div>
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
        <!--<script src="./assets/js/reserva.js"></script>-->
        <script>
            // Obtener el elemento de entrada de fecha
            var fechaInput = document.getElementById("fecha");

            // Almacenar la fecha seleccionada inicialmente
            var fechaSeleccionadaInicial = fechaInput.value;

            // Agregar un event listener para el evento change
            fechaInput.addEventListener("change", function() {
                // Obtener el valor seleccionado (la fecha)
                var fechaSeleccionada = fechaInput.value;

                // Asignar la fecha al campo oculto del formulario
                document.getElementById("fecha_seleccionada").value = fechaSeleccionada;

                // Enviar el formulario
                document.getElementById("formulario").submit();

                // Restaurar la fecha seleccionada inicialmente después de enviar el formulario
                fechaInput.value = fechaSeleccionadaInicial;
            });
        </script>
    </body>

</html>