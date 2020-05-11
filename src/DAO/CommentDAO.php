<?php

namespace blog\src\DAO;

class CommentDAO extends DAO {

    // récupère tout les commentaires liés à un article spécifique
    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT id, pseudo, content, createdAt FROM blog.comment WHERE article_id = ? ORDER BY createdAt DESC';
        return $this->createQuery($sql, [$articleId]);
    }
}