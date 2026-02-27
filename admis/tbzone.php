<?php
require("../config/config.php");

// Ajouter une zone
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom_zone'];
    $stmt = $pdo->prepare("INSERT INTO Zone (nom_zone) VALUES (:nom)");
    $stmt->execute(['nom' => $nom]);
}

// Supprimer une zone
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $stmt = $pdo->prepare("DELETE FROM zone WHERE id_zone = :id_zone");
    $stmt->execute(['id_zone' => $id]);
}

// Afficher les zones
$stmt = $pdo->query("SELECT * FROM zone");
$zones = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion des zones</title>
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/zone.css">
</head>

<body>
    <h1 class="font1">
        <strong>GESTION COMPLETE DES ZONES</strong>
    </h1>
    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>RETOUR</strong></a></li>
    </ul>
</body>
<h2>Gestion des Zones</h2>
<form method="post">
    <input type="text" name="nom_zone" placeholder="Nom de la zone" required>
    <button type="submit" name="ajouter">Ajouter</button>
</form>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>🖉</th>
        <th>🗑️</th>
    </tr>
    <?php foreach ($zones as $z): ?>
        <tr>
            <td><?= $z['id_zone'] ?></td>
            <td><?= $z['nom_zone'] ?></td>
            <td><a href="tbmodifierZone.php?id=<?= $z['id_zone'] ?>">🖉</a></td>
            <td><a href="?supprimer=<?= $z['id_zone'] ?>">🗑️</a></td>
        </tr>
    <?php endforeach; ?>
</table>

</html>