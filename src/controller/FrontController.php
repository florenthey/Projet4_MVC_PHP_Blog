<?php

namespace blog\src\controller;

use blog\src\DAO\ArticleDAO;
use blog\src\DAO\CommentDAO;
use blog\src\model\View;

class FrontController
{
    private $articleDAO;

    private $commentDAO;

    private $view;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view=new View();
    }

    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render('home', [
            'articles' => $articles
        ]);
    }

    public function article($articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);

        return $this->view->render('single', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}