<?php
include 'conexion.php';
session_start();
$iduser= $_SESSION["iduser"];
//traer horas de la base de datos
$sql = "select * from timetable";
$stm = $conn->prepare($sql);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>reserva</h1>
    <?php
    if(isset($_POST["idpista"])){
        $_SESSION["idpista"]=$_POST["idpista"];
        echo "el id de la pista es ".$_POST["idpista"];
    }
    ?>

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


</body>
</html>