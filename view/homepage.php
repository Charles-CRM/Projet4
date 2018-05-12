<?php include('./view/background.php'); ?>


    <?php
        $pagination->display($_GET['p']);
    ?>
   
    <div id='postsList'>
       
    <?php
        foreach ($chapters as $chapter)
        {
    ?>
       
        <div class='postContainer'>
            <div class='post'>
                <a class='chapterLink' href='./?page=chapter&id=<?= $chapter->id() ?>'><h3><?= $chapter->title() ?></h3></a>
                <p><?= $chapter->content() ?></p>
            </div>
        </div>
        
    <?php
        }
    ?>
        
    </div>
    

    <?php
        $pagination->display($_GET['p']);
    ?>


<?php include('./view/footer.php'); ?>
