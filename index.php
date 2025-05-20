<?php
require_once 'sentry_config.php';
// throw new Exception("Erreur de test pour sentry");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGLSI News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        src="https://js-de.sentry-cdn.com/69b2102f2eb5d20adf64216248cd1985.min.js"
        crossorigin="anonymous"></script>
    <script>
        window.sentryOnLoad = function() {
            Sentry.init({
                // add other configuration here
            });

            Sentry.lazyLoadIntegration("feedbackIntegration")
                .then((feedbackIntegration) => {
                    Sentry.addIntegration(feedbackIntegration({
                        // User Feedback configuration options
                    }));
                })
                .catch(() => {
                    // this can happen if e.g. a network error occurs,
                    // in this case User Feedback will not be enabled
                });
        };
    </script>
</head>

<body class="bg-gray-100 font-sans">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-2xl font-bold">MGLSI News</h1>
    </header>

    <div class="container mx-auto p-4 flex flex-col md:flex-row gap-6">
        <!-- Categories Sidebar -->
        <aside class="w-full md:w-1/4">
            <h2 class="text-xl font-semibold mb-4">Catégories</h2>
            <?php
            require_once 'db_connect.php';
            $stmt = $pdo->query("SELECT * FROM Categorie");
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <ul class="space-y-2">
                <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="?category=<?php echo $category['id']; ?>"
                            class="block p-2 hover:bg-blue-100 rounded <?php echo (isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'bg-blue-200' : ''; ?>">
                            <?php echo htmlspecialchars($category['libelle'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <!-- Articles Listing -->
        <main class="w-full md:w-3/4">
            <h2 class="text-xl font-semibold mb-4">Articles</h2>
            <?php
            $where = '';
            $params = [];

            if (empty($_GET['category'])) {
                \Sentry\captureMessage("Aucune catégorie sélectionnée", \Sentry\Severity::info());
            }

            if (isset($_GET['category']) && !empty($_GET['category'])) {
                $where = 'WHERE a.categorie = :category';
                $params[':category'] = $_GET['category'];
            }

            $query = "SELECT a.id, a.titre, a.image, c.libelle 
                     FROM Article a 
                     JOIN Categorie c ON a.categorie = c.id 
                     $where 
                     ORDER BY a.dateCreation DESC";

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($articles as $article): ?>
                    <a href="article.php?id=<?php echo $article['id']; ?>"
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <?php if ($article['image']): ?>
                            <img src="uploads/<?php echo htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                alt="<?php echo htmlspecialchars($article['titre'], ENT_QUOTES, 'UTF-8'); ?>"
                                class="w-full h-48 object-cover">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Pas d'image</span>
                            </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-blue-600">
                                <?php echo htmlspecialchars($article['titre'], ENT_QUOTES, 'UTF-8'); ?>
                            </h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <footer class="bg-gray-800 text-white p-4 mt-6">
        <p class="text-center">© <?php echo date('Y'); ?> MGLSI News</p>
    </footer>


</body>

</html>