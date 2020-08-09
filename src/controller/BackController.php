<?php

namespace blog\src\controller;

use blog\config\Parameter;

class BackController extends Controller {

    public function addArticle(Parameter $post) {
        if($this->checkLoggedIn()) {
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
                    $this->articleDAO->addArticle($post, $this->session->get('id'));
                    $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                    header('Location: ./index.php?route=administration');
                }

                return $this->view->render('add_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }

            return $this->view->render('add_article');
        }
    }

    public function editArticle(Parameter $post, $articleId) {
        if($this->checkLoggedIn()) {
            $article = $this->articleDAO->getArticle($articleId);
            $errors = null;

            if ($post->get('submit')) {
                $article
                    ->setTitle($post->get('title'))
                    ->setContent($post->get('content'))
                    ->setUserId($this->session->get('id'))
                ;
                $errors = $this->validation->validate($post, 'Article');

                if (!$errors) {
                    $this->articleDAO->editArticle($article);
                    $this->session->set('edit_article', 'L\' article a bien été modifié');

                    header('Location: ./index.php?route=administration');
                } 
            }

            return $this->view->render('edit_article', [
                'article' => $article,
                'errors' => $errors
            ]);
        }
    }

    public function deleteArticle($articleId) {
        if($this->checkLoggedIn()) {
            $this->articleDAO->deleteArticle($articleId);
            $this->session->set('delete_article', 'L\' article a bien été supprimé');

            header('Location: ./index.php?route=administration');
        }
    }

    public function deleteComment($commentId) {
        if($this->checkLoggedIn()) {
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');

            header('Location: ./index.php?route=administration');
        }
    }

    public function unflagComment($commentId) {
        if($this->checkLoggedIn()) {
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');

            header('Location: ./index.php?route=administration');
        }
    }

    public function logout() {
        if($this->checkLoggedIn()) {
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'À bientôt');

            header('Location: ./index.php');
        }
    }

    private function checkLoggedIn() {
        if(!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');

            header('Location: ./index.php?route=login');
        }

        return true;
    }

    public function administration() {
        if($this->checkLoggedIn()) {
            $articles = $this->articleDAO->getArticles();
            $comments = $this->commentDAO->getFlagComments();

            return $this->view->render('administration', [
                'articles' => $articles,
                'comments' => $comments
            ]);
        }
    }
}