<?php

namespace blog\config;
use blog\src\controller\FrontController;
use blog\src\controller\ErrorController;
use blog\src\controller\BackController;
use Exception;

// intercepte les requètes et renvoie vers la vue adaptée
class Router
{
    private $frontController;
    private $errorController;
    private $backController;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
        $this->backController = new backController();
    }

    // instancie des objets et utilise les méthodes adaptées des classes correspondantes
    public function run()
    {
        try{
            if(isset($_GET['route']))
            {
                if($_GET['route'] === 'article'){
                    $this->frontController->article($_GET['articleId']);
                }
                elseif($_GET['route'] === 'addArticle'){
                    $this->backController->addArticle($_POST);
                }
                else{
                    $this->errorController->errorNotFound();
                }
            }
            else{
                $this->frontController->home();
            }
        }
        catch (Exception $e)
        {
            $this->errorController->errorServer();
        }
    }
}