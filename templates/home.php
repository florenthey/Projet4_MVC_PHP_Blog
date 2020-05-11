<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Blog de Jean Forteroche</title>
    </head>
    <body>
    <h1>Jean Forteroche</h1>
    <h2>Billet simple pour l'Alaska</h2>

    <?php
     foreach ($articles as $article)
    {
        ?>
        <div>
        <h2><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= htmlspecialchars($article->getTitle());?></a></h2>
            <p><?= htmlspecialchars($article->getContent());?></p>
            <p><?= htmlspecialchars($article->getAuthor());?></p>
            <p>Créé le : <?= htmlspecialchars($article->getCreatedAt());?></p>
        </div>
        <br>
        <?php
    }
    ?>
    </body>
</html>
</!DOCTYPE>
