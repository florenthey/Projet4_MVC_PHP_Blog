<?php

namespace blog\src\constraint;
use blog\config\Parameter;

class ArticleValidation extends Validation
{
    private $errors = [];
    private $constraint;

    // crée objet basé sur Contraint
    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    // récupère les données de la classe parameter via la méthode all et fait appel à la méthode checkField
    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    // vérifie les champs
    private function checkField($name, $value)
    {
        if($name === 'title') {
            $error = $this->checkTitle($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'content') {
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        }
        elseif($name === 'author') {
            $error = $this->checkAuthor($name, $value);
            $this->addError($name, $error);
        }
    }

    // ajoute une erreur si champ pas valide
    private function addError($name, $error) {
        if($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }

    // checkContent,  checkAuthor, checkAuthor font appels aux différentes contraintes crées
    private function checkTitle($name, $value)
    {
        if($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('titre', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('titre', $value, 2);
        }
        if($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('titre', $value, 255);
        }
    }

    private function checkContent($name, $value)
    {
        if($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('contenu', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('contenu', $value, 2);
        }
    }

    private function checkAuthor($name, $value)
    {
        if($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('auteur', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('auteur', $value, 2);
        }
        if($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('auteur', $value, 255);
        }
    }
}