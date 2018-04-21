<?php
require('./model/model.php');


$db = dbConnect();

$chapterQuery = $db->prepare("SELECT * FROM chapters WHERE id = :id");
$chapter = $chapterQuery->execute(array('id' => $_GET['id']));
$chapter = $chapterQuery->fetch();
$chapterQuery->closeCursor();


require('./view/chapter.php');