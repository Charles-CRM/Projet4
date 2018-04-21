<?php

if(isset($_GET['page'])) {
    if($_GET['page'] == 'chapter') {
        if(isset($_GET['id']) && $_GET['id'] > 0)
        {
            require('./controller/chapter-controller.php');
            echo "Ici devrait s'afficher un chapitre...";
        } else {
            echo "ERREUR : Identifiant de chapitre invalide.";
        }
    }

} else {
    require('./controller/homepage-controller.php');
}

?>