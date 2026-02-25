<?php
require("config/config.php");

$stmt = $pdo->query("
    SELECT 
        (SELECT COUNT(*) FROM Producteur) AS nb_producteurs,
        (SELECT COUNT(*) FROM Zone) AS nb_zones,
        (SELECT SUM(surface_cultivee) FROM Cultiver) AS surface_totale
");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Statistiques générales</h2>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo.png">
    <link rel="stylesheet" href="assets/styles/index.css">
    <title> A propos de COOP-CA COOPAAHS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="home-page__background_apropos">
        <h1>
            A Propos de <br>
            <strong>COOP-CA COOPAAHS</strong>

        </h1>
    </div>
    <ul id="affiche_des_statistiques">
        <li><i class="fa-solid fa-users icon"></i> <br> <b><?= $result['nb_producteurs'] ?> +</b><br> Coopérateurs</li>
        <li><i class="fa-solid fa-map-marker-alt icon"><br></i><b><br><?= $result['nb_zones'] ?></b><br> Zones d'interventions</li>
        <li><i class="fa-solid fa-tractor icon"></i><br><b><?= $result['surface_totale'] ?></b> <br>hectares cultivés</li>
    </ul>
    <section class="propos-page">
        <h2>Notre Mission</h2>
        <p>
            commercialiser du cacao de qualité de nos membres à des meilleurs prix
            pour améliorer le cadre de vie de la communauté.
        </p>
        <p>
            COOP-CA COOPAAHS a été Créée en 2014 à la suite d’une assemblée générale constitutive tenue par 1 076 producteurs venant de 11 localités.
            Elle compte à ce jour 3500 producteurs dont 2500 membres repartis dans 30 localités avec 10685 Ha de cacaoyère. 1087 de ces membres sont également certifiés Rainforest Alliance (RA).
        </p>
        <p>
            Pour le respect de ses membres la COOP-CA COOPAAHS dit non à toute forme de discrimination.
        </p>
    </section>
    <section class="propos-page">
        <h2>Notre Vision</h2>
        <p>
            Notre vision est de devenir est de Devenir une usine de production de beurre de cacao en 2035 , un modèle de coopération agricole en Côte d'Ivoire,
            en inspirant d'autres coopératives à suivre notre exemple et en contribuant au
            développement durable de l'agriculture dans la région.
        </p>
        <p>
            Nous aspirons à créer un environnement où les agriculteurs peuvent prospérer,
            où les pratiques agricoles sont durables et respectueuses de l'environnement,
            et où la communauté locale bénéficie d'un développement économique inclusif.
        </p>
        <p>
            En travaillant ensemble, nous voulons bâtir un avenir où l'agriculture est synonyme
            de prospérité, de durabilité et de solidarité. Nous croyons que chaque membre de
            notre coopérative a un rôle à jouer dans la réalisation de cette vision, et nous
            nous engageons à les soutenir dans leurs efforts pour atteindre leurs objectifs.
        </p>
    </section>
    <section class="propos-page">
        <h2>Nos Valeurs</h2>
        <p>
            Nous sommes guidés par des valeurs de solidarité, d'équité, de durabilité et de respect.
            Nous croyons que chaque membre de notre coopérative mérite d'être traité avec dignité
            et respect, et nous nous engageons à promouvoir des pratiques agricoles qui protègent
            l'environnement pour les générations futures.
        </p>
    </section>
    <section class="propos-page">
        <h2>Nos Objectifs</h2>
        <p>
            Nos principaux objectifs sont de :
        <ul class="objectives-list">
            <li>Promouvoir l'agriculture durable et respectueuse de l'environnement.</li>
            <li>Fournir un soutien technique et financier à nos membres.</li>
            <li>Accroître la productivité et la rentabilité des exploitations agricoles.</li>
            <li>Renforcer la coopération entre les agriculteurs de la région.</li>
            <li>Contribuer au développement économique et social de la communauté locale.</li>
        </ul>
        </p>
    </section>
    <!-- <section class="propos-page">
        <h2>Notre Équipe</h2>
        <div class="equipes">
            <div class="equipe">
                <img src="assets/images/image/hypiness.jp" alt="Membre de l'équipe 1">
                <h3>N'DRI KOUAME JEREMIE</h3>
                <h4>fonction</h4>
            </div>
            <div class="equipe">
                <img src="assets/images/image/happyness1.jp" alt="Membre de l'équipe 2">
                <h3>KONAN AYA DORCAS</h3>
                <h4>fonction</h4>
            </div>
            <div class="equipe">
                <img src="assets/images/image/happyness2.jp" alt="Membre de l'équipe 3">
                <h3>N'DRI SAGESSE</h3>
                <h4>fonction</h4>

            </div>

        </div> -->
    </section>
    <?php include 'footer.php'; ?>
</body>

</html>