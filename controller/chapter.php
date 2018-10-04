<?php
require_once('./model/chapterManager.php');



class ChapterController {
    
    // Display a single chapter.
    function display() {
        $chapterMngr = new ChapterManager();
        $commentMngr = new CommentManager();
        $id = 1;

        if (isset($_GET['id'])) {
            $id =  abs((int) $_GET['id']);
        }
        $chapter = $chapterMngr->get($id);
        
        if (!empty($chapter)) {
            if ($chapter->published()) {
                $paginationLinkBase = './?chapter&id=' . $id . '&';
                $paginationLinkOption = '#commentsListSection';
                $pageGETparameter = 'p';

                $offset = 0;
                $commentsPerPage = 10;
                $currentPageIx = 0;
                $pagesCount = ceil($commentMngr->getCommentsCount($id) / $commentsPerPage);

                if (isset($_GET['p'])) {
                    $currentPageIx = abs((int) $_GET['p']);
                    if ($currentPageIx >= $pagesCount) { $currentPageIx = $pagesCount - 1; }
                    $offset = $currentPageIx * $commentsPerPage;
                }

                $comments = $commentMngr->getList($offset, $commentsPerPage, $id);

                $GLOBALS['pageTitle'] = "Chapitre " . $chapter->number() . " : " . $chapter->title();
                array_push($GLOBALS['pageStylesheets'], 'chapter', 'pagination');
                require('./view/chapter.php');
            }
        } else {
            echo "Le chapitre que vous avez demandé n'existe pas.";
        }
    }

    // Display a list of all published chapters.
    function displayAll() {
        $paginationLinkBase = './?';
        $paginationLinkOption = '';
        $pageGETparameter = 'p';
        
        $offset = 0;
        $chaptersPerPage = 10;
        $currentPageIx = 0;
        $chapterMngr = new ChapterManager();        
        $pagesCount = ceil($chapterMngr->getChaptersCount() / $chaptersPerPage);

        if (isset($_GET['p'])) {
            $currentPageIx = abs((int) $_GET['p']);
            if ($currentPageIx >= $pagesCount) { $currentPageIx = $pagesCount - 1; }
            $offset = $currentPageIx * $chaptersPerPage;
        }

        $chapters = $chapterMngr->getList($offset, $chaptersPerPage, true, false, true);

        if (!empty($chapters)) {
            array_push($GLOBALS['pageStylesheets'], 'homepage', 'pagination');
            require('./view/homepage.php');
        }
        else {
            echo "Impossible d'afficher les chapitres demandés";
        }
    }
}
