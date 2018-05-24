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
            $this->_db = new PDO('mysql:host=localhost;dbname=chesfnpg_alaska_jf;charset=utf8', 'chesfnpg', 'OCV7b9h632F#', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //$this->_db = new PDO('mysql:host=localhost;dbname=jfalaska;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
