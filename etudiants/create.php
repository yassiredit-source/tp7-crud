<?php
require_once '../database/connexion.php';

// Récupérer la liste des formations pour le menu déroulant <select>
$stmtFormations = $pdo->query("SELECT id_formation, nom FROM formations");
$formations = $stmtFormations->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $id_formation = $_POST['id_formation'];

    $sql = "INSERT INTO etudiants (nom, email, id_formation) VALUES (:nom, :email, :id_formation)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
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
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Étudiant</h1>
        <p><a href="index.php">← Retour à la liste</a></p>

        <form method="POST" action="">
            <div>
                <label for="nom">Nom complet :</label><br>
                <input type="text" id="nom" name="nom" required>
            </div>
            <br>
            <div>
                <label for="email">Email :</label><br>
                <input type="email" id="email" name="email" required>
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