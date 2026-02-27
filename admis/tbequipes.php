<?php
require("../config/config.php");
$stmt = $pdo->query("SELECT * FROM utilisateur ORDER BY id DESC");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/tableau.css">
    <link rel="stylesheet" href="../assets/styles/produit.css">
    <title>GESTION DE L'EQUIPE</title>
</head>

<body>
    <h1 class="font1">
        <strong>GESTION COMPLETE DES UTILISATEURS</strong>
    </h1>
    <ul style="border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px; background-color:#4E342E; display: inline-block; padding: 5px 10px; list-style: none;">
        <li><a href="dashboard.php" style="color:#D4AF37; font-weight: 600;text-decoration: none; "><strong>RETOUR</strong></a></li>
    </ul>
    <div id="formulaire_ajoute">
        <!--formulaire et tableau de gestion des produits ici-->
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
        <form action="tbajoutequipes.php" method="post" enctype="multipart/form-data">
            <h1 id="previewContainer">Ajouter un utilisateur </h1>
            <input type="text" name="nom_U" placeholder="Le Nom" required>
            <input type="text" name="prenom_U" placeholder="Le Prenom" required>
            <input type="text" name="user" placeholder="le Nom Utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="text" name="contact_U" placeholder="Contact" required>
            <input type="text" name="Adresse_U" placeholder="Adresse" required>
            <input type="date" name="date" required>
            <input type="file" name="photo" id="imageInput" required>
            <input type="submit" value="Ajouter le produit" accept="image/*">
        </form>
    </div>
    <div id="affiche_prod>
        <section class=" propos-page">
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nom Utilisateur</th>
                    <th>Mot de passe</th>
                    <th>Contact</th>
                    <th>Adresse</th>
                    <th>Date</th>
                    <th>Photo</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($utilisateurs as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['nom_u']) ?></td>
                        <td><?= htmlspecialchars($u['prenom_u']) ?></td>
                        <td><?= htmlspecialchars($u['user']) ?></td>
                        <td><?= htmlspecialchars($u['password']) ?></td>
                        <td><?= htmlspecialchars($u['contact_u']) ?></td>
                        <td><?= htmlspecialchars($u['adresse_u']) ?></td>
                        <td><?= htmlspecialchars($u['date']) ?></td>
                        <td><img src="<?= htmlspecialchars($u['photo']) ?>" alt="Photo"></td>
                        <td><a class="btn modifier" href="modifiequipes.php?id=<?= $u['id'] ?>">Modifier</a></td>
                        <td><a class="btn supprimer" href="supprimequipes.php?id=<?= $u['id'] ?>" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        </section>
    </div>
    <?php include("../config/config.php"); ?>
    <script src="../assets/js/equipes.js"></script>
</body>

</html>