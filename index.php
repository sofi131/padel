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
</head>
<body>

<!-- Barra de Navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Padel App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto"> <!-- ms-auto alinea a la derecha -->
            <li class="nav-item">
                <a class="nav-link" href="#">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Players</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Reservas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Usuario</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Jumbotron para el título centralizado -->
<div class="jumbotron text-center bg-primary text-white py-5">
    <h1>Would you like to play <i>Padel</i>?</h1>
    <p class="lead">Experience the best courts and matches in the city.</p>
</div>

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
                        <a href="reservar.php?idcourt=<?php echo intval($court['idcourt']); ?>" class="btn btn-primary">Reserve this court</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Incluyendo Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
