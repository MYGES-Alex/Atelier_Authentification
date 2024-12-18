<?php
// Démarrer une session pour gérer les connexions utilisateur
session_start();

// Vérifier si l'utilisateur est déjà connecté et rediriger vers la bonne page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Rediriger en fonction de l'utilisateur connecté
    if ($_SESSION['username'] === 'admin') {
        header('Location: page_admin.php');
    } elseif ($_SESSION['username'] === 'user') {
        header('Location: page_user.php');
    }
    exit();
}

// Gérer le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Vérification simple des identifiants
    if ($username === 'admin' && $password === 'secret') {
        // Stocker les informations utilisateur dans la session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'admin';

        // Rediriger vers la page admin
        header('Location: page_admin.php');
        exit();
    } elseif ($username === 'user' && $password === 'utilisateur') {
        // Stocker les informations utilisateur dans la session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'user';

        // Rediriger vers la page utilisateur
        header('Location: page_user.php');
        exit();
    } else {
        // Message d'erreur si les identifiants sont incorrects
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
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
    <h1>Atelier 3 : Authentification par Session</h1>
    <h3>Les pages protégées <a href="page_admin.php">page_admin.php</a> et <a href="page_user.php">page_user.php</a> ne sont accessibles qu'après connexion.</h3>
    
    <!-- Afficher un message d'erreur en cas de problème -->
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    <!-- Formulaire de connexion -->
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
