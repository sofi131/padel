<?php
    include("conexion.php");
    $sql = "select * from court";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Would you like to play Padel?</h1>
    <div class="container">
        <div class="row">
            <?php foreach($results as $court): ?>
                <div class="col-md-4">
                    <div class="card productcard">
                        <h2><?php echo $court['name']; ?></h2>
                        <img src="assets/img/<?php echo $court['image']; ?>" class="card-img-top" alt="<?php echo $court['name']; ?>">
                        <div class="card-body">
                            <a href="reservar.php?idcourt=<?php echo $court['idcourt']; ?>" class="btn btn-primary">Reserve this court</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
