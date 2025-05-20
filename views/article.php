<?php
// Vue pour afficher un article spécifique
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