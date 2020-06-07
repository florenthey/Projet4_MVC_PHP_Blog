<?php

namespace blog\src\DAO;

use blog\config\Parameter;

class UserDAO extends DAO {
    
    public function login(Parameter $post)
    {
        $sql = 'SELECT id, password FROM user WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$post->get('pseudo')]);
        $result = $data->fetch();
        // var_dump($result);
        $isPasswordValid = password_verify($post->get('password'), $result['password']);
        // var_dump($isPasswordValid);

// $pass = password_hash('thebest', PASSWORD_DEFAULT);
// echo $pass;
// $pass = '$2y$10$mUgrnPo9DQCWPQt.yz3iUez8IvxH3npJ0VadlGU8kMnxHSW0wyU76';
// echo $pass;
// echo "<br>";
// var_dump(password_verify('Florent', $pass));
        
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];


 
        // public function checkPassword() {
        //     if($post->get('password') == $result['password']) {
        //         return ['isPasswordValid' => $isPasswordValid];
        //     }
        // }
    }
}