<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservations"; // Assurez-vous que c'est le bon nom de la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voiture_id = $_POST['voiture_id'];
    $client_id = $_SESSION['user_id'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    // Vérifiez que les dates sont valides
    if (empty($date_debut) || empty($date_fin)) {
        die("Veuillez fournir des dates de début et de fin valides.");
    }

    // Requête SQL pour insérer la réservation
    $sql = "INSERT INTO Reservations (DateDeDebut, DateDeFin, Voiture_ID, Client_ID) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $date_debut, $date_fin, $voiture_id, $client_id);

    if ($stmt->execute()) {
        echo "Réservation réussie!";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
</head>

<body>
    <h1>Confirmation de Réservation</h1>
    <p>Votre réservation a été enregistrée avec succès!</p>
    <a href="index.php">Retour à la page d'accueil</a>
</body>

</html>
