<?php
// Démarrer la session
session_start();

// Vérifie si l'utilisateur s'est bien connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page utilisateur </h1>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
