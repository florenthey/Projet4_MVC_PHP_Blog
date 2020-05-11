<?php

namespace blog\config;
use Exception;

// intercepte les requètes et renvoie vers la vue adaptée
class Router
{
    public function run()
    {
        try{
            if(isset($_GET['route']))
            {
                if($_GET['route'] === 'article'){
                    require '../templates/single.php';
                }
                else{
                    echo 'page inconnue';
                }
            }
            else{
                require '../templates/home.php';
            }
        }
        catch (Exception $e)
        {
            echo 'Erreur';
        }
    }
}