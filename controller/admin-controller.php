<?php
require('./model/model.php');



if (array_key_exists('login', $_POST)) {
    userLogin();
}


if (array_key_exists('tinymceContent', $_POST)) {
    $tinymceContent = $_POST['tinymceContent'];
    //saveChapter();
}



if (empty($_SESSION['login'])) {
    require('./view/admin-login.php');
} else {
    require('./view/admin.php');
}