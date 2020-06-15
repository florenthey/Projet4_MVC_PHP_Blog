<?php

namespace blog\src\controller;

use blog\config\Parameter;

class BackController extends Controller
{
    // public function addArticle(Parameter $post)
    // {
    //     if($post->get('submit')) {
    //         $errors = $this->validation->validate($post, 'Article');
    //         if(!$errors) {
    //             $this->articleDAO->addArticle($post);
    //             $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
    //             header('Location: ../public/index.php');
    //         }
    //         return $this->view->render('add_article', [
    //             'post' => $post,
    //             'errors' => $errors
    //         ]);
    //     }
    //     return $this->view->render('add_article');
    // }

    public function addArticle(Parameter $post)
    {
        if($this->checkAdmin()) {
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
                    $this->articleDAO->addArticle($post, $this->session->get('id'));
                    $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                    header('Location: ../public/index.php?route=administration');
                }
                return $this->view->render('add_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
            return $this->view->render('add_article');
        }
    }

    public function editArticle(Parameter $post, $articleId)
    {
        if($this->checkAdmin()) {
            $article = $this->articleDAO->getArticle($articleId);
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
                    $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
                    $this->session->set('edit_article', 'L\' article a bien été modifié');
                    header('Location: ../public/index.php?route=administration');
                }
                return $this->view->render('edit_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);

            }
            $post->set('id', $article->getId());
            $post->set('title', $article->getTitle());
            $post->set('content', $article->getContent());
            $post->set('author', $article->getAuthor());

            return $this->view->render('edit_article', [
                'post' => $post
            ]);
        }
    }

    public function deleteArticle($articleId)
    {
        if($this->checkAdmin()) {
            $this->articleDAO->deleteArticle($articleId);
            $this->session->set('delete_article', 'L\' article a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function deleteComment($commentId)
    {
        if($this->checkAdmin()) {
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }

      public function unflagComment($commentId)
    {
        if($this->checkAdmin()) {
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function logout()
    {
        if($this->checkLoggedIn())
        {
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'À bientôt');
            header('Location: ../public/index.php');
        }
    }

    private function checkLoggedIn()
    {
        if(!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    public function administration()
    {
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