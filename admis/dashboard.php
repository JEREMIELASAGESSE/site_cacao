<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require '../config/config.php';
// Compter les actions
$sql = "SELECT COUNT(*) AS total_actions FROM actions";
$stmt = $pdo->query($sql);
$row_actions = $stmt->fetch();
// Compter les partenaires
$sql = "SELECT COUNT(*) AS total_partenaires FROM partenaire";
$stmt = $pdo->query($sql);
$row_partenaires = $stmt->fetch();
htmlspecialchars($_SESSION['user'])
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo/logo.png">
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <title>Tableau de bord</title>
</head>

<body>
    <h1 class="font1">
        <strong>Bienvenue sur le tableau de bord !</strong>
        <?php echo htmlspecialchars($_SESSION['user']); ?>
    </h1>

    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="../index.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>RETOURNER SUR LE SITE</strong></a></li>
    </ul>
    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li>
            <a href="logout.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>Se Deconnecter</strong></a>
        </li>
    </ul>
    <div class="container">
        <div class="welcome-message">
            <p>Vous pouvez accéder aux différentes fonctionnalités.</p>
        </div>
    </div>
    <p></p>
    <div class="containerst">
        <p><strong>Statistiques globales</strong> :</p>
        <table>
            <tr>
                <td>
                    <nav>
                        nombres d'actions :
                    </nav>
                </td>
                <td>
                    <nav>
                        <strong><?= $row_actions['total_actions'] ?></strong>
                    </nav>
                </td>
            </tr>
            <tr>
                <td>
                    <nav>
                        nombres de partenaires :
                    </nav>
                </td>
                <td>
                    <nav>
                        <strong><?= $row_partenaires['total_partenaires'] ?></strong>
                    </nav>
                </td>
            </tr>
        </table>


    </div>
    <div class="fonctionnalites-container">
        <div class="fonctionnalite">
            <img src="../assets/images/image/actiontb1.png" alt="Gestion des actions">
            <ul>
                <li><a href="tbaction.php">Gestion des actions</a></li>
            </ul>
        </div>
        <div class="fonctionnalite">
            <img src="../assets/images/image/actions.png" alt="Gestion des actions">
            <ul>
                <li><a href="tbpartenaire.php">Gestion des partenaires</a></li>
            </ul>
        </div>
        <div class="fonctionnalite">
            <img src="../assets/images/image/font1.jpg" alt="Gestion des actions">
            <ul>
                <li><a href="tbproduits.php">Gestion des produits</a></li>
            </ul>
        </div>
        <div class="fonctionnalite">
            <img src="../assets/images/image/action4.jpg" alt="Gestion des actions">
            <ul>
                <li><a href="tbequipes.php">Gestion des utilisateurs</a></li>
            </ul>
        </div>
        <div class="fonctionnalite">
            <img src="../assets/images/image/cooperant.jpg" alt="Gestion des coopérants">
            <ul>
                <li><a href="tbcooperant.php">Gestion des coopérants</a></li>
            </ul>
        </div>
        <div class="fonctionnalite">
            <img src="../assets/images/image/zone.jpg" alt="Gestion des zones">
            <ul>
                <li><a href="tbzone.php">Gestion des zones</a></li>
            </ul>
        </div>
        <div class="fonctionnalite">
            <img src="../assets/images/image/durabilité.jpg" alt="Gestion de la durabilité">
            <ul>
                <li><a href="tbdurabilite.php">Gestion de la durabilité</a></li>
            </ul>
        </div>
        <div class="fonctionnalite">
            <img src="../assets/images/image/durabilité.jpg" alt="Gestion de la durabilité">
            <ul>
                <li><a href="cultiver.php">liste des producteur par zone et leur culture</a></li>
            </ul>
        </div>
    </div>

</body>

</html>