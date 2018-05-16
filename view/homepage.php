<?php include('./view/background.php'); ?>


    <?php include('./view/pagination.php'); ?>
   
    <div id='postsList'>
       
    <?php
        foreach ($chapters as $chapter)
        {
    ?>
       
        <div class='postContainer'>
            <div class='post'>
                <a class='chapterLink' href='./?chapter&id=<?= $chapter->id() ?>'><h3><?= $chapter->title() ?></h3></a>
                <p><?= $chapter->content() ?></p>
            </div>
        </div>
        
    <?php
        }
    ?>
        
    </div>
    
    <?php include('./view/pagination.php'); ?>

<?php include('./view/footer.php'); ?>
