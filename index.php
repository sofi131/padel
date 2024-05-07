<?php
// Conexión a la base de datos
include("conexion.php");

// Obtener todas las canchas de la base de datos
$sql = "SELECT * FROM court";
$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet"> <!-- Vínculo al archivo CSS externo -->
</head>
<body>

<!-- Barra de Navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top"> <!-- Navbar blanco -->
    <a class="navbar-brand d-flex align-items-center" href="/"> <!-- Clase para alinear el logo y el texto -->
        <!-- Imagen de pelota -->
        <img src="https://assets-global.website-files.com/6127fb2c77e53513fea9657c/612d38df9b48bca5bd62f48b_padel-tech-logo.png" alt="Logo" width="200" height="auto" class="me-2"> <!-- Tamaño de la pelota -->
    </a>

    <!-- Botón para dispositivos móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú de navegación -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto"> <!-- ms-auto para alinear a la derecha -->
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
                <a class="nav-link" href="/usuario">Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contacto</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Jumbotron para el título centralizado -->
<div class="jumbotron text-center">
    <div class="overlay"></div> <!-- Superposición verde con opacidad -->
    <div class="content"> <!-- Texto del jumbotron -->
        <h1>Would you like to play <i>Padel</i>?</h1>
        <p class="lead" style="font-weight: bold;">Experience the best courts and matches in the city.</p> <!-- Texto más grueso -->
    </div>
</div>

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

<!-- Título cancha -->
<div class="page-section-white">
    <div class="home-intro w-container" style="text-align: justify-center; font-size: 1.1em;"> <!-- Texto justificado -->
        <h2 class="h1-centre-black"><strong class="h1-bold">Elige tu cancha preferida</strong></h2>
        
<!-- Tarjetas para las canchas -->
<div class="container my-5">

    <div class="row justify-content-center">
        <?php foreach ($results as $court): ?>
            <div class="col-md-4 mb-4"> <!-- Margin entre tarjetas -->
                <div class="card h-100 text-center"> <!-- Ajuste de altura para uniformidad -->
                    <?php if (isset($court['image']) && !empty($court['image'])): ?>
                        <img src="assets/pistas/<?php echo htmlspecialchars($court['image'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($court['name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?php else: ?>
                        <img src="assets/pistas/padel.jpeg" class="card-img-top" alt="Imagen por defecto">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($court['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                        <a href="reservar.php?idcourt=<?php echo intval($court['idcourt']); ?>" class="btn" style="background-color: #CAD021; color: white;">Reservar esta cancha</a> <!-- Botón verde -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
