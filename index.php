<?php

session_start();

require('./controller/admin.php');
require('./controller/chapter.php');
require('./controller/login.php');



$adminCtrl = new AdminController();
$chapterCtrl = new ChapterController();
$loginCtrl = new LoginController();











if (isset($_GET['admin'])) {
    if (array_key_exists('username', $_POST)) {
        $loginCtrl->login();
    }

    if (array_key_exists('tinymceContent', $_POST)) {
        $adminCtrl->update();
    }

    if (empty($_SESSION['username'])) {
        $loginCtrl->display();
    } else {
        $adminCtrl->display();
    }
} else if (isset($_GET['chapter'])) {
    if (isset($_GET['id']) && $_GET['id'] > 0)
    {
        $chapterCtrl->get();
    } else {
        echo "ERREUR : Identifiant de chapitre invalide.";
    }
} else {
    $chapterCtrl->getList();
}


















/*if (isset($_GET['page'])) {
    if ($_GET['page'] == 'chapter') {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            $chapterCtrl->get();
        } else {
            echo "ERREUR : Identifiant de chapitre invalide.";
        }
    } else if ($_GET['page'] == 'admin') {
        if (array_key_exists('username', $_POST)) {
            $loginCtrl->login();
        }

        if (array_key_exists('tinymceContent', $_POST)) {
            $adminCtrl->update();
        }

        if (empty($_SESSION['username'])) {
            $loginCtrl->display();
        } else {
            $adminCtrl->display();
        }
    }

} else {
    $chapterCtrl->getList();
}*/

