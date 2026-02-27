<?php
require("../config/config.php");

// Ajouter ou mettre à jour plusieurs cultures
if (isset($_POST['ajouter'])) {
    $producteur = $_POST['id_producteur'];
    $produits = $_POST['produits']; // tableau des produits cochés
    $surfaces = $_POST['surfaces']; // tableau des superficies

    foreach ($produits as $id_produit) {
        $surface = $surfaces[$id_produit] ?? null;
        if (!empty($surface)) {
            $stmt = $pdo->prepare("
                INSERT INTO cultiver (id_producteur, id_produit, surface_cultivee)
                VALUES (:prod, :produit, :surf)
                ON DUPLICATE KEY UPDATE surface_cultivee = VALUES(surface_cultivee)
            ");
            $stmt->execute([
                'prod' => $producteur,
                'produit' => $id_produit,
                'surf' => $surface
            ]);
        }
    }
}

// Modifier une culture (surface seulement)
if (isset($_POST['modifier'])) {
    $prod = $_POST['id_producteur'];
    $produit = $_POST['id_produit'];
    $surface = $_POST['surface_cultivee'];
    $stmt = $pdo->prepare("UPDATE Cultiver 
                           SET surface_cultivee = :surf 
                           WHERE id_producteur = :prod AND id_produit = :produit");
    $stmt->execute(['surf' => $surface, 'prod' => $prod, 'produit' => $produit]);
}

// Supprimer une culture
if (isset($_GET['supprimer'])) {
    $prod = $_GET['prod'];
    $produit = $_GET['produit'];
    $stmt = $pdo->prepare("DELETE FROM cultiver 
                           WHERE id_producteur = :prod AND id_produit = :produit");
    $stmt->execute(['prod' => $prod, 'produit' => $produit]);
}

// Afficher les cultures
$stmt = $pdo->query("
    SELECT c.id_producteur, c.id_produit, pr.nom_producteur, p.nom_produit, c.surface_cultivee, z.nom_zone
    FROM cultiver c
    JOIN producteur pr ON c.id_producteur = pr.id_producteur
    JOIN produits p ON c.id_produit = p.id_produit
    JOIN zone z ON pr.id_zone = z.id_zone
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
    <h1 class="font1"><strong>GESTION COMPLETE DES CULTURES</strong></h1>
    <ul style="border-radius: 30px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none;"><strong>RETOUR</strong></a></li>
    </ul>

    <!-- Formulaire d'ajout -->
    <form method="post">
        <label>Producteur :</label>
        <select name="id_producteur" required>
            <?php
            $producteurs = $pdo->query("SELECT * FROM producteur")->fetchAll();
            foreach ($producteurs as $pr) {
                echo "<option value='{$pr['id_producteur']}'>" . htmlspecialchars($pr['nom_producteur']) . "</option>";
            }
            ?>
        </select>

        <h3>Produits cultivés :</h3>
        <?php
        $produits = $pdo->query("SELECT * FROM produits")->fetchAll();
        foreach ($produits as $p) {
            echo "<div>
                   <input type='checkbox' name='produits[{$p['id_produit']}]' value='{$p['id_produit']}'> " . htmlspecialchars($p['nom_produit']) . "
                   <input type='text' name='surfaces[{$p['id_produit']}]' placeholder='Surface'>
               </div>";
        }
        ?>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <!-- Tableau d'affichage -->
    <h2>Liste des cultures</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Producteur</th>
            <th>Produit</th>
            <th>Surface</th>
            <th>Zone</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cultures as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['nom_producteur']) ?></td>
                <td><?= htmlspecialchars($c['nom_produit']) ?></td>
                <td>
                    <!-- Formulaire inline pour modifier la surface -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id_producteur" value="<?= $c['id_producteur'] ?>">
                        <input type="hidden" name="id_produit" value="<?= $c['id_produit'] ?>">
                        <input type="text" name="surface_cultivee" value="<?= htmlspecialchars($c['surface_cultivee']) ?>">

                    </form>
                </td>
                <td><?= htmlspecialchars($c['nom_zone']) ?></td>
                <td>

                    <button type="submit" name="modifier">🖉</button>
                    <a href="?supprimer&prod=<?= $c['id_producteur'] ?>&produit=<?= $c['id_produit'] ?>"
                        onclick="return confirm('Supprimer cette culture ?')">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>