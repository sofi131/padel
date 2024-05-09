<?php
include 'conexion.php';
session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["idreserva"])) {
    if (isset($_POST["username"])) {
        $iduser = $_SESSION["iduser"];
        $idreserva = $_SESSION["idreserva"];
        $username = $_POST["username"];

        // Verificar si hay 4 jugadores asociados a la reserva
        $sql_count_players = "SELECT COUNT(*) AS total_players FROM play WHERE idreservation = ?";
        $stmt = $conn->prepare($sql_count_players);
        $stmt->bindParam(1, $idreserva);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_players = $row['total_players'];

        if ($total_players == 4) {
            $error = "No se puede agregar otro jugador, ya hay 4 jugadores en esta reserva.";
            $_SESSION["error"] = $error;
            unset($_SESSION["idreserva"]);
            header("Location: ./");
        } else {
            // Insertar el nuevo jugador
            $sql = 'INSERT INTO play (iduser, idreservation, username) VALUES (?, ?, ?)';
            $result = $conn->prepare($sql);
            $result->bindParam(1, $iduser);
            $result->bindParam(2, $idreserva);
            $result->bindParam(3, $username);
            $result->execute();
            $i = 2;
            do {
                $jugador = "username" . $i;
                if (isset($_POST[$jugador])) {
                    if ($_POST[$jugador] != "") {
                        $nombre = $_POST[$jugador];
                        $sql = "insert into play (iduser,idreservation,username) values (?,?,?)";
                        $result = $conn->prepare($sql);
                        $result->bindParam(1, $iduser);
                        $result->bindParam(2, $idreserva);
                        $result->bindParam(3, $nombre);
                        $result->execute();
                    }
                }
                $i++;
            } while ($i <= 4);
        }

        if ($result->rowCount() == 1) {
            header('Location: players');
            exit; // Terminar el script después de redirigir
        }
    } else {
        header('Location: players');
        exit; // Terminar el script después de redirigir
    }
}

// Si no hay sesión o falta algún dato necesario, redirigir a la página principal
header('Location: ./');
