<?php
require_once('./model/model.php');
require_once('./model/chapter.php');
require_once('./model/database.php');



class ChapterManager extends Model {
    
    // Add a new chapter into the database.
    public function add(array $datas) {
        $chapter = new Chapter($datas);
        
        $db = new Db();
        $query = $db->db()->prepare('INSERT INTO chapters(title, number, content, published) VALUES(:title, :number, :content, 0)');
        $query->execute(array('title' => $chapter->title(), 'number' => $chapter->number(), 'content' => $chapter->content()));
        $query = $db->db()->query('SELECT * FROM chapters ORDER BY id DESC LIMIT 1');
        $chapterDatas = $query->fetch();
        $query->closeCursor();
        unset($db);
        
        return new Chapter($chapterDatas);
    }
    
    // Update a pre-existing chapter.
    public function update(array $datas) {
        $db = new Db();
        $chapter = $this->get($datas['id']);
        $chapter->hydrate($datas);
        $publication_date = date('Y\-m\-d H\:i\:s', $chapter->publication_date());
        $query = $db->db()->prepare('UPDATE chapters SET content = :content, number = :number, title = :title, publication_date = :publication_date, published = :published WHERE id = :id');
        $query->execute(array('id' => $chapter->id(), 'number' => $chapter->number(), 'title' => $chapter->title(), 'content' => $chapter->content(), 'publication_date' => $publication_date, 'published' => $chapter->published()));
        unset($db);
    }
    
    // Return the chapter corresponding to the id.
    public function get($id) {
        $db = new Db();
        $query = $db->db()->prepare("SELECT * FROM chapters WHERE id = :id");
        $chapterDatas = $query->execute(array('id' => $id));
        $chapterDatas = $query->fetch();
        $query->closeCursor();
        unset($db);
        
        return !empty($chapterDatas) ? new Chapter($chapterDatas) : false;
    }
    
    // Return a list of chapters (only the published ones or all of them).
    public function getList(int $offset, int $number, bool $publishedOnly, bool $ascending, bool $extractsOnly) {
        $chapters = [];
        $order = $ascending ? 'ASC' : 'DESC';
        $condition = $publishedOnly ? 'WHERE published = true' : '';
        
        $db = new Db();
        
        $query = $db->db()->prepare('SELECT * FROM chapters ' . $condition . ' ORDER BY number ' . $order . ' LIMIT :offset , :number');
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':number', $number, PDO::PARAM_INT);
        $chapterDatas = $query->execute();
        
        while ($chapterDatas = $query->fetch()) {
            if ($extractsOnly) { $chapterDatas['content'] = $this->getExtract($chapterDatas['content']); }
            $chapters[] = new Chapter($chapterDatas);
        }
        unset($db);
        
        return !empty($chapters) ? $chapters : false;
    }
    
    // Delete a chapter.
    public function delete(Chapter $chapter) {
        $db = new Db();
        $query = $db->db()->prepare('DELETE FROM chapters WHERE id = :id');
        $query->execute(array('id' => $chapter->id()));
        unset($db);
    }
    
    // Transform a string into an extract.
    private function getExtract(string $text) {
        $extractLength = 500;
            
        $text = strip_tags($text);
        if (strlen($text) > $extractLength) {
            $text = '<p>' . substr($text, 0, strpos($text, ' ', $extractLength)) . ' <strong>[...]</strong>' . '</p>';
        } else {
            $text = '<p>' . $text . '</p>';
        }
        
        return $text;
    }
    
    // Return the number of chapters (published or total) present in the database.
    public function getChaptersCount(bool $publishedOnly = true) {
        $condition = $publishedOnly ? 'true' : 'false';
        
        $db = new Db();
        $query = $db->db()->query('SELECT COUNT(*) FROM chapters WHERE published = ' . $condition);
        $chaptersCount = $query->fetchColumn();
        unset($db);
        
        return $chaptersCount;
    }
}