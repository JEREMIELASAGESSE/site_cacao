<?php
include("../config/config.php");

// Vérifie que l'ID est présent
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Identifiant manquant.";
    exit;
}

$id = $_GET['id'];

// Récupère les données
$stmt = $pdo->prepare("SELECT * FROM partenaire WHERE id = ?");
$stmt->execute([$id]);
$u = $stmt->fetch();

if (!$u) {
    echo "Partenaire introuvable.";
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom_U']);
    $prenom = trim($_POST['prenom_U']);
    $contact = trim($_POST['contact_U']);
    $adresse = trim($_POST['Adresse_U']);
    $date = $_POST['date'];

    // Vérifications
    if (!$nom || !$prenom ||  !$contact || !$adresse || !$date) {
        $errors[] = "Tous les champs doivent être remplis.";
    }


    if (!preg_match('/^\d{10}$/', $contact)) {
        $errors[] = "Le contact doit contenir 10 chiffres.";
    }

    // Gestion de l'image
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        if (!str_starts_with($_FILES['photo']['type'], 'image/')) {
            $errors[] = "Le fichier doit être une image.";
        } else {
            // Supprime l'ancienne image
            if (!empty($u['photo']) && file_exists('uploads/' . $u['photo'])) {
                unlink('uploads/' . $u['photo']);
            }

            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $photo = uniqid('user_') . '.' . $extension;
            $target = 'uploads/' . $photo;
            move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        }
    } else {
        $photo = $u['photo']; // Conserve l'image existante
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE partenaire SET nom_U=?, prenom_U=?, contact_U=?, Adresse_U=?, date=?, photo=? WHERE id=?");
        $stmt->execute([$nom, $prenom, $contact, $adresse, $date, $photo, $id]);

        header("Location:tbpartenaire.php");
        exit;
    }
}
?>

<!-- Formulaire HTML -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier partenaire</title>
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/produit.css">
    <style>
        :root {
            --cacao-brun: #4E342E;
            --cafe-brun: #6D4C41;
            --beige-creme: #F5F5DC;
            --vert-feuillage: #388E3C;
            --or-dore: #D4AF37;
            --blanc-casse: #FAF9F6;
            --or-dore-claire: #e1b00d;
            --noire-police: #131211;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;

        }

        form {
            background-color: #fff;
            padding: 30px;
            max-width: 650px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 2px;
            color: var(--beige-creme);
            font-size: 2.5rem;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px 0 0 10px;
            /* Bord gauche arrondi */
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: var(--cafe-brun);
            color: white;
            border: none;
            border-radius: 0 20px 20px 0;
            /* Bord droit arrondi */
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--cacao-brun);
        }

        #previewContainer {
            max-width: 650px;
            max-height: 250px;
        }

        #previewContainer img {
            max-height: 240px;
        }

        table {
            margin-top: 0.6rem;
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: var(--cacao-brun);
            color: white;
        }

        td img {
            max-width: 100px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <h1 id="previewContainer">Modifier le partenaire</h1>

        <?php if (!empty($errors)): ?>
            <div style="color:red;">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <input type="text" name="nom_u" value="<?= htmlspecialchars($u['nom_u']) ?>" required>
        <input type="text" name="prenom_u" value="<?= htmlspecialchars($u['prenom_u']) ?>" required>
        <input type="text" name="contact_u" value="<?= htmlspecialchars($u['contact_u']) ?>" required>
        <input type="text" name="adresse_u" value="<?= htmlspecialchars($u['adresse_u']) ?>" required>
        <input type="date" name="date" value="<?= htmlspecialchars($u['date']) ?>" required>
        <p>Photo actuelle :</p>
        <img src="uploads/<?= htmlspecialchars($u['photo']) ?>" width="100"><br>
        <label>Changer la photo :</label>
        <input type="file" name="photo" id="imageInput" accept="image/*"><br><br>
        <input type="submit" value="Mettre à jour">
    </form>
    <script src="../assets/js/equipes.js"></script>
    <script src="../assets/js/tbmembre.js"></script>
</body>

</html>