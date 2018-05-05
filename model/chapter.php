<?php
require_once('./model/model.php');



class Chapter extends Model {
    private $_id;
    private $_title;
    private $_content;
    private $_publication_date;
    private $_published;
    
    // Constructer
    public function __construct(array $datas) {
        $this->hydrate($datas);
    }
    
    // Getters
    public function id() { return $this->_id; }
    public function title() { return $this->_title; }
    public function content() { return $this->_content; }
    public function publication_date() { return $this->_publication_date; }
    public function published() { return $this->_published; }
    
    
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
    }
}
