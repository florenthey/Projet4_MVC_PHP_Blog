<?php

namespace blog\src\DAO;

use blog\src\model\Article;

// extends lie Article à Database (et permet d'utiliser sa fonction createQuery)
class ArticleDAO extends DAO {

    // transforme  chaque champs de la table en propriété de l'objet article
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['author']);
        $article->setCreatedAt($row['createdAt']);
        return $article;
    }

    // récupère les articles de la bdd et renvois des objets
    public function getArticles(){
        $sql='SELECT * FROM blog.article ORDER BY id DESC';
        $result=$this->createQuery($sql);
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
        $sql='SELECT id, title, content, author, createdAt FROM blog.article WHERE id = ?';
        $result = $this->createQuery($sql,[$articleId]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }
}