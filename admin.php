<?php 
// Démarre une session pour pouvoir gérer les variables de session
ob_start();
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin, sinon redirige vers la page de connexion
if(!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] !== 'Admin'){
    // Redirection vers la page de connexion si l'utilisateur n'est pas un administrateur
    header('Location: connexion.php');
    exit(); // Arrête l'exécution du script après la redirection
} 

require_once "./partials/header_page.php"; 
?>

<h2>Ajouter un.e élève</h2>

<?php 

// Définition des constantes de connexion à la base de données
define('DB_HOST', 'localhost');  // Hôte de la base de données
define('DB_USER', 'root');       // Utilisateur pour se connecter à la base de données
define('DB_PASS', '');           // Mot de passe de l'utilisateur
define('DB_NAME', 'trombinoscope');  // Nom de la base de données

// Création de la chaîne de connexion pour PDO
$dns = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

try{
    // Connexion à la base de données avec PDO, mode d'erreur et de récupération par défaut
    $db = new PDO($dns, DB_USER, DB_PASS,
    [
        'PDO::ATTR_ERRMODE' => PDO::ERRMODE_EXCEPTION, // Gère les erreurs SQL
        'PDO::ATTR_DEFAULT_FETCH_MODE' => PDO::FETCH_ASSOC, // Mode de récupération des résultats (en tableau associatif)
    ]);

} catch (PDOException $e){
    // Si une erreur de connexion survient, affiche un message d'erreur
    die('Erreur lors de la connexion ' . $e->getMessage());
}

try {
    // Connexion supplémentaire à la base de données pour effectuer les opérations
    $pdo = new PDO("mysql:host=localhost;dbname=trombinoscope", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode gestion des erreurs
} catch (Exception $e) {
    // En cas d'erreur de connexion à la base de données, afficher un message d'erreur
    die('Error : ' . $e->getMessage());
}

// Si le formulaire a été soumis avec les données du pseudo et du mot de passe
if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = password_hash(trim($_POST['mdp']), PASSWORD_DEFAULT);

    // Prépare la requête d'insertion dans la base de données pour ajouter un nouvel élève
    $stmt = $pdo->prepare("INSERT INTO eleve (pseudo, password) VALUES (?, ?)");
    
    // Exécute la requête d'insertion
    if ($stmt->execute([$pseudo, $password])) {
        // Si l'insertion est réussie, récupère les informations de l'élève ajouté
        $query = $pdo->prepare("SELECT id, pseudo FROM eleve WHERE pseudo = ?");
        $query->execute([$pseudo]);
        $user = $query->fetch(PDO::FETCH_ASSOC); // Récupère les données de l'élève sous forme de tableau associatif

        if ($user) {
            // Si l'élève a bien été trouvé, on initialise la session avec ses informations
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            echo "Registration successful! Welcome, " . htmlspecialchars($user['pseudo']); // Affiche un message de bienvenue
        } else {
            echo "An error occurred while fetching user details."; // Si une erreur se produit lors de la récupération de l'élève
        }
    } else {
        // Si l'insertion échoue, afficher un message d'erreur
        echo "An error occurred while saving user data.";
    }
} else {
    // Si les champs du formulaire ne sont pas remplis, affiche un message d'erreur
    echo "Please fill in all required fields.";
}
?>

<!-- Formulaire pour ajouter un élève -->
<form method="POST" action="" style="text-align: center;">
    <input type="text" name="pseudo" placeholder=" Pseudo">
    <br>
    <input type="password" name="mdp" placeholder=" Mot de passe">
    <br><br>
    <input type="submit" name="envoi" class="submit">
</form>
