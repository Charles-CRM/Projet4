<?php
require_once('./model/adminManager.php');



class LoginController {
    
    public function login() {
        $adminMngr = new AdminManager();
        
        $adminMngr->login($_POST['username'], $_POST['password']);
    }
    
    public function display() {
        require('./view/login.php');
    }
}