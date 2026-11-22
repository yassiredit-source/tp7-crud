<?php
require_once '../database/connexion.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];

// Traitement du formulaire (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE modules SET titre = :titre, coefficient = :coefficient, id_formation = :id_formation WHERE id_module = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titre' => $titre,
        ':coefficient' => $coefficient,
        ':id_formation' => $id_formation,
        ':id' => $id
    ]);

    header('Location: index.php');
    exit;
}

// Charger les données du module
$stmt = $pdo->prepare("SELECT * FROM modules WHERE id_module = :id");
$stmt->execute([':id' => $id]);
$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    header('Location: index.php');
    exit;
}

// Charger toutes les formations pour le menu déroulant <select>
$formations = $pdo->query("SELECT id_formation, nom FROM formations")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un module</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Modifier le Module</h1>
        <p><a href="index.php">← Retour à la liste</a></p>

        <form method="POST" action="">
            <div>
                <label for="titre">Titre du module :</label><br>
                <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($module['titre']) ?>" required>
            </div>
            <br>
            <div>
                <label for="coefficient">Coefficient :</label><br>
                <input type="number" step="0.5" id="coefficient" name="coefficient" value="<?= htmlspecialchars($module['coefficient']) ?>" required>
            </div>
            <br>
            <div>
                <label for="id_formation">Formation :</label><br>
                <select id="id_formation" name="id_formation" required>
                    <?php foreach ($formations as $formation): ?>
                        <option value="<?= $formation['id_formation'] ?>" <?= ($formation['id_formation'] == $module['id_formation']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($formation['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>