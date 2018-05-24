<?php
require_once('./model/chapterManager.php');
require_once('./model/commentManager.php');



class AdminController {
    
    public function display() {
        $chapterMngr = new ChapterManager();
        $commentMngr = new CommentManager();
        $chapters = $chapterMngr->getList(0, 10000, false, true, false);
        $comments = $commentMngr->getList(0, 10000, 0, true);

        require_once('./view/admin.php');
    }
    
    public function newChapter() {
        $datas['title'] = htmlspecialchars((string) $_POST['editedTitle']);
        $datas['number'] = abs((int) $_POST['editedNumber']);
        $datas['content'] = (string) $_POST['editedContent'];
        
        $chapterMngr = new ChapterManager();
        $updatedChapter = $chapterMngr->add();
        $updatedChapter->hydrate($datas);
        $chapterMngr->update($updatedChapter);
        $_GET['toedit'] = $updatedChapter->id();
    }

    public function edit() {
        if ($_GET['toedit'] == 'new') {
            $id = 'new';
        } else {
            $id = abs((int) $_GET['toedit']);

            $chapterMngr = new ChapterManager();
            $editedChapter = $chapterMngr->get($id);
        }

        require_once('./view/edition.php');
    }
    
    public function update() {
        $chapterMngr = new ChapterManager();
        
        $datas['id'] = abs((int) $_POST['editedId']);
        $datas['title'] = htmlspecialchars((string) $_POST['editedTitle']);
        $datas['number'] = abs((int) $_POST['editedNumber']);
        $datas['content'] = (string) $_POST['editedContent'];
        
        $updatedChapter = $chapterMngr->get($datas['id']);
        $updatedChapter->hydrate($datas);
        $chapterMngr->update($updatedChapter);
    }
    
    public function updateChaptersPublication() {
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
                        $chapter->hydrate(['publication_date' => $publication_date, 'published' => true]);
                        $chapterMngr->update($chapter);
                    } else {
                        $GLOBALS['error'] = "Un chapitre ne peut être publié si un autre l'est déjà avec le même numéro.";
                    }
                } else {
                    $chapter->hydrate(['published' => false]);
                    $chapterMngr->update($chapter);
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
    
    public function updateCommentsModeration() {
        $commentMngr = new CommentManager();
        $comments = $commentMngr->getList(0, 10000, 0, true);
        
        foreach ($comments as $comment) {
            $ignorePostEntry = 'ignore-' . $comment->id();
            $deletePostEntry = 'delete-' . $comment->id();
            
            if (array_key_exists($ignorePostEntry, $_POST)) {
                $comment->hydrate(['moderated' => true]);
                $commentMngr->update($comment);
            }
            
            if (array_key_exists($deletePostEntry, $_POST)) {
                $commentMngr->delete($comment);
            }
        }
    }
}
