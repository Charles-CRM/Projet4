<?php
    include('./view/background.php');
    
    if (!empty($chapter)) {
?>

   
    <div id='chapter'>
        <h3><?= $chapter->title() ?></h3>
        <p><?= $chapter->content() ?></p>
    </div>


<?php
    } else {
        echo "ERREUR : Le chapitre que vous avez demandé n'existe pas.";
    }
    include('./view/footer.php');
?>