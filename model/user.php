<?php
require_once('./model/model.php');



class User extends Model {
    private $_id;
    private $_username;
    private $_password_hash;
    
    // Constructer
    public function __construct(array $datas) {
        $this->hydrate($datas);
    }
    
    // Getters
    public function id() { return $this->_id; }
    public function username() { return $this->_username; }
    public function password_hash() { return $this->_password_hash; }
    
    
    // Setters
    public function setId($id) {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }
    
    public function setUsername($username) {
        if (is_string($username)) {
            $this->_username = $username;
        }
    }
    
    public function setPassword_hash($password_hash) {
        if (is_string($password_hash)) {
            $this->_password_hash = $password_hash;
        }        
    }
}