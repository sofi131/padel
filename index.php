<?php
// Conexión a la base de datos
include("conexion.php");
session_start();
// Obtener todas las canchas de la base de datos
$sql = "SELECT * FROM court";
$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!--parte bonita-->
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
                    if(isset($_SESSION["username"])) {
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
        <!-- Jumbotron -->
        <div class="jumbotron text-center">
            <div class="overlay"></div>
            <div class="content">
                <h1>¿Te gustaría jugar al <i>Padel</i>?</h1>
                <p class="lead" style="font-weight: bold;">Experiencia las mejores pistas de toda Galicia.</p>
            </div>
        </div>

        <!-- Sección sobre Padel Tech -->
           <!-- Nueva sección para la información sobre Padel Tech -->
    <div class="page-section-white">
        <div class="home-intro w-container" style="text-align: justify-center; font-size: 1.1em;"> <!-- Texto justificado -->
            <h2 class="h1-centre-black"><strong class="h1-bold">Padel Tech es el proveedor líder de pistas de pádel en Galicia</strong></h2>
            <p class="p-intro">
                Padel Tech ha instalado muchas pistas en Galicia y en otros lugares del mundo. Somos el distribuidor exclusivo para España de AFP Courts | adidas, ofreciendo un suministro personalizado y soluciones de instalación de pistas de pádel para cada tipo de lugar. Nuestros servicios especializados incluyen estudio del sitio, diseño de pistas, planos técnicos, planificación, construcción, y mantenimiento de pistas de pádel.
            </p>
            <p class="p-intro">
                Todas nuestras pistas tienen al menos una garantía de cinco años. Somos líderes en el suministro y la instalación de pistas de pádel, garantizando la máxima calidad y durabilidad. Descubre por qué somos la mejor opción para tu próximo proyecto de pádel.
            </p>
        </div>
    </div>

        <!-- Sección "Elige tu cancha preferida" -->
        <div class="page-section-white">
            <div class="w-container">
                <h2 class="h1-centre-black"><strong class="h1-bold">Elige tu cancha preferida</strong></h2>
                <div class="container my-5">
                    <div class="row justify-content-center">
                        <?php foreach ($results as $court): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 text-center">
                                    <?php if (isset($court['image']) && !empty($court['image'])): ?>
                                        <img src="assets/pistas/<?php echo htmlspecialchars($court['image'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($court['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php else: ?>
                                        <img src="assets/pistas/padel.jpeg" class="card-img-top" alt="Imagen por defecto">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($court['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                        <a href="reserva.php?idcourt=<?php echo intval($court['idcourt']); ?>" class="btn" style="background-color: #CAD021; color: white;">Reservar esta cancha</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
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
