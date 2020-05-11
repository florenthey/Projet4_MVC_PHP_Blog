<?php

namespace blog\src\DAO;

// extends lie Article à Database (et permet d'utiliser sa fonction createQuery)
class ArticleDAO extends DAO {

    // récupère les articles 
    public function getArticles(){
        $sql='SELECT * FROM blog.article ORDER BY id DESC';
        return $this->createQuery($sql);
    }

    // récupère un article 
    public function getArticle($articleId)
    {
        $sql='SELECT id, title, content, author, createdAt FROM blog.article WHERE id = ?';
        return $this->createQuery($sql,[$articleId]);
    }
}