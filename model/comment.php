<?php
require_once('./model/model.php');



class Comment extends Model {
    private $_id;
    private $_chapter_id;
    private $_author;
    private $_publication_date;
    private $_content;
    private $_moderated;
    private $_signaled;
    
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
    public function publication_date(bool $humanFormat = false) {
        $publication_date = $this->_publication_date;
        if ($humanFormat) {
            $publication_date = date('\L\e d/m/Y \à h\hi', $publication_date);
        }
        return $publication_date;
    }
    
    
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
    
    // (Limited to 20 characters.)
    public function setAuthor($author) {
        if (is_string($author)) {
            $this->_author = substr($author, 0, 20);
        }
    }
    
    public function setPublication_date($publication_date) {
        $publication_date = (int) $publication_date;
        if ($publication_date > 0) {
            $this->_publication_date = $publication_date;
        }
    }
    
    // (Limited to 250 characters.)
    public function setContent($content) {
        if (is_string($content)) {
            $this->_content = substr($content, 0, 250);
        }        
    }
    
    public function setModerated($moderated) {
        $moderated = boolval($moderated);
        $this->_moderated = $moderated;
    }
    
    public function setSignaled($signaled) {
        $signaled = (int) $signaled;
        if ($signaled > 0) {
            $this->_signaled = $signaled;
        }
    }
}