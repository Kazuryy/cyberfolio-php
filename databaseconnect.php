<?php
// Définition des constantes
define('MYSQL_HOST', 'localhost');  // Adresse de l'hôte (ex. 'localhost' ou une IP)
define('MYSQL_NAME', 'projets_serguei');  // Nom de votre base de données
define('MYSQL_PORT', '3306');  // Port MySQL (par défaut : 3306)
define('MYSQL_USER', 'root');  // Utilisateur MySQL
define('MYSQL_PASSWORD', 'root');  // Mot de passe de l'utilisateur MySQL

try {
    $mysqlClient = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
        MYSQL_USER,
        MYSQL_PASSWORD
    );
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}
?>

