<?php require('./view/background.php'); ?>


    <form method='post' action='./?page=admin'>
        <label for='login'>Nom d'utilisateur :</label>
        <input type='text' id='login' name='login' />
        <label for='password'>Mot de passe :</label>
        <input type='password' id='password' name='password' />
        <input type='submit' value='Envoyer' />
    </form>


<?php require('./view/footer.php'); ?>