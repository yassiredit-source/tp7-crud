<?php
require_once '../database/connexion.php';

// a. Récupérer l'identifiant depuis l'URL
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];

// d. Traitement du formulaire (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $frais = $_POST['frais'];

    $sql = "UPDATE formations SET nom = :nom, frais = :frais WHERE id_formation = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':frais' => $frais,
        ':id' => $id
    ]);

    // e. Rediriger vers la liste
    header('Location: index.php');
    exit;
}

// b. Charger les données existantes depuis MySQL
$stmt = $pdo->prepare("SELECT * FROM formations WHERE id_formation = :id");
$stmt->execute([':id' => $id]);
$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une formation</title>
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>
<body>
    <div class="container">
        <h1>Modifier la Formation</h1>
        <p><a href="index.php">← Retour à la liste</a></p>

        <!-- c. Préremplir le formulaire avec les valeurs existantes -->
        <form method="POST" action="">
            <div>
                <label for="nom">Nom de la formation :</label><br>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($formation['nom']) ?>" required>
            </div>
            <br>
            <div>
                <label for="frais">Frais (DH) :</label><br>
                <input type="number" step="0.01" id="frais" name="frais" value="<?= htmlspecialchars($formation['frais']) ?>" required>
            </div>
            <br>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>