<?php
$route = isset($article) && $article->getId() ? 'editArticle&articleId='.$article->getId() : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
?>

<form method="post" action="./index.php?route=<?= $route; ?>">
    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?= isset($article) ? htmlspecialchars($article->getTitle()): ''; ?>"><br>
    <?= isset($errors['title']) ? $errors['title'] : ''; ?>
    <label for="content">Contenu</label><br>
    <textarea id="tinymce" class="textarea" name="content"><?= isset($article) ? htmlspecialchars($article->getContent()): ''; ?></textarea><br>
    <?= isset($errors['content']) ? $errors['content'] : ''; ?>
    <div class="text-center">
        <input class="btn btn-success" type="submit" value="<?= $submit; ?>" id="submit" name="submit">
    </div>
</form>