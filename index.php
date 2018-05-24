<?php

session_start();

require('./controller/admin.php');
require('./controller/chapter.php');
require('./controller/comment.php');
require('./controller/login.php');



$adminCtrl = new AdminController();
$chapterCtrl = new ChapterController();
$commentCtrl = new CommentController();
$loginCtrl = new LoginController();

$error;



if (array_key_exists('disconnection', $_POST)) {
    $loginCtrl->logout();
}



if (isset($_GET['admin'])) {
    if (array_key_exists('username', $_POST)) {
        $loginCtrl->login();
    }
    
    if (array_key_exists('chaptersPublicationInfosSave', $_POST)) {
        $adminCtrl->updateChaptersPublication();
    }
    
    if (array_key_exists('commentsModerationInfosSave', $_POST)) {
        $adminCtrl->updateCommentsModeration();
    }
    
    if (array_key_exists('editedComment', $_POST)
        && array_key_exists('editedId', $_POST)) {
        $commentCtrl->update();
    }
    
    if (array_key_exists('editedContent', $_POST)
        && array_key_exists('editedId', $_POST)
        && array_key_exists('editedNumber', $_POST)
        && array_key_exists('editedTitle', $_POST)) {
        if ($_POST['editedId'] == 'new') {
            $adminCtrl->newChapter();
        } else {
            $adminCtrl->update();
        }
    }

    if (empty($_SESSION['username'])) {
        $loginCtrl->display();
    } else {
        if (isset($_GET['toedit']) && !array_key_exists('editionSaveAndQuit', $_POST)) {
            $adminCtrl->edit();
        } else {
            $adminCtrl->display();
        }
    }
} else if (isset($_GET['chapter'])) {
    if (array_key_exists('newCommentAuthor', $_POST) && array_key_exists('newCommentContent', $_POST)) {
        $commentCtrl->newComment();
    }
    
    if (isset($_GET['signalComment'])) {
        $commentCtrl->signal();
    }
    
    
    if (isset($_GET['id']) && isset($_GET['id']))
    {
        $chapterCtrl->display();
    } else {
        echo "ERREUR : Identifiant de chapitre invalide.";
    }
} else {
    $chapterCtrl->displayAll();
}

