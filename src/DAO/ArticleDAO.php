<?php

namespace blog\src\DAO;

use App\config\Parameter;
use blog\src\model\Article;

// extends lie Article à Database (et permet d'utiliser sa fonction createQuery)
class ArticleDAO extends DAO {

    // transforme  chaque champs de la table en propriété de l'objet article

    // private function buildObject($row, $comments)
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['author']);
        $article->setCreatedAt($row['createdAt']);
        // $article->setComments($comments);

        // var_dump($article);

        // $article = new Article();
        // $article
        //     ->setId($row['id'])
        //     ->setTitle($row['title'])
        //     ->setContent($row['content'])
        //     ->setAuthor($row['author'])
        //     ->setCreatedAt($row['createdAt'])
        // ;

        // var_dump($article);
        // die;

        return $article;
    }

    // récupère les articles de la bdd et renvois des objets
    public function getArticles()
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row){
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    // récupère un article 
    public function getArticle($articleId)
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article WHERE id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();

        // $comments = $this->commentDAO->getCommentsFromArticle($articleId);

        return $this->buildObject($article);
        // return $this->buildObject($article, $comments);
    }

    // insert un article
    public function addArticle(Parameter $post)
    {
        $sql = 'INSERT INTO article (title, content, author, createdAt) VALUES (?, ?, ?, NOW())';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $post->get('author')]);
    }
}