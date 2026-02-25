<?php
require("../config/config.php");

// Ajouter plusieurs cultures
if (isset($_POST['ajouter'])) {
    $producteur = $_POST['id_producteur'];
    $produits = $_POST['produits']; // tableau des produits
    $surfaces = $_POST['surfaces']; // tableau des superficies

    foreach ($produits as $index => $id_produit) {
        $surface = $surfaces[$index];
        if (!empty($surface)) {
            $stmt = $pdo->prepare("INSERT INTO Cultiver (id_producteur, id_produit, surface_cultivee) 
                                   VALUES (:prod, :produit, :surf)");
            $stmt->execute([
                'prod' => $producteur,
                'produit' => $id_produit,
                'surf' => $surface
            ]);
        }
    }
}
// Modifier une culture la surface seulement
if (isset($_POST['modifier'])) {
    $prod = $_POST['id_producteur'];
    $produit = $_POST['id_produit'];
    $surface = $_POST['surface_cultivee'];
    $stmt = $pdo->prepare("UPDATE Cultiver SET surface_cultivee = :surf WHERE id_producteur = :prod AND id_produit = :produit");
    $stmt->execute(['surf' => $surface, 'prod' => $prod, 'produit' => $produit]);
}

// Supprimer une culture
if (isset($_GET['supprimer'])) {
    $prod = $_GET['prod'];
    $produit = $_GET['produit'];
    $stmt = $pdo->prepare("DELETE FROM Cultiver WHERE id_producteur = :prod AND id_produit = :produit");
    $stmt->execute(['prod' => $prod, 'produit' => $produit]);
}

// Afficher les cultures
$stmt = $pdo->query("
    SELECT c.id_producteur, c.id_produit, pr.nom_producteur, p.nom_produit, c.surface_cultivee, z.nom_zone
    FROM Cultiver c
    JOIN Producteur pr ON c.id_producteur = pr.id_producteur
    JOIN Produits p ON c.id_produit = p.id_produit
    JOIN Zone z ON pr.id_zone = z.id_zone
");
$cultures = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Cultures</title>
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/zone.css">
</head>

<body>
    <h1 class="font1">
        <strong>GESTION COMPLETE DES CULTURES</strong>
    </h1>
    <ul style="border-radius: 30px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none;"><strong>RETOUR</strong></a></li>
    </ul>

    <form method="post">
        <label>Producteur :</label>
        <select name="id_producteur" required>
            <?php
            $producteurs = $pdo->query("SELECT * FROM Producteur")->fetchAll();
            foreach ($producteurs as $pr) {
                echo "<option class='producteur-option' value='{$pr['id_producteur']}'>{$pr['nom_producteur']}</option>";
            }
            ?>
        </select>

        <h3>Produits cultivés :</h3>
        <?php
        $produits = $pdo->query("SELECT * FROM Produits")->fetchAll();
        foreach ($produits as $index => $p) {
            echo "<div>
                    <input type='checkbox' name='produits[]' value='{$p['id_produit']}'> {$p['nom_produit']}
                    <input type='number' step='0.01' name='surfaces[]' placeholder='Surface cultivée'>
                  </div>";
        }
        ?>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <h2>Liste des cultures</h2>
    <table border="1">
        <tr>
            <th>Producteur</th>
            <th>Produit</th>
            <th>Surface</th>
            <th>Zone</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cultures as $c): ?>
            <tr>
                <td><?= $c['nom_producteur'] ?></td>
                <td><?= $c['nom_produit'] ?></td>
                <td><?= $c['surface_cultivee'] ?></td>
                <td><?= $c['nom_zone'] ?></td>
                <td>
                    <a href="?modifier&id=<?= $c['id_producteur'] ?>&produit=<?= $c['id_produit'] ?>"><button type="submit" name="modifier">🖉</button></a>
                    <a href="?supprimer&prod=<?= $c['id_producteur'] ?>&produit=<?= $c['id_produit'] ?>" onclick="return confirm('Supprimer cette culture ?')">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>