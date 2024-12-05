<?php
// modification.php
require_once 'config.php';
// Vérifier si l'ID de la voiture à modifier est présent dans la requête
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de la voiture à modifier
    $sql = "SELECT * FROM carctere WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Aucune voiture trouvée avec cet ID.";
        exit();
    }
} else {
    echo "ID de voiture manquant.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Voiture</title>
</head>
<body>
    <h1>Modifier une Voiture</h1>
    <form action="update_car.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="marque">Marque:</label>
        <input type="text" id="marque" name="marque" value="<?php echo $row['marque']; ?>" required><br><br>
        <label for="modele">Modèle:</label>
        <input type="text" id="modele" name="modele" value="<?php echo $row['modele']; ?>" required><br><br>
        <label for="annee">Année:</label>
        <input type="text" id="annee" name="annee" value="<?php echo $row['anee']; ?>" required><br><br>
        <label for="matricule">Immatriculation:</label>
        <input type="text" id="matricule" name="matricule" value="<?php echo $row['matricule']; ?>" required><br><br>
        <button type="submit">Mettre à Jour</button>
    </form>
</body>
</html>
