<?php

namespace blog\src\controller;

use blog\config\Request;
use blog\src\constraint\Validation;
use blog\src\DAO\ArticleDAO;
use blog\src\DAO\CommentDAO;
use blog\src\DAO\UserDAO;
use blog\src\model\View;

abstract class Controller {
    protected $articleDAO;
    protected $commentDAO;
    protected $userDAO;
    protected $view;
    private $request;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;

    public function __construct() {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->validation = new Validation();
        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
    }
}