<?php 
session_start();
require_once "./partials/header_page.php"; 

$id = "";

// Vérifie si la méthode de requête est GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Récupère et sécurise l'ID passé dans l'URL
    $id = htmlspecialchars(trim($_GET['id'] ?? ''));

    // Affiche un contenu spécifique en fonction de l'ID dans l'URL
    if ($id == 1) {
        echo "<style>.label{ display : none;}</style>";
        ?>
        <img src="./image/annee_1.png" alt="Projet Math" class="image-detail">
        <p>Projet Math des premières années</p>
        <div class="button-container">
            <a href="index.php"><button class="submit">Retour</button></a>
        </div>
        <?php
    } elseif ($id == 2) {
        echo "<style>.label{ display : none;}</style>";
        ?>
        <img src="./image/annee_2.png" alt="Découverte à l'étranger" class="image-detail">
        <p>Visite dans un pays étranger</p>
        <div class="button-container">
            <a href="index.php"><button class="submit">Retour</button></a>
        </div>
        <?php
    } elseif ($id == 3) {
        echo "<style>.label{ display : none;}</style>";
        ?>
        <img src="./image/annee_3.png" alt="Taux réussite" class="image-detail">
        <p>Taux de réussite élevé</p>
        <div class="button-container">
            <a href="index.php"><button class="submit">Retour</button></a>
        </div>
        <?php
    } 
}
?>

<!-- Formulaire permettant de naviguer entre les années -->
<form action="index.php" method="get" class="label">
    <div class="label-container">
        <!-- Section pour la première année -->
        <div class="label-item">
            <label for="image1">1ère année</label>
            <a href="index.php?id=1">
                <img src="./image/prof_1.png" alt="Logo 1ère année" class="img-size">
            </a>
        </div>
        <!-- Section pour la deuxième année -->
        <div class="label-item">
            <label for="image2">2ème année</label>
            <a href="index.php?id=2">
                <img src="./image/prof_2.png" alt="Logo 2ème année" class="img-size">
            </a>
        </div>
        <!-- Section pour la troisième année -->
        <div class="label-item">
            <label for="image3">3ème année</label>
            <a href="index.php?id=3">
                <img src="./image/prof_3.png" alt="Logo 3ème année" class="img-size">
            </a>
        </div>
    </div>
</form>

<!-- Footer ajouté -->
<footer>
    <div class="footer-container">
        <p>&copy; 2025 VotreSite - Tous droits réservés</p>
        <p>Contact : <a href="mailto:contact@votresite.com">contact@votresite.com</a></p>
        <p><a href="privacy.php">Politique de confidentialité</a> | <a href="terms.php">Conditions d'utilisation</a></p>
    </div>
</footer>

<!-- Ajout du CSS pour garantir que le footer soit collé au bas -->
<style>
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    footer {
        background-color: #330490;
        color: white;
        text-align: center;
        padding: 20px 0;
        margin-top: auto; /* Cela garantit que le footer sera collé au bas */
    }

    footer a {
        color: white;
        text-decoration: none;
    }

    footer p {
        color: white;
    }

    footer a:hover {
        text-decoration: underline;
    }
</style>
