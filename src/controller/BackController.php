<?php

namespace blog\src\controller;

use blog\src\DAO\ArticleDAO;
use blog\src\model\View;

class BackController extends Controller
{
    // ajout d'un article
    public function addArticle($post)
    {
        if(isset($post['submit'])) {
            $this->articleDAO->addArticle($post);
            header('Location: ../public/index.php');
        }
        return $this->view->render('add_article', [
            'post' => $post
        ]);
    }
}