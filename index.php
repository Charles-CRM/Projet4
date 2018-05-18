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
    
    if (array_key_exists('chaptersPublicationInfosSave', $_POST)) {
        $adminCtrl->updateChaptersPublication();
    }
    
    if (array_key_exists('newChapter', $_POST)) {
        $adminCtrl->newChapter();
    }

    if (array_key_exists('editedContent', $_POST) && array_key_exists('editedId', $_POST)) {
        $adminCtrl->update();
    }

    if (empty($_SESSION['username'])) {
        $loginCtrl->display();
    } else {
        if (isset($_GET['toedit']) && isset($_GET['id'])
           && !array_key_exists('editionSaveAndQuit', $_POST)) {
            $adminCtrl->edit($_GET['toedit'], $_GET['id']);
        } else if (!array_key_exists('newChapter', $_POST)){
            $adminCtrl->display();
        }
    }
} else if (isset($_GET['chapter'])) {
    if (isset($_GET['id']) && isset($_GET['id']))
    {
        $chapterCtrl->display();
    } else {
        echo "ERREUR : Identifiant de chapitre invalide.";
    }
} else {
    $chapterCtrl->displayAll();
}

