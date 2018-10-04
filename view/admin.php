<!--**********************************************************************************

                                    Admin panel

***********************************************************************************-->

<?php include('./view/background.php'); ?>


<!--****************************   Pseudo-header   ********************************-->


<div class='buttonsBox'>
    <form method='post' action='./'>
        <input name='disconnection' class='bigButton' type='submit' value='Se déconnecter' />
    </form>
</div>
   
<a href='./?admin' target='_self'><h2>Panneau d'administration</h2></a>
    
    <?php if (isset($GLOBALS['error']['adminTop'])) { ?>
        <div class='errorBox'>
            <span><?= $GLOBALS['error']['adminTop'] ?></span>
        </div>
    <?php } ?>
    

<!--****************************   Chapter list   *********************************-->


    <?php
        $pagesCount = $chaptersPagesCount;
        $currentPageIx = $chaptersCurrentPageIx;
        $paginationLinkBase = $chaptersPaginationLinkBase;
        $pageGETparameter = $chaptersPageGETparameter;
        $paginationLinkOption = $chaptersPaginationLinkOption;

        include('./view/pagination.php');
    ?>

    <form id='adminChaptersList' method='post' action='/?admin&chap-p=<?= isset($_GET['chap-p']) ? abs((int) $_GET['chap-p']) : 0 ?>'>
        <input type='hidden' name='chaptersPublicationInfos' value='save' readonly />
        <div class='formTableContainer'>
        <table>
            <caption>Liste des chapitres</caption>
            <thead>
                <tr>
                    <th>Titre du chapitre</th>
                    <th>Publier</th>
                    <th><i class="fas fa-trash-alt"></i></th>
                </tr>
            </thead>
            <tbody>

            <?php
                if (!empty($chapters)) {
                    foreach ($chapters as $chapter)
                    {
                        if ($chapter->number() > 0) {
                            $checked = $chapter->published() ? 'checked' : '';
            ?>

                <tr>
                    <td>
                        <a href='/?admin&toedit=<?= $chapter->id() ?>'><?= 'Chapitre ' . $chapter->number() . ' : ' . $chapter->title() ?></a>
                    </td>
                    <td>
                        <input type='checkbox' <?= $checked ?> name='publication<?= $chapter->id() ?>' />
                    </td>
                    <td>
                        <input type='checkbox' name='delete<?= $chapter->id() ?>' />
                    </td>
                </tr>

            <?php
                        }
                    }

                    foreach ($chapters as $chapter)
                    {
                        if ($chapter->number() == 0) {
                            $checked = $chapter->published() ? 'checked' : '';
            ?>

                <tr>
                    <td>
                        <a href='/?admin&toedit=<?= $chapter->id() ?>'>Notes : <?= $chapter->title() ?></a>
                    </td>
                    <td>
                        <input type='checkbox' <?= $checked ?> name='publication<?= $chapter->id() ?>' />
                    </td>
                    <td>
                        <input type='checkbox' name='delete<?= $chapter->id() ?>' />
                    </td>
                </tr>

            <?php
                        }
                    }
                }
            ?>
    
            </tbody>
        </table>
        </div>
        
        <div class='buttonsBox'>
            <input formaction='./?admin&toedit=new' class='bigButton' type='submit' value='Nouveau chapitre' />
            <input name='chaptersPublicationInfosSave' class='bigButton' type='submit' value='Sauvegarder' />
        </div>
    </form>

    <?php include('./view/pagination.php'); ?>
    

<!--****************************   Comments list   ********************************-->
    

    <?php if (isset($GLOBALS['error']['adminComments'])) { ?>
        <div class='errorBox'>
            <span><?= $GLOBALS['error']['adminComments'] ?></span>
        </div>
    <?php } ?>

    <?php if (!empty($comments)) { ?>
    
    <form id='adminComment' method='post' action='/?admin'>
        <input id='editedCommentId' name='editedId' type='hidden' />
        <label for='editedComment'>Commentaire sélectionné :</label>
        <textarea id='editedComment' name='editedComment'></textarea>
        
        <div class='buttonsBox'>
            <input class='bigButton' type='submit' name='commentEditionSave' value='Sauvegarder'/>
        </div>
    </form>
    
    <section id='adminCommentsSection'>
        
        <?php
            $pagesCount = $commentsPagesCount;
            $currentPageIx = $commentsCurrentPageIx;
            $paginationLinkBase = $commentsPaginationLinkBase;
            $pageGETparameter = $commentsPageGETparameter;
            $paginationLinkOption = $commentsPaginationLinkOption;

            include('./view/pagination.php');
        ?>
        
        <form method='post' action="<?php echo $onlySignaledComments ? './?admin' : './?admin&allcomments'; ?>">
        <div id='signaledCommentsTableContainer' class='tableContainer'>
            <table id='adminCommentsList'>
                <caption>Commentaires signalés</caption>
                <thead>
                    <tr>
                        <th>Chap.</th>
                        <th>Auteur</th>
                        <th>Commentaire</th>
                        <th>Ignor.</th>
                        <th><i class="fas fa-trash-alt"></i></th>
                    </tr>
                </thead>
                <tbody>


                   <?php foreach($comments as $comment) { ?>

                    <tr <?= (isset($_GET['allcomments']) && $comment->signaled() != 0 && $comment->moderated() == 0) ? "class='signaledComment'" : '' ?> >
                        <td><a href='./?chapter&id=<?= $comment->chapter_id() ?>' target=_blank><?= $comment->chapter_id() ?></a></td>
                        <td><?= $comment->author() ?></td>
                        <td id='comment-<?= $comment->id() ?>' class='comment'><?= $comment->content() ?></td>
                        <td><input type='checkbox' class='ignoreButton' name='ignore-<?= $comment->id() ?>' /></td>
                        <td><input type='checkbox' class='deleteButton' name='delete-<?= $comment->id() ?>' /></td>
                    </tr>

                   <?php } ?>

                </tbody>
            </table>
        </div>
        <div class='buttonsBox'>
            <?php echo $onlySignaledComments ?
                "<input name='displayAllComments' formaction='./?admin&allcomments' class='bigButton' type='submit' value='Afficher tous les commentaires' />"
                : "<input name='displayAllComments' formaction='./?admin' class='bigButton' type='submit' value=\"N'afficher que les commentaires signalés\" />";
            ?>
            <input name='commentsModerationInfosSave' class='bigButton' type='submit' value='Sauvegarder' />
        </div>
        </form>
        
        <?php include('./view/pagination.php'); ?>
        
    </section>
    
    <?php } ?>
    

<!--****************************   Scripts and footer   ***************************-->


    <script src='./public/js/tinymce/tinymce.min.js'></script>
    <script src='./public/js/admin.js'></script>
    

<?php include('./view/footer.php'); ?>