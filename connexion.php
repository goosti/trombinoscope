<?php
// Démarre la session et affiche l'en-tête de la page
ob_start();
session_start();
require_once "./partials/header_page.php";
?>

<?php
// Connexion à la base de données MySQL avec PDO
$bdd = new PDO('mysql:host=localhost;dbname=trombinoscope;charset=utf8;', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activation du mode erreur pour PDO

// Traitement du premier formulaire (connexion utilisateur)
if (isset($_POST['envoi'])) {
    // Vérifie si les champs pseudo et mot de passe ne sont pas vides
    if (!empty($_POST['pseudo']) AND !empty($_POST['mdp'])) {
        // Sécurise l'entrée du pseudo pour éviter les attaques XSS
        $pseudo = htmlspecialchars($_POST['pseudo']);
        // Récupère le mot de passe
        $mdp = $_POST['mdp'];

        // Prépare la requête pour récupérer l'utilisateur par pseudo
        $recupUser = $bdd->prepare('SELECT * FROM eleve WHERE pseudo = ?');
        $recupUser->execute(array($pseudo));

        // Vérifie si l'utilisateur existe dans la base de données
        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();
            // Vérification du mot de passe avec la fonction password_verify
            if (password_verify($mdp, $user['password'])) {
                // Si le mot de passe est correct, on initialise la session
                $_SESSION['pseudo'] = $pseudo;
                $username = $pseudo;
                $_SESSION['id'] = $user['id'];
                // Redirige vers la page d'accueil après la connexion
                header('Location: index.php');
                exit();
            } else {
                // Si le mot de passe est incorrect, affiche un message d'erreur avec le même style que pour l'admin
                echo "<p style='color:red; font-weight: bold;'>Votre mot de passe ou pseudo est incorrect</p>";
            }
        } else {
            // Si le pseudo n'existe pas dans la base de données, affiche un message d'erreur avec le même style que pour l'admin
            echo "<p style='color:red; font-weight: bold;'>Votre mot de passe ou pseudo est incorrect</p>";
        } 
    } else {
        // Si les champs ne sont pas remplis, affiche un message d'erreur avec le même style que pour l'admin
        echo "<p style='color:red; font-weight: bold;'>Veuillez compléter tous les champs...</p>";
    }
}

// Traitement du deuxième formulaire (connexion admin)
if (isset($_POST['admin_envoi'])) {
    // Vérifie les identifiants admin fixes
    if ($_POST['admin_pseudo'] === 'admin' && $_POST['admin_mdp'] === 'motdepasse') {
        // Si les identifiants sont corrects, initialise la session pour l'admin
        $_SESSION['pseudo'] = 'Admin';
        $username = 'Admin';
        // Redirige vers la page d'administration après la connexion
        header('Location: admin.php');
        exit();
    } else {
        // Si les identifiants sont incorrects, affiche un message d'erreur avec le même style
        echo "<p style='color:red; font-weight: bold;'>Identifiants admin incorrects...</p>";
    }
}
?>

<!-- Structure HTML pour les formulaires de connexion -->
<div class="login-container">
    <!-- Formulaire de connexion utilisateur -->
    <div class="login-box">
        <h3>Connexion Utilisateur</h3>
        <form method="POST" action="">
            <input type="text" name="pseudo" placeholder="Pseudo" required>
            <br>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <br><br>
            <input type="submit" name="envoi" value="Se connecter" class="submit">
        </form>
    </div>

    <!-- Formulaire de connexion administrateur -->
    <div class="login-box">
        <h3>Connexion Admin</h3>
        <form method="POST" action="">
            <input type="text" name="admin_pseudo" placeholder="Pseudo" required>
            <br>
            <input type="password" name="admin_mdp" placeholder="Mot de passe" required>
            <br><br>
            <input type="submit" name="admin_envoi" value="Se connecter" class="submit">
        </form>
    </div>
</div>
