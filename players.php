
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/player.css">
    <title>Player</title>
</head>
<body>
        
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
</body>
</html>



