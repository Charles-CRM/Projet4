<?php
require_once('./model/commentManager.php');



class CommentController {
    
    // Save the content of the comment writing textarea into a new Comment.
    public function newComment() {
        $datas['chapter_id'] = abs((int) $_GET['id']);
        $datas['author'] = htmlspecialchars((string) $_POST['newCommentAuthor']);
        $datas['content'] = htmlspecialchars((string) $_POST['newCommentContent']);

        $commentMngr = new CommentManager();
        $commentMngr->add($datas);
    }
    
    // Signal a comment.
    public function signal() {
        $id = abs((int) $_GET['signalComment']);

        $commentMngr = new CommentManager;
        $commentMngr->update(['id' => $id, 'signaled' => '+1']);
    }
}