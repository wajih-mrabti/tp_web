<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';
if (isset($_GET['voiture_id'])) {
    $voiture_id = $_GET['voiture_id'];

    // Requête SQL pour obtenir les détails de la voiture
    $sql = "SELECT * FROM carctere WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $voiture_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $voiture = $result->fetch_assoc();
    } else {
        echo "Voiture non trouvée.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID de voiture non fourni.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Voiture</title>
    <link rel="stylesheet" href="widget.css">
</head>

<body>
    <h1>Réserver la Voiture</h1>
    <div>
        <h2><?php echo $voiture['marque']; ?> - <?php echo $voiture['modele']; ?></h2>
        <p>Année : <?php echo $voiture['anee']; ?></p>
        <p>Immatriculation : <?php echo $voiture['matricule']; ?></p>
        <p>Disponibilité : <?php echo $voiture['deponibilite']; ?></p>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($voiture['image']); ?>" alt="Voiture">
    </div>

    <form action="confirmer_reservation.php" method="POST">
        <input type="hidden" name="voiture_id" value="<?php echo $voiture['id']; ?>">
        <label for="date_debut">Date de début :</label>
        <input type="date" id="date_debut" name="date_debut" required>
        <label for="date_fin">Date de fin :</label>
        <input type="date" id="date_fin" name="date_fin" required>
        <button type="submit">Confirmer la Réservation</button>
    </form>
</body>

</html>
