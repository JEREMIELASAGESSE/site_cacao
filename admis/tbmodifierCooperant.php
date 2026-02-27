 <?php
    require '../config/config.php';
    // Modifier un producteur
    if (isset($_POST['modifier'])) {
        $id = $_POST['id_producteur'];
        $nom = $_POST['nom_producteur'];
        $contact = $_POST['contact'];
        $zone = $_POST['id_zone'];
        $stmt = $pdo->prepare("UPDATE producteur SET nom_producteur = :nom, contact = :contact, id_zone = :zone WHERE id_producteur = :id");
        $stmt->execute(['nom' => $nom, 'contact' => $contact, 'zone' => $zone, 'id' => $id]);
    }

    // Affichage avec formulaire de modification
    $stmt = $pdo->query("SELECT pr.*, z.nom_zone FROM producteur pr JOIN zone z ON pr.id_zone = z.id_zone");
    $producteurs = $stmt->fetchAll();
    ?>


 <!DOCTYPE html>
 <html lang="fr">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../assets/styles/tableau.css">
     <link rel="stylesheet" href="../assets/styles/zone.css">
     <title>Modifier un Coopérant</title>
 </head>

 <body>

     <table border="1">
         <tr>
             <th>ID</th>
             <th>Nom</th>
             <th>Contact</th>
             <th>Zone</th>
             <th>Action</th>
         </tr>
         <?php foreach ($producteurs as $p): ?>
             <tr>
                 <form method="post">
                     <td><?= $p['id_producteur'] ?></td>
                     <td><input type="text" name="nom_producteur" value="<?= $p['nom_producteur'] ?>"></td>
                     <td><input type="text" name="contact" value="<?= $p['contact'] ?>"></td>
                     <td>
                         <select name="id_zone">
                             <?php
                                $zones = $pdo->query("SELECT * FROM Zone")->fetchAll();
                                foreach ($zones as $z) {
                                    $selected = ($z['id_zone'] == $p['id_zone']) ? "selected" : "";
                                    echo "<option value='{$z['id_zone']}' $selected>{$z['nom_zone']}</option>";
                                }
                                ?>
                         </select>
                     </td>
                     <td>
                         <input type="hidden" name="id_producteur" value="<?= $p['id_producteur'] ?>">
                         <button type="submit" name="modifier">Modifier</button>
                     </td>
                 </form>
             </tr>
         <?php endforeach; ?>
     </table>

 </body>

 </html>