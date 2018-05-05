<?php
require_once('./model/database.php');



if (array_key_exists('login', $_POST)) {
    userLogin();
}


if (array_key_exists('tinymceContent', $_POST)) {
    $tinymceContent = $_POST['tinymceContent'];
    //saveChapter()[Cette fonction n'existe plus];
}



if (empty($_SESSION['login'])) {
    require('./view/admin-login.php');
} else {
    require('./view/admin.php');
}









/*class AdminController {
    
    public function root() {
        if (array_key_exists('login', $_POST)) {
            userLogin();
        }

        if (array_key_exists('tinymceContent', $_POST)) {
            // Faire le nécessaire...
        }

        if (empty($_SESSION['login'])) {
            require('./view/admin-login.php');
        } else {
            require('./view/admin.php');
        }
    }
}*/