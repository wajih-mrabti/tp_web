<?php
$servername = "localhost"; // Modifier si nécessaire
$username = "root"; // Modifier si nécessaire
$password = ""; // Modifier si nécessaire
$dbname = "admin_car"; // Modifier si nécessaire

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Ajout d'une nouvelle voiture
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $anee = $_POST['anee'];
    $matricule = $_POST['matricule'];
    $deponibilite = $_POST['deponibilite'];
    // Vérifier si une image a été téléchargée
    if(isset($_FILES['image'])) {
        $image = $_FILES['image']['tmp_name'];
        // Vérifier si le téléchargement de l'image a réussi
        if($image != "") {
            $imgContent = addslashes(file_get_contents($image));
            $sql = "INSERT INTO carctere (marque, modele, anee, matricule, image,deponibilite) VALUES ('$marque', '$modele', '$anee', '$matricule', '$imgContent','$deponibilite')";
            if ($conn->query($sql) === TRUE) {
                echo "Nouvelle voiture ajoutée avec succès";
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Veuillez sélectionner une image.";
        }
    } else {
        echo "L'image n'a pas été correctement téléchargée.";
    }
}

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
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="test.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Brand Name</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="dio">
            <form action="#" method="POST" enctype="multipart/form-data">
                <input type="text" id="marque" name="marque" placeholder="Marque" required>
                <div class="price">
                    <input type="file" id="image" name="image" accept="image/*" required>

                    <input type="text" id="modele" name="modele" placeholder="Modèle" required>
                    <input type="text" id="anee" name="anee" placeholder="Année" required>
                    <input type="text" id="matricule" name="matricule" placeholder="Matricule" required>
                    <input type="text" id="deponibilite" name="deponibilite" placeholder="deponibilité" required>
                </div>
                <button type="submit">Ajouter Voiture</button>
            </form>

            <div class="outputs">
                <h1>Liste des Voitures</h1>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Année</th>
                        <th>Immatriculation</th>
                        <th>Disponibilité</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["id"]."</td>";
                            echo "<td>".$row["marque"]."</td>";
                            echo "<td>".$row["modele"]."</td>";
                            echo "<td>".$row["anee"]."</td>";
                            echo "<td>".$row["matricule"]."</td>";
                            echo "<td>".$row["deponibilite"]."</td>";
                            echo "<td><img src='data:image/jpeg;base64,".base64_encode($row['image'])."' width='100' height='100'></td>";
                            echo "<td><a href=\"modification.php?id=".$row['id']."\">Modifier</a> | <a href=\"suppression.php?id=".$row['id']."\">Supprimer</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Aucune voiture trouvée</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

<?php
$conn->close();
?>
