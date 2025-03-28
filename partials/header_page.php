<?php
// Vérifie si un pseudo est stocké dans la session, sinon il définit "Invité" comme utilisateur par défaut
$username = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'Invité';
// Définit "Invité" comme valeur par défaut pour la comparaison du compte utilisateur
$compte = "Invité";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trombinoscope</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Définition des styles de base pour le corps de la page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Styles pour l'en-tête de la page */
        header {
            background-color: #330490;
            color: #fff;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Conteneur principal avec un maximum de largeur de 1200px et centrage des éléments */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Style du logo */
        .logo a {
            font-size: 24px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Navigation : liste des éléments du menu */
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }

        /* Style des éléments du menu */
        nav ul li {
            margin: 0 15px;
        }

        /* Style des liens du menu */
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 15px;
            transition: background-color 0.3s;
        }

        /* Effet au survol des liens du menu */
        nav ul li a:hover {
            background-color: #573AB1;
            border-radius: 5px;
        }

        /* Affichage des informations de l'utilisateur (pseudo) */
        .user-info p {
            margin: 0;
            font-size: 16px;
            color: white;
        }

        /* Styles généraux pour les formulaires (inputs) */
        input {
            margin-top: 20px;
            border-radius: 15px;
            border: solid 1px;
        }

        /* Style du bouton de soumission */
        .submit {
            background-color: #330490;
            color: white;
            padding: 10px;
            border-radius: 15px;
            border: none;
            margin-bottom: 15px;
        }

        /* Effet au survol du bouton de soumission */
        .submit:hover {
            background-color: #573AB1;
            cursor: pointer;
        }

        /* Style du conteneur pour la page de login */
        .login-container {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        /* Style de la boîte de login */
        .login-box {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
            text-align: center;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }

        /* Style des champs de saisie du login */
        .login-box input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Conteneur d'images pour l'affichage des éléments de trombinoscope */
        .label-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            align-items: center;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        /* Style de chaque élément de l'affichage des images */
        .label-item {
            text-align: center;
            margin: 10px;
        }

        /* Style des labels pour chaque image */
        .label-item label {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Style des images (taille maximale et effets au survol) */
        .img-size {
            max-width: 300px;
            height: auto;
            transition: transform 0.3s ease;
            margin-top: 15px;
        }

        /* Effet au survol des images (agrandissement) */
        .img-size:hover {
            transform: scale(1.1);
        }

        /* Style pour l'affichage détaillé d'une image */
        .image-detail {
            max-width: 80%;
            margin: 20px auto;
            display: block;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Style pour les paragraphes de texte */
        p {
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
            color: #333;
        }

        /* Conteneur pour le bouton centré */
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            width: 100%;
        }

        /* Style du bouton d'action supplémentaire */
        .submit1 {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            width: auto;
        }

        /* Effet au survol du bouton d'action supplémentaire */
        .submit1:hover {
            background-color: #573AB1;
            cursor: pointer;
        }

        /* Style de l'image qui prend toute la largeur de l'écran */
        .full-width-image {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Media Query pour les petits écrans (téléphones) */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            nav ul {
                display: block;
                text-align: center;
            }

            nav ul li {
                margin: 10px 0;
            }

            .login-container {
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .login-box {
                width: 90%;
            }

            .label-container {
                flex-direction: column;
                gap: 15px;
            }

            .img-size {
                max-width: 100%;
            }

            .image-detail {
                max-width: 100%;
            }
        }

        /* Media Query pour les tablettes */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .label-container {
                flex-direction: column;
                gap: 20px;
            }

            .img-size {
                max-width: 80%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <!-- Lien vers la page d'accueil avec logo -->
                <a href="index.php"><img src="./image/lamanu-logo.png" alt="Logo Lamanu" style="max-width: 250px;"></a>
            </div>
            <nav>
                <ul>
                    <!-- Lien vers la page d'accueil -->
                    <li><a href="index.php">Accueil</a></li>

                    <!-- Affichage des liens de connexion ou déconnexion selon l'état de l'utilisateur -->
                    <?php if ($username === $compte) : ?>
                        <li><a href="connexion.php">Se connecter</a></li>
                    <?php else : ?>
                        <?php if ($username == 'Admin') :?>
                            <li><a href="admin.php">Administrateur</a></li>
                            <li><a href="logout.php">Se Déconnecter</a></li>
                        <?php else : ?>
                            <li><a href="profile.php">Mon Profil</a></li>
                            <li><a href="logout.php">Se Déconnecter</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- Affichage du pseudo de l'utilisateur connecté -->
            <div class="user-info">
                <p>Bienvenue, <?php echo $username; ?> !</p>
            </div>
        </div>
    </header>
</body>
</html>
