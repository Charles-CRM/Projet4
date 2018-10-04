<?php
require_once('./model/chapterManager.php');
require_once('./model/commentManager.php');



class AdminController {
    private $_chaptersPerPage = 10;
    private $_commentsPerPage = 10;
    
    // Display the admin panel.
    public function display() {
        if (isset($_SESSION['username'])) {

            // Chapters list pagination
            $chaptersOffset = 0;
            $chaptersCurrentPageIx = 0;
            $chapterMngr = new ChapterManager();        
            $chaptersPagesCount = ceil($chapterMngr->getChaptersCount(false) / $this->_chaptersPerPage);
            $chaptersPageGETparameter = 'chap-p';
            $chaptersPaginationLinkOption = '#adminChaptersList';
            
            if (isset($_GET['chap-p'])) {
                $chaptersCurrentPageIx = abs((int) $_GET['chap-p']);
                if ($chaptersCurrentPageIx >= $chaptersPagesCount) { $chaptersCurrentPageIx = $chaptersPagesCount - 1; }
                $chaptersOffset = $chaptersCurrentPageIx * $this->_chaptersPerPage;
            }
            
            // Comments list pagination
            $commentsOffset = 0;
            $commentsCurrentPageIx = 0;
            $commentMngr = new CommentManager();        
            $commentsPagesCount = isset($_GET['allcomments']) ? ceil($commentMngr->getCommentsCount(0, false) / $this->_commentsPerPage) : ceil($commentMngr->getCommentsCount(0, true) / $this->_commentsPerPage);
            $commentsPageGETparameter = 'comm-p';
            $commentsPaginationLinkOption = '#adminCommentsSection';
            
            if (isset($_GET['comm-p'])) {
                $commentsCurrentPageIx = abs((int) $_GET['comm-p']);
                if ($commentsCurrentPageIx >= $commentsPagesCount) { $commentsCurrentPageIx = $commentsPagesCount - 1; }
                $commentsOffset = $commentsCurrentPageIx * $this->_commentsPerPage;
            }
            
            $chaptersPaginationLinkBase = './?admin&comm-p=' . $commentsCurrentPageIx . '&';
            $commentsPaginationLinkBase = './?admin&chap-p=' . $chaptersCurrentPageIx . '&';
            

            $chapters = $chapterMngr->getList($chaptersOffset, $this->_chaptersPerPage, false, true, false);
            
            if (isset($_GET['allcomments'])) {
                $comments = $commentMngr->getList($commentsOffset, $this->_commentsPerPage, 0, false);
                $onlySignaledComments = false;
                $chaptersPaginationLinkBase = $chaptersPaginationLinkBase . 'allcomments&';
                $commentsPaginationLinkBase = $commentsPaginationLinkBase . 'allcomments&';
            } else {
                $comments = $commentMngr->getList($commentsOffset, $this->_commentsPerPage, 0, true);
                $onlySignaledComments = true;
            }
            
            $GLOBALS['pageTitle'] = "Panneau d'administration";
            array_push($GLOBALS['pageStylesheets'], 'admin', 'pagination');
            require_once('./view/admin.php');
        }
    }

    // Display the edit panel.
    public function edit() {
        if (isset($_SESSION['username'])) {
            if ($_GET['toedit'] == 'new') {
                $id = 'new';
            } else {
                $id = abs((int) $_GET['toedit']);

                $chapterMngr = new ChapterManager();
                $editedChapter = $chapterMngr->get($id);
            }
            if (!empty($editedChapter) || $id == 'new') {
                $GLOBALS['pageTitle'] = "Panneau d'édition";
                array_push($GLOBALS['pageStylesheets'], 'admin');
                require_once('./view/edition.php');
            }
        }
    }
    
    // Save the content of the edit panel as a new chapter.
    public function newChapter() {
        if (isset($_SESSION['username'])) {
            $datas['title'] = trim(htmlspecialchars((string) $_POST['editedTitle']));
            $datas['number'] = abs((int) $_POST['editedNumber']);
            $datas['content'] = (string) $_POST['editedContent'];

            if (!empty($datas['title'])) {
                $chapterMngr = new ChapterManager();
                $chapter = $chapterMngr->add($datas);
                
                $_GET['toedit'] = $chapter->id();
            } else {
                $GLOBALS['error']['adminTop'] = "Les chapitres et les notes doivent impérativement avoir un titre.";
                $_GET['toedit'] = 'new';
                unset($_POST['editionSaveAndQuit']);
            }
        }
    }
    
    // Save the content of the edit panel in an existing chapter.
    public function updateChapter() {
        if (isset($_SESSION['username'])) {
            $datas['id'] = abs((int) $_POST['editedId']);
            $datas['title'] = htmlspecialchars((string) $_POST['editedTitle']);
            $datas['number'] = abs((int) $_POST['editedNumber']);
            $datas['content'] = (string) $_POST['editedContent'];
            
            
            $chapterMngr = new ChapterManager();
            $chapter = $chapterMngr->get($datas['id']);
            
            // Check if the new number is valid.
            if ($chapter->published()
                && $datas['number'] != 0
                && $chapterMngr->isNumberFree($datas['number'])) {
                $chapterMngr->update($datas);
            } else if (($datas['number'] == 0 && !$chapter->published()) || $datas['number'] == $chapter->number() || !$chapter->published()) {
                $chapterMngr->update($datas);
            } else {
                $datas['number'] = $chapter->number();
                $chapterMngr->update($datas);
                if ($datas['number'] == 0 && $chapter->published()) {
                    $GLOBALS['error']['adminTop'] = "Un chapitre publié ne peut pas se voir affecter un numéro nul."; 
                } else {
                    $GLOBALS['error']['adminTop'] = "Deux chapitres ne peuvent être publiés avec le même numéro.";
                }
            }
        }
    }
        
    // Modify the content of a comment.
    public function updateComment() {
        if (isset($_SESSION['username'])) {
            $commentMngr = new CommentManager();

            $datas['id'] = abs((int) $_POST['editedId']);
            $datas['content'] = (string) $_POST['editedComment'];

            $commentMngr->update($datas);
        }
    }
    
    // Publish, unpublish, or delete chapters, as the user chose.
    public function updateChaptersPublication() {
        if (isset($_SESSION['username'])) {
            $chapterMngr = new ChapterManager();
            $chapters = $chapterMngr->getList(0, 10000, false, true, false);

            foreach ($chapters as $chapter) {
                if ($chapter->published()) {
                    $usedNumbers[$chapter->number()] = '';
                }
            }
            
            if (isset($_GET['chap-p'])) {
                $chaptersCurrentPageIx = abs((int) $_GET['chap-p']);
                $chaptersOffset = $chaptersCurrentPageIx * $this->_chaptersPerPage;
                
                $chapters = $chapterMngr->getList($chaptersOffset, $this->_chaptersPerPage, false, true, false);
            } else {
                $chapters = $chapterMngr->getList(0, $this->_chaptersPerPage, false, true, false);
            }

            foreach ($chapters as $chapter) {
                $publicationPostEntry = 'publication' . $chapter->id();
                $deletionPostEntry = 'delete' . $chapter->id();

                if ($chapter->number() > 0) {
                    // Update of the publication infos.
                    if (array_key_exists($publicationPostEntry, $_POST) && !$chapter->published()) {
                        if (!array_key_exists($chapter->number(), $usedNumbers)) {
                            $publication_date = date('Y\-m\-d H\:i\:s', time());
                            $chapterMngr->update(['id' => $chapter->id(), 'publication_date' => $publication_date, 'published' => true]);
                        } else if (!$chapter->published()) {
                            $GLOBALS['error']['adminTop'] = "Un chapitre ne peut être publié si un autre l'est déjà avec le même numéro.";
                        }
                    } else if (!array_key_exists($publicationPostEntry, $_POST)) {
                        $chapterMngr->update(['id' => $chapter->id(), 'published' => false]);
                    }
                } else if (array_key_exists($publicationPostEntry, $_POST)) {
                    $GLOBALS['error']['adminTop'] = "Un chapitre doit impérativement avoir un numéro supérieur à 0 pour pouvoir être publié.";
                }
                // Deletion of the selected chapters.
                if (array_key_exists($deletionPostEntry, $_POST)) {
                    $chapterMngr->delete($chapter);
                }
            }
        }
    }
    
    // Ignore or delete a comment as the admin chose.
    public function updateCommentsModeration() {
        if (isset($_SESSION['username'])) {
            $commentMngr = new CommentManager();
            if (isset($_GET['allcomments'])) {
                $comments = $commentMngr->getList(0, 10000, 0, false);
            } else {
                $comments = $commentMngr->getList(0, 10000, 0, true);
            }

            foreach ($comments as $comment) {
                $ignorePostEntry = 'ignore-' . $comment->id();
                $deletePostEntry = 'delete-' . $comment->id();

                if (array_key_exists($ignorePostEntry, $_POST)) {
                    $commentMngr->update(['id' => $comment->id(), 'moderated' => true]);
                }

                if (array_key_exists($deletePostEntry, $_POST)) {
                    $commentMngr->delete($comment);
                }
            }
        }
    }
}
