<?php
require('./model/model.php');



if (!empty($_POST['login'])) {
    userLogin();
}



if (empty($_SESSION['login'])) {
    require('./view/admin-login.php');
} else {
    require('./view/admin.php');
}