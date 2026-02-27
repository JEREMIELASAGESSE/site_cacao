<?php
require '../config/config.php';

// Ajouter une durabilité
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom_durabilite'];
    $desc = $_POST['description'];
    $stmt = $pdo->prepare("INSERT INTO urabilite (nom_durabilite, description) VALUES (:nom, :desc)");
    $stmt->execute(['nom' => $nom, 'desc' => $desc]);
}

// Modifier une durabilité
if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom_durabilite'];
    $desc = $_POST['description'];
    $stmt = $pdo->prepare("UPDATE Durabilite SET nom_durabilite = :nom, description = :desc WHERE id = :id");
    $stmt->execute(['nom' => $nom, 'desc' => $desc, 'id' => $id]);
}

// Supprimer une durabilité
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $stmt = $pdo->prepare("DELETE FROM durabilite WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Afficher toutes les durabilités
$stmt = $pdo->query("SELECT * FROM durabilite");
$durabilites = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion de la durabilité</title>
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/zone.css">
</head>

<body>
    <h1 class="font1">
        <strong>GESTION COMPLETE DES DURABILITES</strong>
    </h1>
    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>RETOUR</strong></a></li>
    </ul>
    <h2>Gestion des Durabilités</h2>

    <!-- Formulaire d'ajout -->
    <form method="post">
        <input type="text" name="nom_durabilite" placeholder="Nom de la durabilité" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <!-- Tableau d'affichage -->
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>

        </tr>
        <?php foreach ($durabilites as $d): ?>
            <tr>
                <form method="post">
                    <td><?= $d['id'] ?></td>
                    <td><input type="text" name="nom_durabilite" value="<?= $d['nom_durabilite'] ?>"></td>
                    <td><textarea name="description"><?= $d['description'] ?></textarea></td>
                    <td>
                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                        <button type="submit" name="modifier">🖉</button>
                        <a href="?supprimer=<?= $d['id'] ?>" onclick="return confirm('Supprimer ?')">🗑️</a>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>