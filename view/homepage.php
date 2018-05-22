<?php include('./view/background.php'); ?>


    <?php include('./view/pagination.php'); ?>
   
    <div id='postsList'>
       
    <?php
        foreach ($chapters as $chapter)
        {
    ?>
       
        <div class='postContainer'>
            <a class='chapterLink' href='./?chapter&id=<?= $chapter->id() ?>'>
                <div class='post'>
                    <h3><?= $chapter->title() ?></h3>
                    <p><?= $chapter->content() ?></p>
                    <div class='chapterInfos'><span class='chapterDate'>Publié <?= $chapter->publication_date(true) ?></span><span class='chapterCommentsNbr'><?= $chapter->commentsNbr() ?> commentaire(s)</span></div>
                </div>
            </a>
        </div>
        
    <?php
        }
    ?>
        
    </div>
    
    <?php include('./view/pagination.php'); ?>

<?php include('./view/footer.php'); ?>
