<?php
// Informations de connexion à la base de données
$db_host = 'localhost'; // Adresse de l'hôte
$db_name = 'admin_car'; // Nom de la base de données
$db_user = 'root'; // Nom d'utilisateur
$db_pass = ''; // Mot de passe
try {
    // Créer une instance de PDO
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Gérer les erreurs de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
