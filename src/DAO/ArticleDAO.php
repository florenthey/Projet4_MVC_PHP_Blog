<?php

namespace blog\src\DAO;

use blog\config\Parameter;
use blog\src\model\Article;
use blog\src\DAO\CommentDAO;

// extends lie Article à Database (et permet d'utiliser sa fonction createQuery)
class ArticleDAO extends DAO {
    protected $commentDAO;

    public function __construct()
    {
        $this->commentDAO = new CommentDAO();
    }

    // transforme  chaque champs de la table en propriété de l'objet article

    // private function buildObject($row, $comments)
    private function buildObject($row)
    {
        $article = new Article();
        $article
            ->setId($row['id'])
            ->setTitle($row['title'])
            ->setContent($row['content'])
            ->setAuthor($row['author'])
            ->setCreatedAt($row['createdAt'])
            ->setComments($this->commentDAO->getCommentsFromArticle($row['id']))
        ;
        
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

        // $comments = $this->CommentDAO->getCommentsFromArticle($articleId);

        // return $this->buildObject($article, $comments);
        return $this->buildObject($article);
    }

    // insertion d'un article
    public function addArticle(Parameter $post)
    {
        $sql = 'INSERT INTO article (title, content, author, createdAt) VALUES (?, ?, ?, NOW())';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $post->get('author')]);
    }

    // édition d'un article
    public function editArticle(Parameter $post, $articleId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, author=:author WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'author' => $post->get('author'),
            'articleId' => $articleId
        ]);
    }

    public function deleteArticle($articleId)
    {
        $sql = 'DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$articleId]);
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }
}