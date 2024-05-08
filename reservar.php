<?php
include("conexion.php");
session_start();
$iduser = $_SESSION["iduser"];
if (isset($_GET["idcourt"])) {
    $idcourt = $_GET["idcourt"];
}

//Select all the courts 
$sql = "SELECT T.idtimetable, T.time
FROM timetable T
LEFT JOIN reservation R ON T.idtimetable = R.idtimetable AND R.playdate = ?
GROUP BY T.idtimetable, T.time";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hola mundo</h1>

    <form id="formulario" method="post" action="">
        <input type="hidden" id="fecha_selecionada" name="fecha_selecionada">
    </form>
</body>

</html>