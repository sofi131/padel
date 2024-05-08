
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

    <form method="post" action="newplayer">
        <label for="username1">Ingrese un usuario </label>
        <input type="text" id="username" name="username" required><br><br>

        <input type="submit" value="Enviar">
    </form>
    <button type="submit" formaction="confirmacion_reserva.php">Finalizar reserva</button>
    <?php
            if(isset($error)){
                echo "<p>".$error."</p>";
            }
    ?>
</body>
</html>



