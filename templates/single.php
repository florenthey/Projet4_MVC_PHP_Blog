<?php $title = $article->getTitle() ?>
<?php $this->meta = "Page contenant le chapitre: " .$title; ?>
<?php $this->title = "Article"; ?>
<?php setlocale(LC_TIME, "fr_FR"); ?>

<div class="container">
    <a class="btn btn-warning" href="./index.php">Retour à la liste des chapitres</a>
    <div class="card">
        <div class="card-header text-center">
            <h1><?= $title ?></h1>
        </div>
        <div class="card-body">
            <p><?= $article->getContent();?></p>
            <footer class="blockquote-footer">Publié le: <cite title="Source Title"><?= $dateFormat = strftime("%A %d %B %G", strtotime($article->getCreatedAt())); ?></cite></footer>
        </div>
        <div class="card-footer text-muted">
            <h3>Ajouter un commentaire</h3>
            <?php include('form_comment.php'); ?>
                <?php
                foreach ($article->getComments() as $comment) {
                    ?>
                    <hr/>
                    <h4><?= htmlspecialchars($comment->getPseudo());?></h4>
                    <p><?= htmlspecialchars($comment->getContent());?></p>
                    <p class="comment-date">Posté le: <?= htmlspecialchars($comment->getCreatedAt());?></p>
                    <?php
                if($comment->isFlag()) {
                    ?>
                    <p class="alerted-comment">Ce commentaire a été signalé</p>
                    <?php
                } else {
                    ?>
                    <a class="btn btn-danger" href="./index.php?route=flagComment&commentId=<?= $comment->getId(); ?>">Signaler le commentaire</a>
                    <?php
                }
                ?>
                <br>
                <?php
            }
            ?>
    </div>
    </div>

    <div class="actions">
        <!-- <a href="./index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a> -->
        <!-- <a href="./index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a> -->
    </div>

    </div>
</div>
