<?php 
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'élève, sinon redirige vers la page de connexion

if(!$_SESSION['pseudo']){
    header('Location: connexion.php');
    exit();
} 

require_once "./partials/header_page.php";
?>




<img src="./image/image.webp" alt="Trombinoscope élève" class="full-width-image">
<p>Votre Trombinoscope</p>