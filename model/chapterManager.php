<?php
require_once('./model/model.php');
require_once('./model/chapter.php');
require_once('./model/database.php');



class ChapterManager extends Model {

    public function add() {
        $db = new Db();
        $query = $db->db()->query("INSERT INTO chapters(title, content, publication_date, published) VALUES('', '', 0, 0)");
        $query = $db->db()->query('SELECT * FROM chapters ORDER BY id DESC LIMIT 1');
        $chapterDatas = $query->fetch();
        $query->closeCursor();
        unset($db);
        
        return new Chapter($chapterDatas);
    }
    
    public function update(Chapter $chapter) {
        $db = new Db();
        $query = $db->db()->prepare('UPDATE chapters SET content = :content, title = :title, published = :published WHERE id = :id');
        $query->execute(array('id' => $chapter->id(), 'title' => $chapter->title(), 'content' => $chapter->content(), 'published' => $chapter->published()));
        unset($db);
    }
    
    public function get($id) {
        $db = new Db();
        $query = $db->db()->prepare("SELECT * FROM chapters WHERE id = :id");
        $chapterDatas = $query->execute(array('id' => $id));
        $chapterDatas = $query->fetch();
        $query->closeCursor();
        unset($db);
        
        return new Chapter($chapterDatas);
    }
    
    // ATTENTION, faire en sorte de pouvoir demander tant la liste des chapitres publiés que la liste complète.
    public function getList(int $offset, int $number, bool $sortByDate, bool $ascending, bool $extractsOnly) {
        $chapters = [];
        $sorting;
        $order;
        
        $db = new Db();
        
        if ($sortByDate) { $sorting = 'publication_date'; } else { $sorting = 'id'; }
        if ($ascending) { $order = ''; } else { $order = 'DESC'; }
        
        //$query = $db->db()->prepare("SELECT * FROM chapters ORDER BY :sorting :order LIMIT :offset, :number");
        //$chapterDatas = $query->execute(array('sorting' => $sorting, 'order' => $order, 'offset' => $offset, 'number' => $number));
        
        
        $query = $db->db()->prepare('SELECT * FROM chapters ORDER BY ' . $sorting . ' ' . $order . ' LIMIT ' . $offset . ' , ' . $number);
        $chapterDatas = $query->execute();
        
        /*$query = $db->db()->prepare('SELECT * FROM chapters ORDER BY :sorting :order LIMIT :offset , :count'); // . $sorting . ' ' . $order . ' LIMIT ' . $offset . ' , ' . $number);
        $chapterDatas = $query->execute(array(             'sorting' => $sorting,             'order' => $order,             'offset' => $offset,             'count' => $count,         ));*/

        while ($chapterDatas = $query->fetch()) {
            if ($extractsOnly) { $chapterDatas['content'] = $this->getExtract($chapterDatas['content']); }
            $chapters[] = new Chapter($chapterDatas);
        }
        unset($db);
        
        return $chapters;
    }
    
    public function delete(Chapter $chapter) {
        $db = new Db();
        $query = $db->db()->prepare('DELETE FROM chapters WHERE id = :id');
        $query->execute(array('id' => $chapter->id()));
        unset($db);
    }
    
    private function getExtract(string $text) {
        $extractLength = 500;
            
        $text = strip_tags($text);
        if (strlen($text) > $extractLength) {
            $text = '<p>' . substr($text, 0, strpos($text, ' ', $extractLength)) . '</p>';
        } else {
            $text = '<p>' . $text . '</p>';
        }
        
        return $text;
    }
    
    // ATTENTION, la fonction doit gérer les chapitres publiés ou non.
    public function getChaptersCount() {
        $db = new Db();
        $query = $db->db()->query('SELECT COUNT(*) FROM chapters');
        $chaptersCount = $query->fetchColumn();
        unset($db);
        
        return $chaptersCount;
    }
}