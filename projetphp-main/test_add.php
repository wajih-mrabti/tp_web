<?php
// add_car.php
require_once 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $anee = $_POST['annee'];
    $matricule = $_POST['matricule'];

    $sql = "INSERT INTO carctere (marque, modele, anee, matricule) VALUES ('$marque', '$modele', '$anee', '$matricule')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle voiture ajoutée avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

