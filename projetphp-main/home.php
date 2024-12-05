<?php
// Votre code de connexion à la base de données ici...

require_once 'config.php';
// Sélectionner toutes les voitures de la base de données
$sql = "SELECT * FROM carctere";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Voitures</title>
    <link rel="stylesheet" href="home.css"> <!-- Assurez-vous d'ajuster le chemin vers votre fichier CSS -->
</head>
<body>

<div class="container">
    <?php
    // Vérifier s'il y a des enregistrements dans le résultat
    if ($result->num_rows > 0) {
        // Parcourir chaque enregistrement
        while($row = $result->fetch_assoc()) {
    ?>
            <div class="card">
                <div class="card-content">
                    <div class="card-title-wrapper">
                        <h3 class="h3 card-title"><?php echo $row["marque"] . " " . $row["modele"]; ?></h3>
                        <data class="year" value="<?php echo $row["anee"]; ?>"><?php echo $row["anee"]; ?></data>
                    </div>
                    <ul class="card-list">
                        <li class="card-list-item">
                            <ion-icon name="people-outline"></ion-icon>
                            <span class="card-item-text"><?php echo $row["modele"]; ?>  </span>
                        </li>
                        <li class="card-list-item">
                            <ion-icon name="flash-outline"></ion-icon>
                            <span class="card-item-text"><?php echo $row["matricule"]; ?></span>
                        </li>
                        <!-- Ajoutez d'autres éléments de votre base de données ici... -->
                    </ul>
                    <div class="card-price-wrapper">
                        <p class="card-price"><strong><?php echo $row["deponibilite"]; ?></strong> / month</p>
                        <button class="btn fav-btn" aria-label="Add to favourite list"><ion-icon name="heart-outline"></ion-icon></button>
                        <button class="btn">Rent now</button>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "Aucune voiture trouvée";
    }
    ?>
</div>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
