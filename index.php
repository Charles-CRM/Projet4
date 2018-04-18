<?php
require('./model/model.php');


$db = dbConnect();

$allChapters = $db->query('SELECT * FROM chapters');

require('./view/homepage.php');
