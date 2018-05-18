<?php include('./view/background.php'); ?>


    <h2>Panneau d'administration</h2>
    
    <form id='adminEditionForm' method='post' action='/?admin&toedit=<?= $objectType ?>&id=<?= $editedObject->id() ?>'>
        <input type='hidden' id='editedId' name='editedId' value='<?= $editedObject->id() ?>' />
            
        <?php if (method_exists($editedObject, 'title')) { ?>
            <label for='editedTitle'>Titre :</label>
            <input type='text' id='editedTitle' name='editedTitle' value='<?= $editedObject->title() ?>' />
        <?php } ?>
        <label for='editedContent'>Contenu :</label>
        <textarea id='editedContent' name='editedContent'>
            <?= $editedObject->content() ?>
        </textarea>
        
        <div class='buttonsBox'>
            <input name='editionSaveAndQuit' class='bigButton' type='submit' value='Sauvegarder et quitter' />
            <input name='editionSaveAndStay' class='bigButton' type='submit' value='Sauvegarder' />
        </div>
    </form>
    


    <script src='./public/js/tinymce/tinymce.min.js'></script>
    <script src='./public/js/admin.js'></script>


<?php include('./view/footer.php'); ?>