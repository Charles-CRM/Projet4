<?php include('./view/background.php'); ?>


    <h2>Panneau d'administration</h2>
    
    <form method='post' action='./?page=admin'>
        <textarea id='tinymceTextarea' name='tinymceContent'>
            <?= $tinymceContent ?>
        </textarea>
        <input type='submit' value='Sauvegarder' />
    </form>


    <script src='./public/js/tinymce/tinymce.min.js'></script>
    <script src='./public/js/tinymce/jquery.tinymce.min.js'></script>
    <script src='./public/js/admin.js'></script>


<?php include('./view/footer.php'); ?>