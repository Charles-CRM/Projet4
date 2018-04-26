<?php

// Connection to the database
function dbConnect() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=chesfnpg_jf_alaska;charset=utf8', 'chesfnpg', 'OCV7b9h632F#');
        return $db;
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

// Check user's login and password
function userLogin() {
    $db = dbConnect();
    
    $userQuery = $db->prepare('SELECT * FROM admin WHERE login = :login');
    $user = $userQuery->execute(array('login' => $_POST['login']));
    $user = $userQuery->fetch();
    $userQuery->closeCursor();
    
    if (!empty($user) &&  password_verify($_POST['password'], $user['password_hash'])) {
        $_SESSION['login'] = $_POST['login'];
    } else {
        echo "ERREUR : Mauvais nom d'utilisateur ou mot de passe.";
    }
}

// Save a chapter
function saveChapter() {
    $db = dbConnect();
    
    $chapterQuery = $db->prepare('UPDATE chapters SET content = :content WHERE id = 11');
    $chapterQuery->execute(array('content' => $_POST['tinymceContent']));
}