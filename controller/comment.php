<?php
require_once('./model/commentManager.php');



class CommentController {
    
    public function newComment() {
        $datas['chapter_id'] = abs((int) $_GET['id']);
        $datas['author'] = htmlspecialchars((string) $_POST['newCommentAuthor']);
        $datas['content'] = htmlspecialchars((string) $_POST['newCommentContent']);
        
        $commentMngr = new CommentManager();
        $commentMngr->add($datas);
    }
    
    public function signal() {
        $id = abs((int) $_GET['signalComment']);
        
        $commentMngr = new CommentManager;
        $comment = $commentMngr->get($id);
        $comment->hydrate(array('signaled' => ($comment->signaled() + 1)));
        $commentMngr->update($comment);
    }
    
    public function update() {
        $commentMngr = new CommentManager();
        
        $datas['id'] = abs((int) $_POST['editedId']);
        $datas['content'] = (string) $_POST['editedComment'];
        
        $updatedComment = $commentMngr->get($datas['id']);
        $updatedComment->hydrate($datas);
        $commentMngr->update($updatedComment);
    }
}