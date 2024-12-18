<?php
// Démarrer une session pour gérer les cookies
session_start();

// Générer un jeton unique et le stocker en session
if (!isset($_SESSION['authToken'])) {
    $_SESSION['authToken'] = bin2hex(random_bytes(16));
}

// Vérifier si le cookie 'authToken' existe et correspond au jeton de la session
if (isset($_COOKIE['authToken']) && $_COOKIE['authToken'] === $_SESSION['authToken']) {
    header('Location: page_admin.php');
    exit();
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérification des identifiants (statique)
    if ($username === 'admin' && $password === 'admin') {
        // Initialiser le cookie avec le jeton unique
        setcookie('authToken', $_SESSION['authToken'], time() + 60, '/', '', false, true);// Le Cookie est initialisé et valable pendant 1 minutes
        header('Location: page_admin.php');
        exit();
    } else {
        $error = "Identifiants invalides.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier authentification par Cookie</h1>
    <h3>La page <a href="page_admin.php">page_admin.php</a> est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
    <br>
    <a href="../index.html">Retour à l'accueil</a>  
</body>
</html>
