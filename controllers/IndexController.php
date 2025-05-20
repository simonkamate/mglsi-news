<?php
// Contrôleur pour gérer la liste des articles
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Category.php';

class IndexController {
    private $articleModel;
    private $categoryModel;

    public function __construct() {
        global $pdo;
        $this->articleModel = new Article($pdo);
        $this->categoryModel = new Category($pdo);
    }

    // Afficher la liste des articles
    public function index() {
        $categories = $this->categoryModel->getAll();
        $articles = $this->articleModel->getAll($_GET['category'] ?? null);
        require_once __DIR__ . '/../views/layouts/main.php';
    }
}
?>