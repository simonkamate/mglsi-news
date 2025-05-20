<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGLSI News <?php echo isset($article) ? '- ' . htmlspecialchars($article['titre'], ENT_QUOTES, 'UTF-8') : ''; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-2xl font-bold">MGLSI News</h1>
    </header>

    <div class="container mx-auto p-4 flex flex-col md:flex-row gap-6">
        <?php if (isset($categories)): ?>
        <aside class="w-full md:w-1/4">
            <h2 class="text-xl font-semibold mb-4">Catégories</h2>
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
        <?php endif; ?>

        <main class="w-full md:w-3/4">
            <?php if (isset($article)): ?>
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
            <?php elseif (isset($articles)): ?>
                <h2 class="text-xl font-semibold mb-4">Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($articles as $article): ?>
                        <a href="index.php?action=show&id=<?php echo $article['id']; ?>"
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
            <?php endif; ?>
        </main>
    </div>

    <footer class="bg-gray-800 text-white p-4 mt-6">
        <p class="text-center">© <?php echo date('Y'); ?> MGLSI News</p>
    </footer>
</body>
</html>