<?php
// Modèle pour gérer les données des articles
class Article {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer un article par ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT a.*, c.libelle 
                                    FROM Article a 
                                    JOIN Categorie c ON a.categorie = c.id 
                                    WHERE a.id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer la liste des articles avec filtre par catégorie
    public function getAll($categoryId = null) {
        $where = $categoryId ? 'WHERE a.categorie = :category' : '';
        $params = $categoryId ? [':category' => $categoryId] : [];
        $query = "SELECT a.id, a.titre, a.image, c.libelle 
                  FROM Article a 
                  JOIN Categorie c ON a.categorie = c.id 
                  $where 
                  ORDER BY a.dateCreation DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>