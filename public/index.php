<?php

//if action = display
    //appel post controller
        //appel méthode display (+id) = methode de controller
            //appel requete bdd (+id) = class ds model
                //hydratation objet = model
                    //appel de la vue (+objet) = vue

require '../config/dev.php';
require '../vendor/autoload.php';

// intercepte les requètes et renvoie vers la vue adaptée
$router = new \blog\config\Router();
$router->run();