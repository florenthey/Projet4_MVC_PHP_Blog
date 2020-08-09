<?php

namespace blog\src\DAO;

use blog\config\Parameter;
use blog\src\model\Article;
use blog\src\DAO\CommentDAO;

class ArticleDAO extends DAO {
    protected $commentDAO;

    public function __construct()
    {
        $this->commentDAO = new CommentDAO();
    }

    private function buildObject($row)
    {
        $article = new Article();
        $article
            ->setId($row['id'])
            ->setTitle($row['title'])
            ->setContent($row['content'])
            ->setAuthor($row['pseudo'])
            ->setUserId($row['userId'])
            ->setCreatedAt($row['createdAt'])
            ->setComments($this->commentDAO->getCommentsFromArticle($row['id']))
        ;

        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT article.id, article.title, article.content, article.user_id AS userId, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id ORDER BY article.id DESC';
        $result = $this->createQuery($sql);

        $articles = [];
        foreach ($result as $row){
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
       
        return $articles;
    }

   public function getArticle($articleId)
    {
        $sql = 'SELECT article.id, article.title, article.content, article.user_id AS userId, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id WHERE article.id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }

    public function addArticle(Parameter $post, $userId) {
        $sql = 'INSERT INTO article (title, content, createdAt, user_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $userId]);
    }

    public function editArticle(Article $article) {
        $sql = 'UPDATE article SET title=:title, content=:content, user_id=:user_id WHERE id=:articleId';
 
        $this->createQuery($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'user_id' => $article->getUserId(),
            'articleId' => $article->getId(),
        ]);
    }

    public function deleteArticle($articleId) {
        $sql = 'DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$articleId]);
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }
}