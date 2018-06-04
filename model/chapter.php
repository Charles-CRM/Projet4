<?php
require_once('./model/model.php');
require_once('./model/commentManager.php');



class Chapter extends Model {
    private $_id;
    private $_number;
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
    public function id()            { return $this->_id;            }
    public function number()        { return $this->_number;        }
    public function title()         { return $this->_title;         }
    public function content()       { return $this->_content;       }
    public function published()     { return $this->_published;     }
    public function commentsNbr()   { return $this->_commentsNbr;   }
    public function publication_date(bool $humanFormat = false) {
        $publication_date = $this->_publication_date;
        if ($humanFormat) {
            $publication_date = date('\l\e d/m/Y', $publication_date);
        }
        return $publication_date;
    }
    
    
    // Setters
    public function setId($id) {
        $this->_id = abs((int) $id);
    }
    
    public function setNumber($number) {
        $this->_number = abs((int) $number);
    }
    
    public function setTitle($title) {
        $this->_title = (string) $title;
    }
    
    public function setContent($content) {
        $this->_content = (string) $content; 
    }
    
    public function setPublication_date($publication_date) {
        $this->_publication_date = strtotime($publication_date);
    }
    
    public function setPublished($published) {
        $this->_published = (bool) $published;
    }
    
    public function setcommentsNbr() {
        $commentMngr = new CommentManager();
        if ($this->id() != null) {
            $this->_commentsNbr = $commentMngr->getCommentsCount($this->_id);
        }
    }
}
