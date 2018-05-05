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
            $this->_db = new PDO('mysql:host=localhost;dbname=chesfnpg_jf_alaska;charset=utf8', 'chesfnpg', 'OCV7b9h632F#');
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}






/********************************************************************


                  Gardé le temps de faire des essais.
                            A supprimer.


********************************************************************/


// Connection to the database
    function connect() {
        try {
            $db = new PDO('mysql:host=localhost;dbname=chesfnpg_jf_alaska;charset=utf8', 'chesfnpg', 'OCV7b9h632F#');
            return $db;
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
