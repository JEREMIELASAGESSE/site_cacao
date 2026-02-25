<?php
require("../config/config.php");

// Modifier une culture
if (isset($_POST['modifier'])) {
    $prod = $_POST['id_producteur'];
    $produit = $_POST['id_produit'];
    $surface = $_POST['surface_cultivee'];
    $stmt = $pdo->prepare("UPDATE Cultiver SET surface_cultivee = :surf WHERE id_producteur = :prod AND id_produit = :produit");
    $stmt->execute(['surf' => $surface, 'prod' => $prod, 'produit' => $produit]);
}

// Affichage avec formulaire de modification
$stmt = $pdo->query("
    SELECT c.id_producteur, c.id_produit, pr.nom_producteur, p.nom_produit, c.surface_cultivee, z.nom_zone
    FROM Cultiver c
    JOIN Producteur pr ON c.id_producteur = pr.id_producteur
    JOIN Produit p ON c.id_produit = p.id_produit
    JOIN Zone z ON pr.id_zone = z.id_zone
");
$cultures = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/produit.css">
    <title>Modifier Culture</title>
</head>

<body>
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
                <form method="post">
                    <td><?= $c['nom_producteur'] ?></td>
                    <td><?= $c['nom_produit'] ?></td>
                    <td><input type="number" step="0.01" name="surface_cultivee" value="<?= $c['surface_cultivee'] ?>"></td>
                    <td><?= $c['nom_zone'] ?></td>
                    <td>
                        <input type="hidden" name="id_producteur" value="<?= $c['id_producteur'] ?>">
                        <input type="hidden" name="id_produit" value="<?= $c['id_produit'] ?>">
                        <button type="submit" name="modifier">Modifier</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>