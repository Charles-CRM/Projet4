<?php
require_once('./model/model.php');
require_once('./model/comment.php');
require_once('./model/database.php');



class CommentManager extends Model {

    public function add(array $datas) {
        $comment = new Comment($datas);
        
        $db = new Db();
        $query = $db->db()->prepare('INSERT INTO comments(chapter_id, author, content) VALUES(:chapter_id, :author, :content)');
        $query->execute(array('chapter_id' => $comment->chapter_id(), 'author' => $comment->author(), 'content' => $comment->content()));
        unset($db);
    }
    
    public function update(Comment $comment) {
        $db = new Db();
        $publication_date = date('Y\-m\-d H\:i\:s', $comment->publication_date());
        $query = $db->db()->prepare('UPDATE comments SET chapter_id = :chapter_id, author = :author, publication_date = :publication_date, content = :content, moderated = :moderated, signaled = :signaled WHERE id = :id');
        $query->execute(array('id' => $comment->id(), 'chapter_id' => $comment->chapter_id(), 'author' => $comment->author(), 'publication_date' => $publication_date, 'content' => $comment->content(), 'moderated' => $comment->moderated(), 'signaled' => $comment->signaled()));
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
    
    public function getList(int $offset, int $number, int $chapterId = 1, bool $signaledOnly = false) {
        $comments = [];
        
        $db = new Db();
        
        if ($signaledOnly) {
            $condition = 'signaled != 0 AND moderated = false';
            $order = '';
        } else {
            $condition = 'chapter_id = ' . $chapterId;
            $order = 'DESC';
        }
        
        $query = $db->db()->prepare('SELECT * FROM comments WHERE ' . $condition . ' ORDER BY publication_date ' . $order . ' LIMIT ' . $offset . ' , ' . $number);
        $commentDatas = $query->execute();
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
    
    // Return the number of comments on a specific chapter present in the database.
    public function getCommentsCount(int $chapterId) {
        $db = new Db();
        $query = $db->db()->query('SELECT COUNT(*) FROM comments WHERE chapter_id = ' . $chapterId);
        $commentsCount = $query->fetchColumn();
        unset($db);
        
        return $commentsCount;
    }
}