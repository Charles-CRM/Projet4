<?php
require_once('./model/database.php');
require_once('./model/chapterManager.php');



$chapterMngr = new ChapterManager();
$chapters = $chapterMngr->getList(0, 10, false, false, true);

require('./view/homepage.php');
