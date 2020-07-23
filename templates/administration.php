<?php $this->meta = "Page d'administration"; ?>
<?php $this->title = 'Administration'; ?>

<div class="container">
    <a class="btn btn-warning" href="../public/index.php">Retour à la liste des chapitres</a>
    <hr>
    <h2 id="sections">Nouveau chapitre</h2>
    <?php include('add_article.php') ?>
    <!-- <a class="btn btn-success" href="../public/index.php?route=addArticle">Écrire un nouveau chapitre</a> -->
    <hr>
    <h2 id="sections">Chapitres publiés</h2>
    <div class="table-responsive">
        <table class="table table-striped table-light table-hover">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Texte</th>
                <th scope="col">Parution</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article) { ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($article->getId());?></th>
                        <td><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= $article->getTitle();?></a></td>
                        <td><?= substr($article->getContent(), 0, 150);?></td>
                        <td><?= htmlspecialchars($article->getCreatedAt());?></td>
                        <td>
                            <a class="btn btn-warning" id="actions-btn" href="../public/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a>
                            <a class="btn btn-danger" id="actions-btn" href="../public/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <hr>
    <h2 id="sections">Commentaires signalés</h2>
    <div class="table-responsive">
        <table class="table table-striped table-light table-hover">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Message</th>
                <th scope="col">Parution</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    foreach ($comments as $comment)
                    {
                        ?>
                        <tr>
                            <th><?= htmlspecialchars($comment->getId());?></th>
                            <td><?= htmlspecialchars($comment->getPseudo());?></td>
                            <td><?= substr(htmlspecialchars($comment->getContent()), 0);?></td>
                            <td>Créé le : <?= htmlspecialchars($comment->getCreatedAt());?></td>
                            <td>
                                <a class="btn btn-success" id="actions-btn" href="../public/index.php?route=unflagComment&commentId=<?= $comment->getId(); ?>">Désignaler</a><br>
                                <a class="btn btn-danger" id="actions-btn" href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>
    </div>

</div>