<?php
include("conexion.php");
session_start();
if (isset($_POST["email"])) {
    $sql = "select * from user where email = ? and password = ?";
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stm = $conn->prepare($sql);
    $stm->bindParam(1, $email);
    $stm->bindParam(2, $password);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $iduser = $result["iduser"];
        $_SESSION["iduser"] = $iduser;
        $_SESSION["username"] = $username;
        header("Location: ./");
    }else{
        $error = "Invalid Credentials";
    }
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
    <form action="index.php" method="post">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="submit" value="Sing in">
    </form>
</body>

</html>