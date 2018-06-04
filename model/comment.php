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
    public function id()            { return $this->_id;        }
    public function chapter_id()    { return $this->_chapter_id;}
    public function author()        { return $this->_author;    }
    public function content()       { return $this->_content;   }
    public function moderated()     { return $this->_moderated; }
    public function signaled()      { return $this->_signaled;  }
    public function publication_date(bool $humanFormat = false) {
        $publication_date = $this->_publication_date;
        if ($humanFormat) {
            $publication_date = date('\l\e d/m/Y \à H\hi', $publication_date);
        }
        return $publication_date;
    }
    
    
    // Setters
    public function setId($id) {
        $this->_id = abs((int) $id);
    }
    
    public function setChapter_id($chapter_id) {
        $this->_chapter_id = abs((int) $chapter_id);
    }
    
    public function setAuthor($author) {
        $this->_author = (string) $author;
    }
    
    public function setPublication_date($publication_date) {
        $this->_publication_date = strtotime($publication_date);
    }
    
    public function setContent($content) {
        $this->_content = (string) $content; 
    }
    
    public function setModerated($moderated) {
        $this->_moderated = (bool) $moderated;
    }
    
    public function setSignaled($signaled) {
        $this->_signaled = abs((int) $signaled);
    }
}