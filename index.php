<?php

session_start();

if (isset($_GET['page'])) {
    if ($_GET['page'] == 'chapter') {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            require('./controller/chapter.php');
        } else {
            echo "ERREUR : Identifiant de chapitre invalide.";
        }
    } else if ($_GET['page'] == 'admin') {
        require('./controller/admin.php');
    }

} else {
    require('./controller/homepage.php');
}

