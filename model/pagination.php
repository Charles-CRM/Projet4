<?php
require_once('./model/chapterManager.php');



class Pagination {
    private $_chaptersPerPage = 1;
    private $_maxNbrOfLinks = 11;
    private $_chapterMngr;
    
    
    public function __construct() {
        $this->_chapterMngr = new ChapterManager;
    }
    
    
    // Getter
    public function chaptersPerPage() { return $this->_chaptersPerPage; }
    
    // Setter
    public function setChaptersPerPage($number) {
        $number = (int) $number;
        $this->_chaptersPerPage = $number;
    }
    
    
    public function display($currentPage) {
        $chaptersCount = $this->_chapterMngr->getChaptersCount();
        $pagesCount = ceil($chaptersCount / $this->_chaptersPerPage);
        $offset = 0;
        
        if ($pagesCount > $this->_maxNbrOfLinks) {
            if ($currentPage <=  ceil($this->_maxNbrOfLinks / 2)) {
                $offset = 0;
            } else if ($currentPage >  floor($pagesCount - ($this->_maxNbrOfLinks / 2))) {
                $offset = $pagesCount - $this->_maxNbrOfLinks;
            } else {
                $offset = $currentPage - ceil($this->_maxNbrOfLinks / 2);
            }
        }
        
        $currentPage = intval($currentPage);
        $currentPage = ceil($currentPage);
        if ($currentPage < 1) { $currentPage = 1; }
        else if ($currentPage > $pagesCount) { $currentPage = $pagesCount; }
        
        if ($pagesCount > 1) {
            echo "<div id='pagination'>";
            
            if ($currentPage == 1) {
                echo "<a href='./?p=1' target='_self'><i class='fas fa-step-backward hidden'></i></a>";
                echo "<a href='#' target='_self'><i class='fas fa-caret-left hidden'></i></a>";
            } else {
                echo "<a href='./?p=1' target='_self'><i class='fas fa-step-backward'></i></a>";
                echo "<a href='./?p=" . ($currentPage - 1) . "' target='_self'><i class='fas fa-caret-left'></i></a>";
            }

            $i = 1;
            while (($offset + $i) <= $pagesCount && $i <= $this->_maxNbrOfLinks) {
                if (($offset + $i) == $currentPage) {
                    echo "<a href='./?p=" . ($offset + $i) . "' target='_self' class='pageLink'><i class='fas fa-circle currentPage'></i><span>" . ($offset + $i) . "</span></a>";
                } else {
                    echo "<a href='./?p=" . ($offset + $i) . "' target='_self' class='pageLink'><i class='fas fa-circle'></i><span>" . ($offset + $i) . "</span></a>";
                }
                $i++;
            }
            
            if ($currentPage == $pagesCount) {
                echo "<a href='#' target='_self'><i class='fas fa-caret-right hidden'></i></a>";
                echo "<a href='./?p=" . $pagesCount . "' target='_self'><i class='fas fa-step-forward hidden'></i></a>";
            } else {
                echo "<a href='./?p=" . ($currentPage + 1) . "' target='_self'><i class='fas fa-caret-right'></i></a>";
                echo "<a href='./?p=" . $pagesCount . "' target='_self'><i class='fas fa-step-forward'></i></a>";
            }
            
            echo "</div>";
        }
    }
}
