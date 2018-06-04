<?php
require_once('./model/userManager.php');



class LoginController {
    
    // Test if the username and the password match.
    public function login() {
        $username = (string) $_POST['username'];
        $password = (string) $_POST['password'];
        
        $userMngr = new UserManager();
        $userMngr->login($username, $password);
    }
    
    // Log the user out.
    public function logout() {
        session_unset();
    }
    
    // Display the login panel.
    public function display() {
        array_push($GLOBALS['pageStylesheets'], 'login');
        require('./view/login.php');
    }
}