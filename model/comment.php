<?php
require_once('./model/model.php');



class Comment extends Model {
    private $_id;
    private $_chapter_id;
    private $_author;
    private $_content;
    private $_moderated;
    private $_signaled;
    private $_votes;
    
    // Constructer
    public function __construct(array $datas) {
        $this->hydrate($datas);
    }
    
    // Getters
    public function id() { return $this->_id; }
    public function chapter_id() { return $this->_chapter_id; }
    public function author() { return $this->_author; }
    public function content() { return $this->_content; }
    public function moderated() { return $this->_moderated; }
    public function signaled() { return $this->_signaled; }
    public function votes() { return $this->_votes; }
    
    
    // Setters
    public function setId($id) {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }
    
    public function setChapter_id($chapter_id) {
        $chapter_id = (int) $chapter_id;
        if ($chapter_id > 0) {
            $this->_chapter_id = $chapter_id;
        }
    }
    
    public function setAuthor($author) {
        if (is_string($author)) {
            $this->_author = $author;
        }
    }
    
    public function setContent($content) {
        if (is_string($content)) {
            $this->_content = $content;
        }        
    }
    
    public function setModerated($moderated) {
        $moderated = boolval($moderated);
    }
    
    public function setSignaled($signaled) {
        $signaled = (int) $signaled;
        if ($signaled > 0) {
            $this->_signaled = $signaled;
        }
    }
    
    public function setVotes($votes) {
        $votes = (int) $votes;
        if ($votes > 0) {
            $this->_votes = $votes;
        }
    }
}