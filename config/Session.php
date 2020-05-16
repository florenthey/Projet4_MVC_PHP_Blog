<?php

namespace blog\config;

class Session
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    // récupère le nom
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    // retourne le nom
    public function get($name)
    {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    // affiche le nom
    public function show($name)
    {
        if(isset($_SESSION[$name]))
        {
            $key = $this->get($name);
            $this->remove($name);
            return $key;
        }
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function stop()
    {
        session_destroy();
    }

}