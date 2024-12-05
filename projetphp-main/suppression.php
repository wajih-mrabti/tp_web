<?php
require_once 'config.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer la voiture de la base de données
    $sql = "DELETE FROM carctere WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: affichage.php?message=Voiture supprimée avec succès.");
        exit();
    } else {
        echo "Erreur lors de la suppression de la voiture : " . $conn->error;
    }
} else {
    echo "ID de voiture manquant.";
}

$conn->close();
?>

