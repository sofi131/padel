<?php
include 'conexion.php';
session_start();
var_dump($_SESSION['iduser']);
$iduser = $_SESSION["iduser"];
//traer horas de la base de datos
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar si se recibió la fecha oculta
    if (isset($_GET["fecha_oculta"])) {
        // Obtener la fecha recibida
        $fecha = $_GET["fecha_oculta"];
        echo "Fecha recibida: " . $fecha;
    } else {
        echo "Error: No se recibió la fecha.";
    }
}
$fecha_seleccionada = isset($_GET["fecha_oculta"]) ? $_GET["fecha_oculta"] : date('Y-m-d');

// Formatear la fecha en el formato adecuado "yyyy-MM-dd"
$fecha_formateada = date('Y-m-d', strtotime($fecha_seleccionada));

$sql = "SELECT T.idtimetable, T.time
FROM timetable T
LEFT JOIN reservation R ON T.idtimetable = R.idtimetable AND R.playdate = ?
GROUP BY T.idtimetable, T.time
HAVING COUNT(*) < 4 OR COUNT(*) IS NULL";
$stm = $conn->prepare($sql);
$stm->execute([$fecha_seleccionada]);
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["idpista"])) {
    $_SESSION["idpista"] = $_POST["idpista"];
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
    <h1>reserva</h1>
    <form action="players" method="post">
        <div>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required value="<?php echo $fecha_seleccionada; ?>">
        </div>
        <div>
            <label>Selecciona una opción:</label>
            <?php

            foreach ($result as $opcion) {
                echo '<div>
            <input type="radio" id="opcion_' . $opcion["idtimetable"] . '" name="opcion" value="' . $opcion["idtimetable"] . '">
            <label for="opcion_' . $opcion["idtimetable"] . '">' . $opcion["time"] . '</label>
            </div>';
            }
            ?>
        </div>
        <div>
            <button type="submit" name="accion" value="seleccionar">Seleccionar</button>
        </div>

    </form>
    <form id="formulario" method="get" action="">
        <input type="hidden" id="fecha_oculta" name="fecha_oculta">
    </form>
    <script>
        // Obtener el elemento de entrada de fecha
        var fechaInput = document.getElementById("fecha");

        // Almacenar la fecha seleccionada inicialmente
        var fechaSeleccionadaInicial = fechaInput.value;

        // Agregar un event listener para el evento change
        fechaInput.addEventListener("change", function() {
            // Obtener el valor seleccionado (la fecha)
            var fechaSeleccionada = fechaInput.value;
            console.log("Fecha seleccionada:", fechaSeleccionada);

            // Asignar la fecha al campo oculto del formulario
            document.getElementById("fecha_oculta").value = fechaSeleccionada;

            // Enviar el formulario
            document.getElementById("formulario").submit();

            // Restaurar la fecha seleccionada inicialmente después de enviar el formulario
            fechaInput.value = fechaSeleccionadaInicial;
        });
    </script>
</body>

</html>