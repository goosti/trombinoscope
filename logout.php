<?php 
/* Se déconnecte du compte */
session_start();
$_SESSION = array();
session_destroy();
header('Location: index.php');
?>