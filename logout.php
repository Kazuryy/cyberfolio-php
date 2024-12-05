<?php 
// On commence par démarrer la session
session_start();

// On vide toutes les variables de session
$_SESSION = array();

// Si vous souhaitez également supprimer le cookie de session (pratique pour une déconnexion complète)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// On détruit la session
session_destroy();

// On redirige l'utilisateur vers la page d'accueil ou une autre page
header("Location: index.php");
exit(); // Toujours appeler exit() après header pour arrêter le script
?>
