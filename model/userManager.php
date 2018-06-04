<?php
require_once('./model/model.php');
require_once('./model/user.php');
require_once('./model/database.php');



class UserManager extends Model {
    
    // Get the user corresponding to a specific id or username.
    public function get($user) {
        $db = new Db();
        if (is_int($user)) {
            $query = $db->db()->prepare("SELECT * FROM users WHERE id = :id");
            $userDatas = $query->execute(array('id' => $user));
        }
        if (is_string($user)) {
            $query = $db->db()->prepare("SELECT * FROM users WHERE username = :username");
            $userDatas = $query->execute(array('username' => $user));
        }
        $userDatas = $query->fetch();
        $query->closeCursor();
        unset($db);
        
        if (!empty($userDatas)) { return new User($userDatas); }
    }

    // Check if a password match the given username.
    public function login ($username, $password) {
        $user = $this->get($username);
        
        if (!is_null($user) &&  password_verify($password, $user->password_hash())) {
            $_SESSION['username'] = $username;
        } else {
            echo "ERREUR : Mauvais nom d'utilisateur ou mot de passe.";
        }
        
        unset($db);
    }
}