<?php
require_once '../database/connexion.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];

// Traitement du formulaire (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE etudiants SET nom = :nom, email = :email, id_formation = :id_formation WHERE id_etudiant = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':id_formation' => $id_formation,
        ':id' => $id
    ]);

    header('Location: index.php');
    exit;
}

// Charger les données de l'étudiant
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id_etudiant = :id");
$stmt->execute([':id' => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
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
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Modifier l'Étudiant</h1>
        <p><a href="index.php">← Retour à la liste</a></p>

        <form method="POST" action="">
            <div>
                <label for="nom">Nom complet :</label><br>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
            </div>
            <br>
            <div>
                <label for="email">Email :</label><br>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($etudiant['email']) ?>" required>
            </div>
            <br>
            <div>
                <label for="id_formation">Formation :</label><br>
                <select id="id_formation" name="id_formation" required>
                    <?php foreach ($formations as $formation): ?>
                        <option value="<?= $formation['id_formation'] ?>" <?= ($formation['id_formation'] == $etudiant['id_formation']) ? 'selected' : '' ?>>
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