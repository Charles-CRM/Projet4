<?php
require_once('./model/chapterManager.php');



class ChapterController {
    
    function display() {
        $chapterMngr = new ChapterManager();
        $id = 1;

        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $id = ceil($id);
            if ($id < 1) { $id = 1; }
        }

        $chapter = $chapterMngr->get($id);

        require('./view/chapter.php');
    }

    function displayAll() {
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
        
        $chapters = $chapterMngr->getList($offset, $chaptersPerPage, false, false, true);

        require('./view/homepage.php');
    }

}
