<?php
require 'config/config.php';

$stmt = $pdo->query("SELECT * FROM durabilite");
$durabilites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo.png">
    <link rel="stylesheet" href="assets/styles/index.css">
    <link rel="stylesheet" href="assets/styles/zone.css">
    <title>Durabilité</title>
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="home-page__background_durabilite">
        <h1>
            Durabilité <br>
            <strong>COOP-CA COOPAAHS</strong>
        </h1>
    </div>
    <section id="durabilite-section">
        <div id="partie1"><img src="assets/images/image/durabiliteimg.png" alt=""></div>
        <div id="partie2">
            <h2>Nos Initiatives de Durabilité</h2>
            <p>Découvrez nos projets et actions en faveur de la durabilité.</p>
            <div id="cartedurabilite">
                <?php foreach ($durabilites as $d): ?>
                    <!-- <img src="assets/images/icon/icon_durabilite.png" alt="" class="icon"> -->
                    <div class="carte">
                        <h3><?= $d['nom_durabilite'] ?></h3>
                        <p><?= $d['description'] ?>.</p>
                    <?php endforeach; ?>
                    </div>
            </div>
    </section>
    <?php include 'footer.php'; ?>
</body>

</html>