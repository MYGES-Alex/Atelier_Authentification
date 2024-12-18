<?php
// Identifiants valides
$valid_username = 'admin';
$valid_password = 'secret';

// Vérifier si l'utilisateur a envoyé des identifiants
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // Envoyer un header HTTP pour demander l'authentification
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

// Vérifier les identifiants
if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
    // Si les identifiants sont incorrects
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
}

// Si les identifiants sont corrects, afficher la page protégée
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <!-- Section publique -->
    <h1>Bienvenue</h1>
    <p>Cette partie est accessible à tout le monde.</p>
    <hr>

    <!-- Section protégée -->
    <h1>Section protégée</h1>
    <p>Ceci est une page protégée par une authentification via le header HTTP.</p>
    <p>Vous êtes connecté en tant que : <strong><?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></strong></p>
    <p>Le mot de passe utilisé est : <strong><?php echo htmlspecialchars($_SERVER['PHP_AUTH_PW']); ?></strong></p>
    
    <!-- Explication -->
    <p>Pour accéder à cette page, le serveur a utilisé le header <code>WWW-Authenticate</code> pour demander vos identifiants.</p>
    <p>Aucun système de session ou de cookie n'est utilisé dans cet exemple.</p>

    <hr>
    <a href="../index.html">Retour à l'accueil</a>  
</body>
</html>
