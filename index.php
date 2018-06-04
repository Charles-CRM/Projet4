<?php

session_start();

require('./controller/admin.php');
require('./controller/chapter.php');
require('./controller/comment.php');
require('./controller/login.php');

// Controllers initialization.
$adminCtrl = new AdminController();
$chapterCtrl = new ChapterController();
$commentCtrl = new CommentController();
$loginCtrl = new LoginController();

// Creation of some global variables.
$error;
$pageTitle = "Billet simple pour l'Alaska - Jean Forteroche";
$pageStylesheets = ['chapter-inner-style', 'main', 'background'];
    


// Log in or out functions
if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
    $loginCtrl->login();
}

if (array_key_exists('disconnection', $_POST)) {
    $loginCtrl->logout();
}

// Admin Panel
if (isset($_GET['admin'])) {
    
    if (isset($_SESSION['username'])) {
        
        // Datas process
        if (array_key_exists('chaptersPublicationInfosSave', $_POST)) {
            $adminCtrl->updateChaptersPublication();
        }

        if (array_key_exists('commentsModerationInfosSave', $_POST)) {
            $adminCtrl->updateCommentsModeration();
        }

        if (!empty($_POST['editedComment'])
            && !empty($_POST['editedId'])) {
            $adminCtrl->updateComment();
        }
    
        if (array_key_exists('editedContent', $_POST)
            && array_key_exists('editedId', $_POST)
            && array_key_exists('editedNumber', $_POST)
            && array_key_exists('editedTitle', $_POST)) {
            if ($_POST['editedId'] == 'new') {
                $adminCtrl->newChapter();
            } else {
                $adminCtrl->updateChapter();
            }
        }
        
        // Pages display
        if (isset($_GET['toedit']) && !array_key_exists('editionSaveAndQuit', $_POST)) {
            $adminCtrl->edit();
        } else {
            $adminCtrl->display();
        }
    } else {
        $loginCtrl->display();
    }

// Single-chapter page
} else if (isset($_GET['chapter']) && isset($_GET['id'])) {
    
    // Datas process
    if (array_key_exists('newCommentAuthor', $_POST) && array_key_exists('newCommentContent', $_POST)) {
        $commentCtrl->newComment();
    }
    
    if (isset($_GET['signalComment'])) {
        $commentCtrl->signal();
    }
    
    // Page display
    $chapterCtrl->display();

// Homepage
} else {
    $chapterCtrl->displayAll();
}
