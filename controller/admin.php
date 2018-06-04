<?php
require_once('./model/chapterManager.php');
require_once('./model/commentManager.php');



class AdminController {
    
    // Display the admin panel.
    public function display() {
        if (isset($_SESSION['username'])) {
            $chapterMngr = new ChapterManager();
            $commentMngr = new CommentManager();
            $chapters = $chapterMngr->getList(0, 10000, false, true, false);
            $comments = $commentMngr->getList(0, 10000, 0, true);

            $GLOBALS['pageTitle'] = "Panneau d'administration";
            array_push($GLOBALS['pageStylesheets'], 'admin');
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
            $datas['title'] = htmlspecialchars((string) $_POST['editedTitle']);
            $datas['number'] = abs((int) $_POST['editedNumber']);
            $datas['content'] = (string) $_POST['editedContent'];

            $chapterMngr = new ChapterManager();
            $chapter = $chapterMngr->add($datas);
            
            $_GET['toedit'] = $chapter->id();
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
            $chapterMngr->update($datas);
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

            foreach ($chapters as $chapter) {
                $publicationPostEntry = 'publication' . $chapter->id();
                $deletionPostEntry = 'delete' . $chapter->id();

                if ($chapter->number() > 0) {
                    // Update of the publication infos.
                    if (array_key_exists($publicationPostEntry, $_POST)) {
                        if (!array_key_exists($chapter->number(), $usedNumbers)) {
                            if ($chapter->publication_date() > 0) {
                                $publication_date = date('Y\-m\-d H\:i\:s', $chapter->publication_date());
                            } else {
                                $publication_date = date('Y\-m\-d H\:i\:s', time());
                            }
                            $chapterMngr->update(['id' => $chapter->id(), 'publication_date' => $publication_date, 'published' => true]);
                        } else if (!$chapter->published()) {
                            $GLOBALS['error'] = "Un chapitre ne peut être publié si un autre l'est déjà avec le même numéro.";
                        }
                    } else {
                        $chapterMngr->update(['id' => $chapter->id(), 'published' => false]);
                    }
                } else if (array_key_exists($publicationPostEntry, $_POST)) {
                    $GLOBALS['error'] = "Un chapitre doit impérativement avoir un numéro supérieur à 0 pour pouvoir être publié.";
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
            $comments = $commentMngr->getList(0, 10000, 0, true);

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
