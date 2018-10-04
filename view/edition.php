<!--**********************************************************************************

                                    Edition panel

***********************************************************************************-->

<?php include('./view/background.php'); ?>


    <a href='./?admin' target='_self'><h2>Panneau d'administration</h2></a>

    <?php if (isset($GLOBALS['error']['adminTop'])) { ?>
        <div class='errorBox'>
            <span><?= $GLOBALS['error']['adminTop'] ?></span>
        </div>
    <?php } ?>
    
    <form id='adminEditionForm' method='post' action="/?admin&toedit=<?= $id ?>">
        <input type='hidden' id='editedId' name='editedId' value="<?= $id ?>" readonly />
            
        <label for='editedNumber'>Numéro :</label>
        <input type='number' id='editedNumber' name='editedNumber' value="<?= isset($editedChapter) ? $editedChapter->number() : (isset($_POST['editedNumber']) ? $_POST['editedNumber'] : 0) ?>" min='0' step='1' required />
        <label for='editedTitle'>Titre :</label>
        <input type='text' id='editedTitle' name='editedTitle' value="<?= isset($editedChapter) ? $editedChapter->title() : '' ?>" required />
        <label for='editedContent'>Contenu :</label>
        <textarea id='editedContent' name='editedContent'>
            <?= isset($editedChapter) ? $editedChapter->content() : (isset($_POST['editedContent']) ? $_POST['editedContent'] : '') ?>
        </textarea>
        
        <div class='buttonsBox'>
            <input name='editionSaveAndQuit' class='bigButton' type='submit' formaction='./?admin' value='Sauvegarder et quitter' />
            <input class='bigButton' type='submit' value='Sauvegarder' />
        </div>
    </form>
    


    <script src='./public/js/tinymce/tinymce.min.js'></script>
    <script src='./public/js/admin.js'></script>


<?php include('./view/footer.php'); ?>