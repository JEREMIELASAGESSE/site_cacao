<?php
// Connexion à la base
require '../config/config.php';

// Création de la table si elle n'existe pas
$pdo->query("CREATE TABLE IF NOT EXISTS annonces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL
)");

// --- AJOUTER UNE ANNONCE ---
if (isset($_POST['ajouter'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stmt = $pdo->prepare("INSERT INTO annonces (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);
}

// --- MODIFIER UNE ANNONCE ---
if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stmt = $pdo->prepare("UPDATE annonces SET title=?, description=? WHERE id=?");
    $stmt->execute([$title, $description, $id]);
}

// --- SUPPRIMER UNE ANNONCE ---
if (isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM annonces WHERE id=?");
    $stmt->execute([$id]);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des annonces</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo/logo.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-cacabrun {
            background-color: #8B4513;
            /* Brun chocolat */
            color: white;
        }

        .btn-cacabrun:hover {
            background-color: #5C3317;
            /* Brun plus foncé au survol */
            color: white;
        }

        .card-header {
            background-color: rgb(48, 22, 3);
            /* Brun chocolat */
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">
    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>RETOUR</strong></a></li>
    </ul>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestion des annonces</h1>
        <!-- Liste des annonces -->
        <div class="card mb-4">
            <div class="card-header text-white">Liste des annonces</div>
            <div class="card-body">
                <?php
                $result = $pdo->query("SELECT * FROM annonces");
                if ($result->rowCount() > 0) {
                    echo "<table class='table table-striped'>";
                    echo "<thead><tr><th>ID</th><th>Titre</th><th>Description</th></tr></thead><tbody>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['description'] . "</td></tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p class='text-muted'>Aucune annonce disponible.</p>";
                }
                ?>
            </div>
        </div>

        <!-- Formulaire Ajouter -->
        <div class="card mb-4">
            <div class="card-header text-white">Ajouter une annonce</div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" name="ajouter" class="btn btn-cacabrun">Ajouter ➕</button>
                </form>
            </div>
        </div>

        <!-- Formulaire Modifier -->
        <div class="card mb-4">
            <div class="card-header text-white">Modifier une annonce</div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="number" name="id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nouveau titre</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nouvelle description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" name="modifier" class="btn btn-cacabrun">Modifier ✏️</button>
                </form>
            </div>
        </div>

        <!-- Formulaire Supprimer -->
        <div class="card mb-4">
            <div class="card-header text-white">Supprimer une annonce</div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="number" name="id" class="form-control" required>
                    </div>
                    <button type="submit" name="supprimer" class="btn btn-cacabrun">Supprimer 🗑️</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>