<?php

namespace blog\config;

class Session
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    // définie le message
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    // renvoie le message
    public function get($name)
    {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    // affiche le message si la variable existe
    public function show($name)
    {
        if(isset($_SESSION[$name]))
        { 
            $key = $this->get($name);
            //$this->remove($name);
            return $key;
        }
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function start()
    {
        session_start();
    }

    public function stop()
    {
        session_destroy();
    }
}