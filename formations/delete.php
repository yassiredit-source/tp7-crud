<?php
require_once '../database/connexion.php';

// a. Récupérer l'identifiant à supprimer
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // b & c. Préparer et exécuter DELETE avec clause WHERE
        $sql = "DELETE FROM formations WHERE id_formation = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        // Si la formation contient encore des étudiants (ON DELETE RESTRICT)
        die("Impossible de supprimer cette formation car des étudiants y sont encore inscrits. <a href='index.php'>Retour à la liste</a>");
    }
}

// d. Rediriger vers la liste
header('Location: index.php');
exit;