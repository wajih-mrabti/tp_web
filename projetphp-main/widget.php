<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="widget.css">   
</head>

<body>
    <?php
    // Connexion à la base de données
    require_once 'config.php';
    // Requête SQL pour sélectionner les données des voitures
    $sql = "SELECT * FROM carctere";
    $result = $conn->query($sql);

    // Affichage des données dans des widgets
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
            <div class="widget">
                <ul>
                    <li><h2><?php echo $row["marque"]; ?></h2></li>
                    <li><?php echo $row["modele"]; ?></li>
                    <li><?php echo $row["anee"]; ?></li>
                    <li><?php echo $row["matricule"]; ?></li>
                    <li><?php echo $row["deponibilite"]; ?></li>
                    <li><img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="Voiture"></li>
                    <li>
                        <form action="reservation.php" method="GET">
                            <input type="hidden" name="voiture_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Rent Now</button>
                        </form>
                    </li>
                </ul>
            </div>
    <?php
        }
    } else {
        echo "Aucune voiture disponible.";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
    ?>
</body>

</html>
