<?php
    include('./view/background.php');


    if (!empty($chapter))
    {
?>

    
    <div id='chapter'>
        <span id='chapterPublicationDate'>Publié <?= $chapter->publication_date(true) ?></span>
        <h3><?= $chapter->title() ?></h3>
        <p><?= $chapter->content() ?></p>
    </div>

    <form id='newCommentForm' method='post' action='.<?= $_SERVER['REQUEST_URI'] ?>#newCommentForm'>
        <label for='newCommentAuthor'>Pseudo :</label>
        <input id='newCommentAuthor' type='text' name='newCommentAuthor' required maxlength='20' />
        <label for='newCommentContent'>Laisser un commentaire :</label>
        <textarea id='newCommentContent' name='newCommentContent' required maxlength='250'></textarea>
        <div class='buttonsBox'>
            <input class='bigButton' type='submit' value='Envoyer' />
        </div>
    </form>

    <?php if (count($comments) > 0) { ?>
    
    <section id='commentsListSection'>
    
        <?php include('./view/pagination.php'); ?>

        <label id='chapterCommentsListLabel' for='chapterCommentsList'>Commentaires sur le chapitre :</label>
        <ul id='chapterCommentsList'>

            <?php foreach ($comments as $comment) { ?>

            <li>
                <div class='commentInfos'><span class='commentAuthor'><?= $comment->author() ?></span><span class='commentDate'><?= $comment->publication_date(true) ?></span><div class='commentSignalButton'><a href='.<?= $_SERVER['REQUEST_URI'] ?>&signalComment=<?= $comment->id() ?>'><i class="fas fa-exclamation-circle" title='Signaler ce commentaire'></i></a></div></div>
                <p class='commentContent'><?= $comment->content() ?></p>
            </li>

            <?php } ?>

        </ul>

        <?php include('./view/pagination.php'); ?>
    
    </section>
    
    <?php } ?>

<?php
    } else {
        echo "ERREUR : Le chapitre que vous avez demandé n'existe pas.";
    }


    include('./view/footer.php');
?>