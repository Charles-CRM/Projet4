<?php
require_once('./model/model.php');
require_once('./model/admin.php');
require_once('./model/database.php');



class AdminManager extends Model {

    public function login ($username, $password) {
        $username = (string) $username;
        $password = (string) $password;
        
        $db = new Db();
        $query = $db->db()->prepare('SELECT password_hash FROM admin WHERE username = :username');
        $query->execute(array('username' => $username));
        $user = $query->fetch();
        $query->closeCursor();
        
        if (!empty($user) &&  password_verify($password, $user['password_hash'])) {
            $_SESSION['username'] = $username;
        } else {
            echo "ERREUR : Mauvais nom d'utilisateur ou mot de passe.";
        }
        
        unset($db);
    }
}