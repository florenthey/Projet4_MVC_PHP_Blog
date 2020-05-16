<?php

namespace blog\src\constraint;

class Validation
{
    //appelé depuis le controller et renvoit vers articleValidation si possibilité de validation d'article
    public function validate($data, $name)
    {
        if($name === 'Article') {
            $articleValidation = new ArticleValidation();
            $errors = $articleValidation->check($data);
            return $errors;
        }
    }
}