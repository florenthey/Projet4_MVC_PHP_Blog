<?php

namespace blog\src\DAO;

use blog\config\Parameter;

class UserDAO extends DAO {
    
    public function login(Parameter $post) {
        $sql = 'SELECT id, password FROM user WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$post->get('pseudo')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($post->get('password'), $result['password']);
        
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }
}