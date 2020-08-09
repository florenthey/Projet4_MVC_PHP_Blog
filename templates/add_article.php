<?php
$route = isset($post) && $post->get('id') ? 'editArticle&articleId='.$post->get('id') : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
?>

<div class="container">
        <div class="card">
        <div class="card-body">
            <form method="post" action="./index.php?route=<?= $route; ?>">
                <label for="title">Titre</label><br>
                <input type="text" id="title" name="title" value="<?= isset($post) ? htmlspecialchars($post->get('title')): ''; ?>"><br>
                <?= isset($errors['title']) ? $errors['title'] : ''; ?>
                <label for="content">Contenu</label><br>
                <textarea id="tinymce" class="textarea" name="content"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?></textarea><br>
                <?= isset($errors['content']) ? $errors['content'] : ''; ?>
                <!-- <label for="author">Auteur</label><br>
                <input type="text" id="author" name="author" value="<?= isset($post) ? htmlspecialchars($post->get('author')): ''; ?>"><br>
                <?= isset($errors['author']) ? $errors['author'] : ''; ?> -->
                <div class="text-center">
                    <input class="btn btn-success" type="submit" value="<?= $submit; ?>" id="submit" name="submit">
                </div>
            </form>
        </div>
    </div>
