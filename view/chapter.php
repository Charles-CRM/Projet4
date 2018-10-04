<!--**********************************************************************************

                                    Single chater page

***********************************************************************************-->

<?php include('./view/background.php'); ?>


<!--****************************   Chapter list   *********************************-->


<?php
    if (!empty($chapter))
    {
?>
    <div id='chapter'>
        <span id='chapterPublicationDate'>Publié <?= $chapter->publication_date(true) ?></span>
        <span id='chapterNumber'><?= $chapter->number() ?></span>
        <h3><?= $chapter->title() ?></h3>
        <p><?= $chapter->content() ?></p>
    </div>


<!--****************************   Comment writing field   ************************-->


    <section id='newCommentSection'>
        
        <?php if (isset($GLOBALS['error']['newComment'])) { ?>
            <div class='errorBox'>
                <span><?= $GLOBALS['error']['newComment'] ?></span>
            </div>
        <?php } ?>

        <form id='newCommentForm' method='post' action='.<?= $_SERVER['REQUEST_URI'] ?>#newCommentSection'>
            <label for='newCommentAuthor'>Pseudo :</label>
            <input id='newCommentAuthor' type='text' name='newCommentAuthor' required maxlength='20' <?= isset($_SESSION['commentsPseudo']) ? ('value=' . $_SESSION['commentsPseudo']) : '' ?> />
            <label for='newCommentContent'>Laisser un commentaire :</label>
            <textarea id='newCommentContent' name='newCommentContent' required maxlength='250'></textarea>
            <div class='buttonsBox'>
                <input class='bigButton' type='submit' value='Envoyer' />
            </div>
        </form>
    </section>


<!--****************************   Comments list   ********************************-->


    <?php if (!empty($comments)) { ?>

    <?php if (isset($GLOBALS['error']['signaledComment'])) { ?>
        <div class='errorBox'>
            <span><?= $GLOBALS['error']['signaledComment'] ?></span>
        </div>
    <?php } ?>
    
    <section id='commentsListSection'>
    
        <?php include('./view/pagination.php'); ?>

        <label id='chapterCommentsListLabel' for='chapterCommentsList'>Commentaires sur le chapitre :</label>
        <ul id='chapterCommentsList'>

            <?php foreach ($comments as $comment) { ?>

            <li>
                <div class='commentInfos'><span class='commentAuthor'><?= $comment->author() ?></span><span class='commentDate'><?= $comment->publication_date(true) ?></span><div class='commentSignalButton'><a class='signalCommentButton' href='.<?= $_SERVER['REQUEST_URI'] ?>&signalComment=<?= $comment->id() ?>#commentsListSection'><i class="fas fa-exclamation-circle" title='Signaler ce commentaire'></i></a></div></div>
                <p class='commentContent'><?= $comment->content() ?></p>
            </li>

            <?php } ?>

        </ul>

        <?php include('./view/pagination.php'); ?>
    
    </section>
    
    <?php } ?>

    <script src='./public/js/chapter.js'></script>

<?php
    } else {
        echo "ERREUR : Le chapitre que vous avez demandé n'existe pas.";
    }


    include('./view/footer.php');
?>