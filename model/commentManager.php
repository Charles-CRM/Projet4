<?php
require_once('./model/model.php');
require_once('./model/comment.php');
require_once('./model/database.php');



class CommentManager extends Model {

    public function add(Comment $comment) {
        $db = new Db();
        $query = $db->db()->prepare('INSERT INTO comments(chapter_id, author, content, moderated, signaled, published) VALUES(chapter_id = :chapter_id, author = :author, content = :content, moderated = :moderated, signaled = :signaled, votes = :votes)');
        $query->execute(array('chapter_id' => $comment->chapter_id(), 'author' => $comment->author(), 'content' => $comment->content(), 'moderated' =>settype($comment->moderated(), 'integer'), 'signaled' => $comment->signaled(), 'votes' => $comment->votes()));
        unset($db);
    }
    
    public function update(Comment $comment) {
        $db = new Db();
        $query = $db->db()->prepare('UPDATE comments SET chapter_id = :chapter_id, author = :author, content = :content, moderated = :moderated, signaled = :signaled, votes = :votes WHERE id = :id');
        $query->execute(array('id' => $comment->id(), 'chapter_id' => $comment->chapter_id(), 'author' => $comment->author(), 'content' => $comment->content(), 'moderated' =>settype($comment->moderated(), 'integer'), 'signaled' => $comment->signaled(), 'votes' => $comment->votes()));
        unset($db);
    }
    
    public function get($id) {
        $db = new Db();
        $query = $db->db()->prepare("SELECT * FROM comments WHERE id = :id");
        $commentDatas = $query->execute(array('id' => $id));
        $commentDatas = $query->fetch();
        $query->closeCursor();
        unset($db);
        
        return new Comment($commentDatas);
    }
    
    public function getList(int $offset, int $number, bool $ascending) {
        $comments = [];
        $sorting = 'id';
        $order;
        
        $db = new Db();
        
        if ($ascending) { $order = ''; } else { $order = 'DESC'; }
        
        $query = $db->db()->prepare("SELECT * FROM comments ORDER BY :sorting :order LIMIT :offset, :number");
        $commentDatas = $query->execute(array('sorting' => $sorting, 'order' => $order, 'offset' => $offser, 'number' => $number));
        while ($commentDatas = $query->fetch()) {
            $comments[] = new Comment($commentDatas);
        }
        unset($db);
        
        return $comments;
    }
    
    public function delete(Comment $comment) {
        $db = new Db();
        $query = $db->db()->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(array('id' => $comment->id()));
        unset($db);
    }
}