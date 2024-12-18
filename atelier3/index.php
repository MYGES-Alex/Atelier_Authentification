<?php
    // Si les informations d'authentification ne sont pas présentes ou incorrectes
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || 
        $_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== 'secret') {
        // Envoyer un header WWW-Authenticate demandant des identifiants
        header('WWW-Authenticate: Basic realm="Espace sécurisé"');
        // Envoyer un code 401 Unauthorized
        header('HTTP/1.0 401 Unauthorized');
        echo "Accès refusé : vous devez fournir des identifiants valides.";
        exit();
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification HTTP</title>
</head>
<body>
    <h1>Bienvenue dans l'espace sécurisé</h1>
    <p>Cette section est réservée uniquement à l'utilisateur admin.</p>
    <p>Pour accéder à cette page, vous devez vous authentifier avec :</p>
    <ul>
        <li><strong>Nom d'utilisateur :</strong> admin</li>
        <li><strong>Mot de passe :</strong> secret</li>
    </ul>

    <!-- Contenu public accessible à tout le monde -->
    <h2>Section publique</h2>
    <p>Cette partie est visible par tout le monde, aucune authentification n'est requise pour accéder ici.</p>
</body>
</html>
