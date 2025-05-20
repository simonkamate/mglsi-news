<?php
// Définition des paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'mglsi_news';
$username = 'root';
$password = '';

try {
    // Création d'une instance PDO pour la connexion
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Gestion basique des erreurs sans Sentry
    die("Échec de la connexion : " . $e->getMessage());
}
?>