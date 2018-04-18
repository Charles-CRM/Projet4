<?php

function dbConnect() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=chesfnpg_jf_alaska;charset=utf8', 'chesfnpg', 'OCV7b9h632F#');
        return $db;
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}