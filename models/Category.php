<?php
// Modèle pour gérer les données des catégories
class Category {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer toutes les catégories
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Categorie");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>