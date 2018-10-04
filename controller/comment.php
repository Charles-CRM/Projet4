<?php
require_once('./model/commentManager.php');



class CommentController {
    
    // Save the content of the comment writing textarea into a new Comment.
    public function newComment() {
        $datas['chapter_id'] = abs((int) $_GET['id']);
        $datas['author'] = trim(htmlspecialchars((string) $_POST['newCommentAuthor']));
        $datas['content'] = trim(htmlspecialchars((string) $_POST['newCommentContent']));

        if (!empty($datas['content']) && !empty($datas['author'])) {
            $commentMngr = new CommentManager();
            $commentMngr->add($datas);
            
            $_SESSION['commentsPseudo'] = $datas['author'];
        } else {
            $GLOBALS['error']['newComment'] = "Un commentaire ne peut pas être vide et doit impérativement être associé à un pseudo.";
        }
    }
    
    // Signal a comment.
    public function signal() {
        $id = abs((int) $_GET['signalComment']);

        $commentMngr = new CommentManager;
        $commentMngr->update(['id' => $id, 'signaled' => '+1']);
        
        $GLOBALS['error']['signaledComment'] = "Le commentaire a bien été signalé.";
    }
}