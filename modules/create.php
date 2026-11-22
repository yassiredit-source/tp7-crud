<?php
require_once '../database/connexion.php';

// Récupérer la liste des formations pour le menu déroulant <select>
$stmtFormations = $pdo->query("SELECT id_formation, nom FROM formations");
$formations = $stmtFormations->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "INSERT INTO modules (titre, coefficient, id_formation) VALUES (:titre, :coefficient, :id_formation)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titre' => $titre,
        ':coefficient' => $coefficient,
        ':id_formation' => $id_formation
    ]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un module</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Module</h1>
        <p><a href="index.php">← Retour à la liste</a></p>

        <form method="POST" action="">
            <div>
                <label for="titre">Titre du module :</label><br>
                <input type="text" id="titre" name="titre" required>
            </div>
            <br>
            <div>
                <label for="coefficient">Coefficient :</label><br>
                <input type="number" step="0.5" id="coefficient" name="coefficient" required>
            </div>
            <br>
            <div>
                <label for="id_formation">Formation :</label><br>
                <select id="id_formation" name="id_formation" required>
                    <option value="">-- Choisir une formation --</option>
                    <?php foreach ($formations as $formation): ?>
                        <option value="<?= $formation['id_formation'] ?>">
                            <?= htmlspecialchars($formation['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>