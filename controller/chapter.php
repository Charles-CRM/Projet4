<?php
require_once('./model/chapterManager.php');



$chapterMngr = new ChapterManager();

$chapter = $chapterMngr->get($_GET['id']);

require('./view/chapter.php');