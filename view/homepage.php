<?php require('./view/background.php'); ?>


    <div id='postsList'>
       
    <?php
        while ($chapter = $allChaptersQuery->fetch())
        {
    ?>
       
        <div class='postContainer'>
            <div class='post'>
                <a class='chapterLink' href='./?page=chapter&id=<?= $chapter['id'] ?>'><h3><?= $chapter['title'] ?></h3></a>
                <p><?= $chapter['content'] ?></p>
            </div>
        </div>
        
    <?php
        }
        $allChaptersQuery->closeCursor();
    ?>
        
    </div>


<?php require('./view/footer.php'); ?>





// Faire des liens comprenants les id