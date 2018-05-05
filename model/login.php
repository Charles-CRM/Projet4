<?php
require_once('./model/database.php');


    // Check user's login and password
    function userLogin() {
        $db = new Db();

        $userQuery = $db->db()->prepare('SELECT * FROM admin WHERE login = :login');
        $user = $userQuery->execute(array('login' => $_POST['login']));
        $user = $userQuery->fetch();
        $userQuery->closeCursor();

        if (!empty($user) &&  password_verify($_POST['password'], $user['password_hash'])) {
            $_SESSION['login'] = $_POST['login'];
        } else {
            echo "ERREUR : Mauvais nom d'utilisateur ou mot de passe.";
        }
        
        unset($db);
    }
