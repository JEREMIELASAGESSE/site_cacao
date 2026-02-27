<?php
// Connexion à la base
require "../config/config.php";

// --- AJOUT ---
if (isset($_POST['ajouter'])) {
    $libelle = $_POST['libelle'];
    $sql = "INSERT INTO type_action (libelle) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$libelle]);
    echo "<p style='color:green'>Type d’action ajouté avec succès.</p>";
}

// --- MODIFICATION ---
if (isset($_POST['modifier'])) {
    $id = $_POST['id_type_action'];
    $libelle = $_POST['libelle'];
    $sql = "UPDATE type_action SET libelle=? WHERE id_type_action=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$libelle, $id]);
    echo "<p style='color:blue'>Type d’action modifié avec succès.</p>";
}

// --- SUPPRESSION ---
if (isset($_POST['supprimer'])) {
    $id = $_POST['id_type_action'];
    $sql = "DELETE FROM type_action WHERE id_type_action=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    echo "<p style='color:red'>Type d’action supprimé avec succès.</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Types d’Action</title>
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/zone.css">
</head>

<body>
    <h1 class="font1">
        <strong>GESTION DES TYPES D'ACTIONS</strong>
    </h1>
    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>RETOUR</strong></a></li>
    </ul>
    <!-- Formulaire d’ajout -->
    <form method="post">
        <input type="text" name="libelle" placeholder="Nom du type d’action" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <!-- Liste des types d’action -->
    <table>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        $result = $pdo->query("SELECT * FROM type_action");
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['id_type_action'] . "</td>
                    <td>" . $row['libelle'] . "</td>
                    <td>
                        <form method='post' style='display:inline'>
                            <input type='hidden' name='id_type_action' value='" . $row['id_type_action'] . "'>
                            <input type='text' name='libelle' value='" . $row['libelle'] . "' required>
                            <button type='submit' name='modifier'>Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' style='display:inline'>
                            <input type='hidden' name='id_type_action' value='" . $row['id_type_action'] . "'>
                            <button type='submit' name='supprimer' onclick='return confirm(\"Supprimer ce type ?\")'>Supprimer</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>

</html>