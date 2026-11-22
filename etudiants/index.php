<?php
require_once '../database/connexion.php';

// Jointure pour afficher le nom de la formation au lieu de son ID
$sql = "SELECT etudiants.*, formations.nom AS nom_formation 
        FROM etudiants 
        INNER JOIN formations ON etudiants.id_formation = formations.id_formation";
$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Étudiants</h1>
        
        <p>
            <a href="../index.php">← Accueil</a> | 
            <a href="create.php">+ Ajouter un étudiant</a>
        </p>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Formation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($etudiants as $etudiant): ?>
                    <tr>
                        <td><?= htmlspecialchars($etudiant['id_etudiant']) ?></td>
                        <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                        <td><?= htmlspecialchars($etudiant['email']) ?></td>
                        <td><?= htmlspecialchars($etudiant['nom_formation']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $etudiant['id_etudiant'] ?>">Modifier</a> |
                            <a href="delete.php?id=<?= $etudiant['id_etudiant'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>