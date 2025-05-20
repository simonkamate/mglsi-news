<?php
$host = 'localhost';
$dbname = 'mglsi_news';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Envoyer l'erreur à Sentry
    \Sentry\captureException($e);
    die("Échec de la connexion : " . $e->getMessage());
}
