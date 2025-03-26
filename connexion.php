<?php
ob_start();
require_once "./partials/header.php";
?>

<?php

$bdd = new PDO('mysql:host=localhost;dbname=trombinoscope;charset=utf8;', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Pour gérer les erreurs PDO

// Connexion pour le premier formulaire
if (isset($_POST['envoi'])) {
    if (!empty($_POST['pseudo']) AND !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = $_POST['mdp'];

        $recupUser = $bdd->prepare('SELECT * FROM eleve WHERE pseudo = ?');
        $recupUser->execute(array($pseudo));

        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();
            // Vérification du mot de passe avec password_verify
            if (password_verify($mdp, $user['password'])) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['id'] = $user['id'];
                header('Location: index.php');
                exit();
            } else {
                echo "Votre mot de passe ou pseudo est incorrect";
            }
        } else {
            echo "Votre mot de passe ou pseudo est incorrect";
        } 
    } else {
        echo "<p style='color:red'>Veuillez compléter tous les champs...</p>";
    }
}

// Connexion pour le deuxième formulaire (admin)
if (isset($_POST['admin_envoi'])) {
    if ($_POST['admin_pseudo'] === 'admin' && $_POST['admin_mdp'] === 'motdepasse') {
        header('Location: admin.php');
        exit();
    } else {
        echo "<p style='color:red'>Identifiants admin incorrects...</p>";
    }
}
?>


    <div class="login-container">
        <!-- Premier formulaire de connexion -->
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

        <!-- Deuxième formulaire de connexion (Admin) -->
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

