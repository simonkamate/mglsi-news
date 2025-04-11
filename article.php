<?php
require_once 'sentry_config.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGLSI News - Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-2xl font-bold">MGLSI News</h1>
    </header>

    <div class="container mx-auto p-4">
        <?php
        require_once 'db_connect.php';

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: index.php');
            exit;
        }

        $stmt = $pdo->prepare("SELECT a.*, c.libelle 
                              FROM Article a 
                              JOIN Categorie c ON a.categorie = c.id 
                              WHERE a.id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$article) {
            header('Location: index.php');
            exit;
        }
        ?>

        <article class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-blue-600 mb-4">
                <?php echo htmlspecialchars($article['titre'], ENT_QUOTES, 'UTF-8'); ?>
            </h1>

            <?php if ($article['image']): ?>
                <img src="uploads/<?php echo htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?php echo htmlspecialchars($article['titre'], ENT_QUOTES, 'UTF-8'); ?>"
                    class="w-full max-w-2xl mx-auto mb-4 rounded">
            <?php endif; ?>

            <p class="text-gray-600 text-sm mb-4">
                Publié le <?php echo date('d/m/Y H:i', strtotime($article['dateCreation'])); ?>
                dans <?php echo htmlspecialchars($article['libelle'], ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <div class="prose max-w-none">
                <?php echo nl2br(htmlspecialchars($article['contenu'], ENT_QUOTES, 'UTF-8')); ?>
            </div>

            <a href="index.php" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Retour à la liste
            </a>
        </article>
    </div>

    <footer class="bg-gray-800 text-white p-4 mt-6">
        <p class="text-center">© <?php echo date('Y'); ?> MGLSI News</p>
    </footer>
</body>

</html>