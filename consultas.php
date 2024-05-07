<?php
include 'conexion.php';
session_start();
//Funcion de login
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "select * from user where username=? and password=?";
    $stm = $conn->prepare($sql);
    $stm->bindParam(1, $username);
    $stm->bindParam(2, $password);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $iduser = $row["iduser"];
        $_SESSION["iduser"] = $iduser;
        $_SESSION["username"] = $username;
        header("Location: ./");
    } else {
        $error = "No se ha encontrado el usuario";
    }
} else {
    $error = "No hay datos para enviar";
}


//Funcion de registro
/*if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "insert into user (username,email,password) values(?,?,?)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(1, $username);
    $stm->bindParam(2, $email);
    $stm->bindParam(3, $password);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        header("Location: login");
    } else {
        $error = "No se ha podido crear el usuario";
    }
} else {
    $error = "No hay datos para enviar";
}
*/
//para mostrar el error <?phpif(isset($error)){echo $error;} "cierra el archivo php"

//Funcion para traer pistas
$sql_pistas = "select * from court";
$stm = $conn->prepare($sql_pistas);
$stm->execute();
$pistas = $stm->fetchAll(PDO::FETCH_ASSOC);

//traer los datos de las pistas  
//  <?php
//foreach ($pistas as $pista) {
// echo '<div class="pista">
//<img src="' . $pista["imagen"] . '" alt="Imagen de la pista">
//<p>' . $pista["name"] . '</p>
//<input type="hidden" name="pistaId" value="'. $pista["idcourt"] . '">
//</div>';
// }
//cierra php

//crear reserva

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
</head>

<body>

    <div class="pistas">
        <?php
        foreach ($pistas as $pista) {
            echo '<div class="pista">
            <img src="' . $pista["img"] . '" alt="Imagen de la pista">
            <p>' . $pista["name"] . '</p>
            <form action="reserva" method="post">
            <input type="hidden" name="idpista" value="' . $pista["idcourt"] . '">
            <button type="submit" >Seleccionar Pista </button>
            </form>
            </div>';
        }
        ?>
    </div>

    <form action="" method="post">
        <input type="text" name="username">
        <input type="text" name="password">
        <button type="submit"></button>
    </form>
</body>

<a href="partidas">PARTIDAS</a>

</html>