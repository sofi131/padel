<?php
session_start();
include "conexion.php";
$sql_pistas = "SELECT R.idreservation,R.idtimetable,R.idcourt,c.name,c.img,t.time,count(*) as Players 
FROM padel.reservation R inner join play P on R.idreservation=P.idreservation 
join court c on R.idcourt=c.idcourt join timetable t on R.idtimetable=t.idtimetable 
group by p.idreservation,R.idreservation,R.idtimetable,R.idcourt,c.name,c.img,t.time
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
    <title>Document</title>
</head>
<body>
<div class="pistas">
        <?php
        foreach ($pistas as $pista) {
            echo '<div class="pista">
            <img src="' . $pista["img"] . '" alt="Imagen de la pista">
            <p>' . $pista["name"] . '</p>
            <form action="" method="post">
            <p>'. $pista['time'] .'</p>
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
</body>
</html>