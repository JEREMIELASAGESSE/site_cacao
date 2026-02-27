<?php
require 'config/config.php';
$actions = $pdo->query("SELECT * FROM actions ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="assets/images/logo/logo.png">
  <link rel="stylesheet" href="assets/styles/index.css">
  <title>Nos Actions</title>
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
      padding: 20px;
    }

    #equipes {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin-top: 30px;
    }

    .cart-produit {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 800px;
      padding: 15px;
      text-align: center;
      max-height: 70vh;
      overflow: hidden;
    }

    @media (max-width: 768px) {
      .cart-produit {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <?php include('menu.php'); ?>
  <div class="home-page__background_activite">
  </div>
  <div id="afficher_actions_sociales">
    <div id="partie1">
      <h1>Actions sociales</h1>
      <p>Au-delà de l'agriculture, nous investissons dans le bien-être de nos communautés à travers des projets concrets et durables.</p>
      <div id="fonction">
        <div class="cart-action">
          <a href="afficheraction.php">
            <h2>Éducation</h2>
          </a>
          <p>Construction d'écoles et bourses scolaires pour les enfants des coopérateurs.</p>
        </div>
        <div class="cart-action">
          <a href="afficheraction.php">
            <h2>Santé</h2>
          </a>
          <p>Campagnes de sensibilisation et accès aux soins de santé dans les communautés.</p>
        </div>
        <div class="cart-action">
          <a href="afficheraction.php">
            <h2>Eau potable</h2>
          </a>
          <p>Installation de forages et systèmes d'adduction d'eau dans les villages.</p>
        </div>
        <div class="cart-action">
          <a href="afficheraction.php">
            <h2>Infrastructures</h2>
          </a>
          <p>Réhabilitation de routes et construction d'entrepôts de stockage.</p>
        </div>
      </div>
    </div>
    <div id="partie2"><img src="assets/images/image/action_sociale.png" alt="Actions sociales"></div>
  </div>
  <script src="assets/js/script.js"></script>
  <?php include 'footer.php'; ?>
</body>

</html>