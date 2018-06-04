<!--**********************************************************************************

                                    Edition panel

***********************************************************************************-->

<?php include('./view/background.php'); ?>


    <h2>Panneau d'administration</h2>
    
    <form id='adminEditionForm' method='post' action="/?admin&toedit=<?= $id ?>">
        <input type='hidden' id='editedId' name='editedId' value="<?= $id ?>" />
            
        <label for='editedNumber'>Numéro :</label>
        <input type='text' id='editedNumber' name='editedNumber' value="<?= isset($editedChapter) ? $editedChapter->number() : 0 ?>" required />
        <label for='editedTitle'>Titre :</label>
        <input type='text' id='editedTitle' name='editedTitle' value="<?= isset($editedChapter) ? $editedChapter->title() : '' ?>" required />
        <label for='editedContent'>Contenu :</label>
        <textarea id='editedContent' name='editedContent'>
            <?= isset($editedChapter) ? $editedChapter->content() : '' ?>
        </textarea>
        
        <div class='buttonsBox'>
            <input name='editionSaveAndQuit' class='bigButton' type='submit' formaction='./?admin' value='Sauvegarder et quitter' />
            <input class='bigButton' type='submit' value='Sauvegarder' />
        </div>
    </form>
    


    <script src='./public/js/tinymce/tinymce.min.js'></script>
    <script src='./public/js/admin.js'></script>


<?php include('./view/footer.php'); ?>