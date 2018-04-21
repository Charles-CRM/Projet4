<?php
require('./model/model.php');


$db = dbConnect();

$allChaptersQuery = $db->query('SELECT * FROM chapters ORDER BY id DESC');

require('./view/homepage.php');
