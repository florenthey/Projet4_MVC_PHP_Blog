<?php

namespace blog\src\controller;

use blog\src\DAO\ArticleDAO;
use blog\src\DAO\CommentDAO;
use blog\src\model\View;

// centralise les données qui seront utilisées par les controllers qui héritent de cette classe
abstract class Controller
{
    protected $articleDAO;
    protected $commentDAO;
    protected $view;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
    }
}