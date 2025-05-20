<?php
// Vue pour afficher la liste des articles et la barre latérale des catégories
?>
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

<main class="w-full md:w-3/4">
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
</main>