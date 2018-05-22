<?php
require_once('./model/commentManager.php');



class CommentController {
    
    function newComment() {
        $datas['chapter_id'] = (int) $_GET['id'];
        $datas['author'] = htmlspecialchars((string) $_POST['newCommentAuthor']);
        $datas['content'] = htmlspecialchars((string) $_POST['newCommentContent']);
        
        $commentMngr = new CommentManager();
        $commentMngr->add($datas);
    }
}