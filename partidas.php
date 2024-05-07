<?php
session_start();
include "conexion.php";
$sql_pistas = "SELECT R.idreservation,R.idtimetable,R.idcourt,c.name,c.img,t.time,r.playdate,count(*) as Players 
FROM padel.reservation R inner join play P on R.idreservation=P.idreservation 
join court c on R.idcourt=c.idcourt join timetable t on R.idtimetable=t.idtimetable 
group by p.idreservation,R.idreservation,R.idtimetable,R.idcourt,c.name,c.img,t.time,R.playdate
having Players<4";
$stm = $conn->prepare($sql_pistas);
$stm->execute();
$pistas = $stm->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST["idreserva"])){
    $idreserva = $_POST ["idreserva"];
    $username = $_POST["user"];
    $iduser = $_SESSION["iduser"];
    $sql = "insert into play (iduser,idreservation,username) values (?,?,?)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(1,$iduser);
    $stm->bindParam(2,$idreserva);
    $stm->bindParam(3,$username);
    $stm->execute();
    if($stm->rowCount() > 0){
        echo "pudiste meterte a la pista";
    }else{
        echo "no pudiste entrar a la pista";
    }
}
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

    <!-- Contenido principal -->
    <div class="pistas">
        <?php
        foreach ($pistas as $pista) {
            echo '<div class="pista">
            <img src="' . $pista["img"] . '" alt="Imagen de la pista">
            <p>' . $pista["name"] . '</p>
            <form action="" method="post">
            <p>'. $pista['time'] .'</p>
            <p>'. $pista['playdate'] .'</p>
            <input type="hidden" name="idreserva" value="' . $pista["idreservation"] . '">
            <input type="hidden" name="idpista" value="' . $pista["idcourt"] . '">
            <label>ingresa el nombre</label>
            <input type="text" name="user" >
            <button type="submit" >Inscribirte a la pista </button>
            </form>
            </div>';
        }
        ?>
    </div>

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
            <label for="opcion_' . $opcion["idtimetable"] . '">'. $opcion["time"] . '</label>
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
    if(isset($_SESSION["error"])) echo $error;
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