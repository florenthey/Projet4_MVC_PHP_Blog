<?php

    use blog\src\DAO\ArticleDAO;
?>

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
    $article = new ArticleDAO();
    $articles = $article->getArticles();
    while($article = $articles->fetch())
    {
        ?>
        <div>
        <h2><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->id);?>"><?= htmlspecialchars($article->title);?></a></h2>
            <p><?= htmlspecialchars($article->content);?></p>
            <p><?= htmlspecialchars($article->author);?></p>
            <p>Créé le : <?= htmlspecialchars($article->createdAt);?></p>
        </div>
        <br>
        <?php
    }
    $articles->closeCursor();
    ?>

    <!-- <?php

    // création d'une instance de ma bdd
    //$db = new Database();

    // appel à la méthode de connexion
    //echo $db->getConnection();

    ?> -->

    </body>
</html>
</!DOCTYPE>
