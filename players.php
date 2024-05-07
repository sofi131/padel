<?php
//el valor de la opcion de hora se manda el id y la fecha si se manda el value

//agregar reserva
include 'conexion.php';
session_start();
if (isset($_POST["fecha"])) {
    $_SESSION["fecha"] =  $_POST["fecha"];
    $_SESSION["opcion"] = $_POST["opcion"];
}
var_dump($_SESSION['iduser']);
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
    <title>Document</title>
</head>

<body>
    <h1>players</h1>
    <input type="text" name="fecha" value="<?php echo $_POST['fecha'] ?? ''; ?>">
    <input type="text" name="opcion" value="<?php echo $_POST['opcion'] ?? ''; ?>">


    <form method="post" action="newplayer">
        <label for="username1">Ingrese un usuario </label>
        <input type="text" id="username" name="username" required><br><br>

        <input type="submit" value="Enviar">
    </form>
    <?php
    if(isset($_SESSION["error"])) echo $_SESSION["error"];
    ?>

</body>

</html>