<?php
//el valor de la opcion de hora se manda el id y la fecha si se manda el value

//agregar reserva
include 'conexion.php';
session_start();    
$fecha = $_POST["fecha"];
$idtime = $_POST["opcion"];
$idpista = $_SESSION["idpista"];
$sql_reserva ="insert into reservation (idtimetable,idcourt,playdate) values (?,?,?)";
$result = $conn->prepare($sql_reserva);
$result->bindParam(1, $idtime);
$result->bindParam(2, $idpista);
$result->bindParam(3, $fecha);
$result->execute();
if($result->rowCount() == 1){
    echo 'salio bien';

}else{
    echo 'salio mal';
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



</body>
</html>