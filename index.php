<?php
// Point d'entrée principal de l'application MVC
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/controllers/ArticleController.php';
require_once __DIR__ . '/controllers/IndexController.php';

$controller = new IndexController();
$articleController = new ArticleController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'show':
        $articleController->show($_GET['id'] ?? null);
        break;
    default:
        $controller->index();
        break;
}
?>