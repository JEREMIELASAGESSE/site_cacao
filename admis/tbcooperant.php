<?php
require("../config/config.php");

// Ajouter un producteur
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom_producteur'];
    $contact = $_POST['contact'];
    $zone = $_POST['id_zone'];
    $stmt = $pdo->prepare("INSERT INTO producteur (nom_producteur, contact, id_zone) VALUES (:nom, :contact, :zone)");
    $stmt->execute(['nom' => $nom, 'contact' => $contact, 'zone' => $zone]);
}

// Supprimer un producteur
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $stmt = $pdo->prepare("DELETE FROM producteur WHERE id_producteur = :id");
    $stmt->execute(['id' => $id]);
}

// Afficher les producteurs
$stmt = $pdo->query("SELECT pr.*, z.nom_zone FROM producteur pr JOIN zone z ON pr.id_zone = z.id_zone");
$producteurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion des coopérants</title>
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/zone.css">
</head>

<body>
    <h1 class="font1">
        <strong>GESTION COMPLETE DES COOPERANTS</strong>
    </h1>
    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>RETOUR</strong></a></li>
    </ul>

    <body>
        <h2>Gestion des Producteurs</h2>
        <form method="post">
            <input type="text" name="nom_producteur" placeholder="Nom du producteur" required>
            <input type="text" name="contact" placeholder="Contact">
            <select name="id_zone" required>
                <?php
                $zones = $pdo->query("SELECT * FROM zone")->fetchAll();
                foreach ($zones as $z) {
                    echo "<option value='{$z['id_zone']}' class='zone-option'>{$z['nom_zone']}</option>";
                }
                ?>
            </select>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Contact</th>
                <th>Zone</th>
                <th>✏️</th>
                <th>🗑️</th>
            </tr>
            <?php foreach ($producteurs as $p): ?>
                <tr>
                    <td><?= $p['id_producteur'] ?></td>
                    <td><?= $p['nom_producteur'] ?></td>
                    <td><?= $p['contact'] ?></td>
                    <td><?= $p['nom_zone'] ?></td>
                    <td><a href="tbmodifierCooperant.php?id=<?= $p['id_producteur'] ?>">✏️</a></td>
                    <td><a href="?supprimer=<?= $p['id_producteur'] ?>">🗑️</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>

</html>