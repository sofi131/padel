<?php
if(isset($_POST["username"])){
    include("conexion.php");
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
   
 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $sql="insert into user (username,email,password,image) values (?,?,?,?)";
            $stm=$conn->prepare($sql);
            $stm->bindParam(1,$username);
            $stm->bindParam(2,$email);
            $stm->bindParam(3,$password);
            $stm->execute();
            if($stm->rowCount()>0){
                $msg="Usuario creado correctamente";
            }else{
                $msg="Error al crear el Usuario";
            }

        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="username" id="" placeholder="username">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="file" name="file" id="">
        <button type="submit">New</button>
    </form>
    <?php
    if(isset($msg)){
        echo "<p>".$msg."</p>";
    }
    ?>
</body>
</html>