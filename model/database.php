<?php

class Db {
    private $_db;
    
    public function __construct() {
        $this->connect();
    }
    
    // getter
    public function db() { return $this->_db; }
    
    
    // Connection to the database
    private function connect() {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=chesfnpg_alaska_jf;charset=utf8', 'chesfnpg', 'OCV7b9h632F#');
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
