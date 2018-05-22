<?php
require_once('./model/model.php');
require_once('./model/commentManager.php');



class Chapter extends Model {
    private $_id;
    private $_title;
    private $_content;
    private $_publication_date;
    private $_published;
    private $_commentsNbr;
    
    // Constructer
    public function __construct(array $datas = []) {
        $this->hydrate($datas);
        $this->setCommentsNbr();
    }
    
    // Getters
    public function id() { return $this->_id; }
    public function title() { return $this->_title; }
    public function content() { return $this->_content; }
    public function published() { return $this->_published; }
    public function commentsNbr() { return $this->_commentsNbr; }
    public function publication_date(bool $humanFormat = false) {
        $publication_date = $this->_publication_date;
        if ($humanFormat) {
            $publication_date = date('\l\e d/m/Y', $publication_date);
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
    
    public function setTitle($title) {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }
    
    public function setContent($content) {
        if (is_string($content)) {
            $this->_content = $content;
        }        
    }
    
    public function setPublication_date($publication_date) {
        $publication_date = (int) $publication_date;
        if ($publication_date > 0) {
            $this->_publication_date = $publication_date;
        }
    }
    
    public function setPublished($published) {
        $published = boolval($published);
        $this->_published = $published;
    }
    
    public function setcommentsNbr() {
        $commentMngr = new CommentManager();
        $this->_commentsNbr = $commentMngr->getCommentsCount($this->_id);
    }
}
