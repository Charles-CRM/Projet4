<?php
require_once('./model/chapterManager.php');
require_once('./model/commentManager.php');



class AdminController {
    
    public function display() {
        $chapterMngr = new ChapterManager();
        $chapters = $chapterMngr->getList(0, 10000, false, true, false);

        require_once('./view/admin.php');
    }
    
    public function newChapter() {
        $chapterMngr = new ChapterManager();
        $chapter = $chapterMngr->add();
        
        $this->edit('chapter', $chapter->id());
    }

    public function edit($type, $id) {
        $id = (int) $id;
        
        if ($type == 'chapter') {
            $objectMngr = new ChapterManager();
            $objectType = 'chapter';
        } else if ($type == 'comment') {
            $objectMngr = new CommentManager();
            $objectType = 'comment';
        }
        $editedObject = $objectMngr->get($id);
        
        require_once('./view/edition.php');
    }
    
    public function update() {
        $datas['id'] = (int) $_POST['editedId'];
        
        if (array_key_exists('editedTitle', $_POST)) {
            $objectMngr = new ChapterManager();
            $datas['title'] = htmlspecialchars((string) $_POST['editedTitle']);
        } else {
            $objectMngr = new CommentManager();
        }
        $updatedObject = $objectMngr->get($datas['id']);
        
        $datas['content'] = (string) $_POST['editedContent'];
        $updatedObject->hydrate($datas);
        
        $objectMngr->update($updatedObject);
    }
    
    public function updateChaptersPublication() {
        $chapterMngr = new ChapterManager();
        $chapters = $chapterMngr->getList(0, 10000, false, true, false);

        foreach ($chapters as $chapter) {
            $publicationPostEntry = 'publication' . $chapter->id();
            $deletionPostEntry = 'delete' . $chapter->id();
            $timestamp = 0;
            
            // Update of the publication infos.
            if (array_key_exists($publicationPostEntry, $_POST)) {
                if ($chapter->publication_date() > 0) {
                    $timestamp = time();
                }
                $chapter->hydrate(['publication_date' => $timestamp, 'published' => true]);
                $chapterMngr->update($chapter);
            } else {
                $chapter->hydrate(['published' => false]);
                $chapterMngr->update($chapter);
            }
            
            // Deletion of the selected chapters.
            if (array_key_exists($deletionPostEntry, $_POST)) {
                $chapterMngr->delete($chapter);
            }
        }
    }
}
