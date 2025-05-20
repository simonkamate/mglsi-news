<?php
// Contrôleur pour gérer les actions liées à un article
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Article.php';

class ArticleController {
    private $articleModel;

    public function __construct() {
        global $pdo;
        $this->articleModel = new Article($pdo);
    }

    // Afficher un article spécifique
    public function show($id) {
        $article = $this->articleModel->getById($id);
        if (!$article) {
            header('Location: index.php');
            exit;
        }
        require_once __DIR__ . '/../views/layouts/main.php';
    }
}
?>