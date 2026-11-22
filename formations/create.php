<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $frais = $_POST['frais'];

    $sql = "INSERT INTO formations (nom, frais) VALUES (:nom, :frais)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':frais' => $frais
    ]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une formation</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter une Formation</h1>
        <p><a href="index.php">← Retour à la liste</a></p>

        <form method="POST" action="">
            <div>
                <label for="nom">Nom de la formation :</label><br>
                <input type="text" id="nom" name="nom" required>
            </div>
            <br>
            <div>
                <label for="frais">Frais (DH) :</label><br>
                <input type="number" step="0.01" id="frais" name="frais" required>
            </div>
            <br>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>