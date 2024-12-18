<?php

// Liste des utilisateurs valides (simplifié)
$validUsers = [
    'admin' => 'secret',
    'user' => 'utilisateur'
];

// Vérifier si l'utilisateur a envoyé des identifiants
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

// Vérifier les identifiants
if (!isset($validUsers[$username]) || $validUsers[$username] !== $password) {
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
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
    <h1>Bienvenue sur la page protégée</h1>
    <p>Ceci est une page protégée par une authentification simple via le header HTTP.</p>
    <p>Vous êtes connecté en tant que : <strong><?php echo htmlspecialchars($username); ?></strong></p>

    <!-- Section simplifiée pour les rôles -->
    <?php if ($username === 'admin'): ?>
        <h2>Section réservée aux administrateurs</h2>
        <p>Vous avez accès aux fonctions administratives.</p>
    <?php elseif ($username === 'user'): ?>
        <h2>Section réservée aux utilisateurs</h2>
        <p>Bienvenue, utilisateur !</p>
    <?php endif; ?>

    <a href="../index.html">Retour à l'accueil</a>
</body>
</html>
