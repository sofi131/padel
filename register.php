<?php
session_start();
$msg = null;

if (isset($_POST["username"])) {
    include("conexion.php");
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Manejo del archivo cargado
    //$target_dir = "uploads/";  // directorio donde se guardarán los archivos
    //$target_file = $target_dir . basename($_FILES["file"]["name"]);
    //$image_uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

   /* if ($image_uploaded) {
        $sql = "INSERT INTO user (username, email, password, image) VALUES (?, ?, ?, ?)";
        $stm = $conn->prepare($sql);
        $stm->bindParam(1, $username);
        $stm->bindParam(2, $email);
        $stm->bindParam(3, $password);
        $stm->bindParam(4, $target_file);
        $stm->execute();

        if ($stm->rowCount() > 0) {
            $msg = "Usuario creado correctamente";
        } else {
            $msg = "Error al crear el usuario";
        }
    } else {
        $msg = "Error al subir la imagen";
    }*/
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Padel App</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container  vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <!-- Título de la página -->
        <h2 class="text-center">Registro de Usuario</h2>
        
        <!-- Mostrar mensaje de confirmación o error -->
        <?php
        if ($msg) {
            $alertType = strpos($msg, "correctamente") !== false ? "success" : "danger";
            echo "<div class='alert alert-$alertType text-center'>$msg</div>";
        }
        ?>
        
        <!-- Formulario de registro -->
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label para="username">Nombre de usuario</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label para="email">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label para="password">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
           
            <div class="form-group">
                 <!--
                <label para="file">Foto de perfil</label>
                <input type="file" class="form-control-file" name="file" required>
                -->
            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
            
        </form>
        
        <!-- Opciones adicionales -->
        <div class="text-center mt-3">
            <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</div>

<!-- Incluyendo Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
