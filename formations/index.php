<?php
require_once '../database/connexion.php';

// a & b. Exécuter SELECT et récupérer avec fetchAll(PDO::FETCH_ASSOC)
$stmt = $pdo->query("SELECT * FROM formations");
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des formations</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Formations</h1>
        
        <p>
            <a href="../index.php">← Accueil</a> | 
            <a href="create.php">+ Ajouter une formation</a>
        </p>

        <!-- c. Afficher les données dans un tableau HTML -->
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la formation</th>
                    <th>Frais (DH)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($formations as $formation): ?>
                    <tr>
                        <td><?= htmlspecialchars($formation['id_formation']) ?></td>
                        <td><?= htmlspecialchars($formation['nom']) ?></td>
                        <td><?= htmlspecialchars($formation['frais']) ?></td>
                        <td>
                            <!-- d. Liens Modifier et Supprimer -->
                            <a href="edit.php?id=<?= $formation['id_formation'] ?>">Modifier</a> |
                            <a href="delete.php?id=<?= $formation['id_formation'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette formation ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>