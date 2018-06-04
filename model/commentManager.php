<?php
require_once('./model/model.php');
require_once('./model/comment.php');
require_once('./model/database.php');



class CommentManager extends Model {

    // Add a new comment into the database.
    public function add(array $datas) {
        $comment = new Comment($datas);
        
        $db = new Db();
        $query = $db->db()->prepare('INSERT INTO comments(chapter_id, author, content) VALUES(:chapter_id, :author, :content)');
        $query->execute(array('chapter_id' => $comment->chapter_id(), 'author' => $comment->author(), 'content' => $comment->content()));
        unset($db);
    }
    
    // Update an existing comment.
    public function update(array $datas) {
        $db = new Db();
        $comment = $this->get($datas['id']);
        
        if (isset($datas['signaled'])) {
            if ($datas['signaled'] == '+1') {
                $datas['signaled'] = $comment->signaled() + 1;
            }
        }

        $comment->hydrate($datas);
        $publication_date = date('Y\-m\-d H\:i\:s', $comment->publication_date());
        $query = $db->db()->prepare('UPDATE comments SET chapter_id = :chapter_id, author = :author, publication_date = :publication_date, content = :content, moderated = :moderated, signaled = :signaled WHERE id = :id');
        $query->execute(array('id' => $comment->id(), 'chapter_id' => $comment->chapter_id(), 'author' => $comment->author(), 'publication_date' => $publication_date, 'content' => $comment->content(), 'moderated' => $comment->moderated(), 'signaled' => $comment->signaled()));
        unset($db);
    }
    
    // Get the comment corresponding to this id.
    public function get($id) {
        $db = new Db();
        $query = $db->db()->prepare("SELECT * FROM comments WHERE id = :id");
        $commentDatas = $query->execute(array('id' => $id));
        $commentDatas = $query->fetch();
        $query->closeCursor();
        unset($db);
        
        return !empty($commentDatas) ? new Comment($commentDatas) : false;
    }
    
    // Get a list of comments (all the signaled ones or all the ones attached to a specific chapter)
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
        
        $query = $db->db()->prepare('SELECT * FROM comments WHERE ' . $condition . ' ORDER BY publication_date ' . $order . ' LIMIT :offset , :number');
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':number', $number, PDO::PARAM_INT);
        $commentDatas = $query->execute();
        while ($commentDatas = $query->fetch()) {
            $comments[] = new Comment($commentDatas);
        }
        unset($db);
        
        return !empty($comments) ? $comments : false;
    }
    
    // Remove a comment of the database.
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