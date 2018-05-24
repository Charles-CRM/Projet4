<?php
require_once('./model/chapterManager.php');



class ChapterController {
    
    function display() {
        $chapterMngr = new ChapterManager();
        $commentMngr = new CommentManager();
        $id = 1;

        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $id = ceil($id);
            if ($id < 1) { $id = 1; }
        }
        $chapter = $chapterMngr->get($id);
        
        $paginationLinkBase = './?chapter&id=' . $id . '&';
        $paginationLinkOption = '#commentsListSection';

        
        
        
        
        $offset = 0;
        $commentsPerPage = 10;
        $currentPageIx = 0;
        $pagesCount = ceil($commentMngr->getCommentsCount($id) / $commentsPerPage);
        
        if (isset($_GET['p'])) {
            $currentPageIx = intval($_GET['p']);
            $currentPageIx = ceil($currentPageIx);
            if ($currentPageIx < 0) { $currentPageIx = 0; }
            else if ($currentPageIx >= $pagesCount) { $currentPageIx = $pagesCount - 1; }
            
            $offset = $currentPageIx * $commentsPerPage;
        }
        
        $comments = $commentMngr->getList($offset, $commentsPerPage, $id);
        
        
        

        require('./view/chapter.php');
    }

    function displayAll() {
        $paginationLinkBase = './?';
        $paginationLinkOption = '';
        $offset = 0;
        $chaptersPerPage = 10;
        $currentPageIx = 0;
        $chapterMngr = new ChapterManager();        
        $pagesCount = ceil($chapterMngr->getChaptersCount() / $chaptersPerPage);

        if (isset($_GET['p'])) {
            $currentPageIx = intval($_GET['p']);
            $currentPageIx = ceil($currentPageIx);
            if ($currentPageIx < 0) { $currentPageIx = 0; }
            else if ($currentPageIx >= $pagesCount) { $currentPageIx = $pagesCount - 1; }
            
            $offset = $currentPageIx * $chaptersPerPage;
        }
        
        $chapters = $chapterMngr->getList($offset, $chaptersPerPage, true, false, true);

        require('./view/homepage.php');
    }

}
