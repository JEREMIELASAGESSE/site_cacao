<?php
require("config/config.php");

// Récupérer les produits cultivés par zone + total producteurs par zone
$stmt = $pdo->prepare("
    SELECT 
        z.id_zone,
        z.nom_zone,
        p.nom_produit,
        COUNT(DISTINCT c.id_producteur) AS nb_producteurs,
        (
            SELECT COUNT(DISTINCT pr2.id_producteur)
            FROM Producteur pr2
            WHERE pr2.id_zone = z.id_zone
        ) AS total_producteurs_zone
    FROM Cultiver c
    JOIN Producteur pr ON c.id_producteur = pr.id_producteur
    JOIN Zone z ON pr.id_zone = z.id_zone
    JOIN Produits p ON c.id_produit = p.id_produit
    GROUP BY z.id_zone, z.nom_zone, p.nom_produit
    ORDER BY z.nom_zone, p.nom_produit
");
$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organiser les résultats par zone
$zones = [];
foreach ($resultats as $r) {
    $zones[$r['nom_zone']]['total'] = $r['total_producteurs_zone'];
    $zones[$r['nom_zone']]['produits'][] = $r;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo.png">
    <link rel="stylesheet" href="assets/styles/index.css">
    <link rel="stylesheet" href="assets/styles/zone.css">
    <title>Zones</title>
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="home-page__background_zones">
        <h1>
            Nos Zones d'Intervention <br>
            <strong>COOP-CA COOPAAHS</strong>
        </h1>
    </div>
    <section id="zones-section">
        <?php if (!empty($zones)): ?>
            <?php foreach ($zones as $nom_zone => $data): ?>
                <div class="zone">
                    <h2><?= htmlspecialchars($nom_zone) ?></h2>
                    <p>
                        <?php foreach ($data['produits'] as $p): ?>
                            <span class="culture_zone"><?= htmlspecialchars($p['nom_produit']) ?></span>
                        <?php endforeach; ?>
                        <span class="nombre_cultivateur"><?= $data['total'] ?> Membres</span>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
    <?php include 'footer.php'; ?>
</body>

</html>