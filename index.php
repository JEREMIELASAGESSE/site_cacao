<?php
require 'config/config.php';

$result = $pdo->query("SELECT * FROM annonces");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo.png">
    <link rel="stylesheet" href="assets/styles/index.css">
    <script src="assets/js/script.js"></script>
    <title>COOP-CA COOPAAHS</title>
</head>
<style>
    :root {
        --v-color: rgb(252, 251, 250);
    }

    #annonces {
        padding: 10px;
        border-radius: 5px;
        margin: 0;
        position: absolute;
        top: 30px;
    }

    #annonces span {
        margin: 0;
        font-weight: bold;
        font-size: 1.5em;
        text-transform: uppercase;

    }

    #annonces p {
        margin: 0;
        font-size: 1.5em;
        color: #ffffff;
    }
</style>

<body>
    <?php include('menu.php'); ?>
    <div class="home-page__background_index">
        <h1>
            Bienvenue sur le site de la
            <br>
            <strong>Société Coopérative Agricole Anitché du Haut Sassandra</strong>
            <br>
            <strong>(COOP-CA COOPAAHS)</strong>
        </h1>
        <marquee id="annonces">
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>

                <p>
                    <span><?php echo $row['title']; ?></span> : <?php echo $row['description']; ?>
                </p>
            <?php } ?>
        </marquee>
    </div>
    <!-- <div class="home-page__background" id="font1">
        <img src="assets/images/image/foto.png" alt="Image de fond" class="home-page__image">
    </div> -->
    <section class="home-page">

    </section>
    <section class="home-page2">
        <div class="home-page2__content">
            <img src="assets/images/image/CACAO 8.png" alt="Nos Valeurs" class="home-page2__image">
            <br>
            <a href="produit.php" class="home-page2__link">Nos Produits</a>
        </div>
        <div class="home-page2__content">
            <img src="assets/images/image/cacaoRose.jpg" alt="Nos Valeurs" class="home-page2__image">
            <br>
            <a href="contact.php" class="home-page2__link">Contactez-Nous</a>
        </div>
        <div class="home-page2__content">
            <img src="assets/images/image/actions.png" alt="Nos Valeurs" class="home-page2__image">
            <br>
            <a href="contact.php" class="home-page2__link">Nos Actions Sociales</a>
        </div>
        <div class="home-page2__content">
            <img src="assets/images/image/durabilité.jpg" alt="Nos Valeurs" class="home-page2__image">
            <br>
            <a href="durabilite.php" class="home-page2__link">Durabilité</a>
        </div>
        <div class="home-page2__content">
            <img src="assets/images/image/zone.jpg" alt="Nos Valeurs" class="home-page2__image">
            <br>
            <a href="zones.php" class="home-page2__link">Nos Zones Actions</a>
        </div>
    </section>
    <?php include 'footer.php'; ?>

</body>

</html>