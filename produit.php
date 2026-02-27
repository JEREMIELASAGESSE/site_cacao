<?php
include("config/config.php");

// Ajouter un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom_produit'];
  $description = $_POST['description'];
  $date = $_POST['date'];

  // Gestion de l'image
  $photo = $_FILES['photo']['name'];
  $target = 'uploads/' . basename($photo);
  move_uploaded_file($_FILES['photo']['tmp_name'], $target);

  $stmt = $pdo->prepare("INSERT INTO produits (nom_produit, description, date, photo) VALUES (?, ?, ?, ?)");
  $stmt->execute([$nom, $description, $date, $photo]);
}

// Supprimer un produit
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
  $stmt->execute([$id]);
  header("Location: tbproduits.php");
  exit;
}
// Récupérer les produits
$produits = $pdo->query("SELECT * FROM produits")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="assets/images/logo/logo.png">
  <link rel="stylesheet" href="assets/styles/index.css">
  <title>Nos produits</title>
</head>

<body>
  <?php include('menu.php'); ?>
  <div class="home-page__background_produit">
    <h1 class="titre"><strong>NOUS AVONS DES PRODUITS DE QUALITES</strong></h1>
    <!-- <img src="" alt="Image de fond" class="home-page__image" class="produit-image"> -->
  </div>
  <section class="propos-page">

    <?php foreach ($produits as $produit): ?>
      <div class="equipes">
        <div class="cart-produit">
          <img src="admis/uploads/<?= htmlspecialchars($produit['photo']) ?>" alt="<?= htmlspecialchars($produit['nom_produit']) ?>" class="produit-image">
          <div class="produit-details">
            <h2><?= htmlspecialchars($produit['nom_produit']) ?></h2>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
  <?php include 'footer.php'; ?>
</body>

</html>