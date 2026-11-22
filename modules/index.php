<?php
require_once '../database/connexion.php';

// Jointure pour afficher le nom de la formation liée au module
$sql = "SELECT modules.*, formations.nom AS nom_formation 
        FROM modules 
        INNER JOIN formations ON modules.id_formation = formations.id_formation";
$stmt = $pdo->query($sql);
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des modules</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Modules</h1>
        
        <p>
            <a href="../index.php">← Accueil</a> | 
            <a href="create.php">+ Ajouter un module</a>
        </p>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre du module</th>
                    <th>Coefficient</th>
                    <th>Formation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modules as $module): ?>
                    <tr>
                        <td><?= htmlspecialchars($module['id_module']) ?></td>
                        <td><?= htmlspecialchars($module['titre']) ?></td>
                        <td><?= htmlspecialchars($module['coefficient']) ?></td>
                        <td><?= htmlspecialchars($module['nom_formation']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $module['id_module'] ?>">Modifier</a> |
                            <a href="delete.php?id=<?= $module['id_module'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce module ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>