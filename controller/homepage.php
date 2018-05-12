<?php
require_once('./model/database.php');
require_once('./model/chapterManager.php');
require_once('./model/pagination.php');



$chapterMngr = new ChapterManager();
$pagination = new Pagination();

$offset = 0;
$number = $pagination->chaptersPerPage();

// ATTENTION, une valeur non entière pourrait être passée en GET.
if (isset($_GET['p'])) {
    $offset = ($_GET['p'] - 1) * $number;
}

$chapters = $chapterMngr->getList($offset, $number, false, false, true);




require('./view/homepage.php');
