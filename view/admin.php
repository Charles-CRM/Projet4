<?php include('./view/background.php'); ?>


    <div class='buttonsBox'>
        <form method='post' action='./'>
            <input name='disconnection' class='bigButton' type='submit' value='Se déconnecter' />
        </form>
    </div>
   
    <h2>Panneau d'administration</h2>
    
    <?php if (isset($GLOBALS['error'])) { ?>
        <div class='errorBox'>
            <span><?= $GLOBALS['error'] ?></span>
        </div>
    <?php } ?>
    
    <form id='adminChaptersList' method='post' action='/?admin'>
        <input type='hidden' name='chaptersPublicationInfos' value='save' />
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
            ?>
    
            </tbody>
        </table>
        </div>
        
        <div class='buttonsBox'>
            <input formaction='./?admin&toedit=new' class='bigButton' type='submit' value='Nouveau chapitre' />
            <input name='chaptersPublicationInfosSave' class='bigButton' type='submit' value='Sauvegarder' />
        </div>
    </form>
    
    
    
    
    
    
    
    <?php if (count($comments) > 0) { ?>
    
    <form id='adminComment' method='post' action='/?admin'>
        <input id='editedCommentId' name='editedId' type='hidden' />
        <label for='editedComment'>Commentaire sélectionné :</label>
        <textarea id='editedComment' name='editedComment'>
        </textarea>
        
        <div class='buttonsBox'>
            <input class='bigButton' type='submit' name='commentEditionSave' value='Sauvegarder'/>
        </div>
    </form>
    
    <form method='post' action='/?admin'>
    <div class='tableContainer'>
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
               
                <tr>
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
        <input name='commentsModerationInfosSave' class='bigButton' type='submit' value='Sauvegarder' />
    </div>
    </form>
    
    <?php } ?>
    
    
    
    
    
    
    <script src='./public/js/tinymce/tinymce.min.js'></script>
    <script src='./public/js/admin.js'></script>
    

<?php include('./view/footer.php'); ?>