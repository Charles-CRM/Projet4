<?php require('./view/background.php'); ?>


    <form method='post' action='./?admin'>
        <label for='username'>Nom d'utilisateur :</label>
        <input type='text' id='username' name='username' autofocus />
        <label for='password'>Mot de passe :</label>
        <input type='password' id='password' name='password' />
        <input type='submit' value='Envoyer' />
    </form>


<?php require('./view/footer.php'); ?>