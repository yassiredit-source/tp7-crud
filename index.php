<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Centre de Formation</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gestion du Centre de Formation</h1>
        <p class="subtitle">Bienvenue dans l'application de gestion (TP 7 - CRUD PHP / MySQL)</p>

        <div class="menu">
            <div class="card">
                <h2>Formations</h2>
                <p>Gérer les filières, les intitulés et les frais d'inscription.</p>
                <a href="formations/index.php" class="btn">Gérer les formations</a>
            </div>

            <div class="card">
                <h2>Étudiants</h2>
                <p>Gérer les inscriptions des étudiants et leurs formations.</p>
                <a href="etudiants/index.php" class="btn">Gérer les étudiants</a>
            </div>

            <div class="card">
                <h2>Modules</h2>
                <p>Gérer les matières, les coefficients et les formations liées.</p>
                <a href="modules/index.php" class="btn">Gérer les modules</a>
            </div>
        </div>
    </div>
</body>
</html>