<?php require_once "./partials/header.php"; 

if(!$_SESSION['admin_pseudo']){
    header('Location: connexion.php');
} 

?>

<h2>tevqfub</h2>








<?php 

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'trombinoscope');

$dns = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

try{
    $db = new PDO($dns, DB_USER, DB_PASS,
    [
        'PDO::ATTR_ERRMODE' => PDO::ERRMODE_EXCEPTION,
        'PDO::ATTR_DEFAULT_FETCH_MODE' => PDO::FETCH_ASSOC,
    ]);

} catch (PDOException $e){
    die('Erreur lors de la connexion ' . $e->getMessage());
}







try {
    $pdo = new PDO("mysql:host=localhost;dbname=trombinoscope", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = password_hash(trim($_POST['mdp']), PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO eleve (pseudo, password) VALUES (?, ?)");
    if ($stmt->execute([$pseudo, $password])) {
        $query = $pdo->prepare("SELECT id, pseudo FROM eleve WHERE pseudo = ?");
        $query->execute([$pseudo]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            echo "Registration successful! Welcome, " . htmlspecialchars($user['pseudo']);
        } else {
            echo "An error occurred while fetching user details.";
        }
    } else {
        echo "An error occurred while saving user data.";
    }
} else {
    echo "Please fill in all required fields.";
}
?>









<form method="POST" action="" style="text-align: center;">
        <input type="text" name="pseudo" placeholder=" Pseudo">
        <br>
        <input type="password" name="mdp" placeholder=" Mot de passe">
        <br><br>
        <input type="submit" name="envoi" class="submit">
    </form>
