<?php

class Security{
    // Ensuring that https security is being used
    public static function checkHTTPS() {
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on'){
            echo '<H1>HTTPS is Required!</H1>';
            exit();
        }
    }
// undoing authority by setting all session permissions to false, creating a log message and redirecting to index
    public static function logout(){
        unset($_POST);

        $_SESSION['admin_level'] = false;
        $_SESSION['user_level'] = false;

        $_SESSION['log_message'] = 'Sucessfully logged out.';
        header("Location: ../index.php");
    }
// checking authority for web page
    public static function checkAuthority($auth){
        if (!isset($_SESSION[$auth]) || !$_SESSION[$auth]) {
            $_SESSION['log_message'] = 'Current login unauthorized for this page.';
            header("Location: ../index.php");
        }
    }
// Creating session from user level
    public static function setUserLevelSession($userLevel){
        switch ($userLevel) {
            case '1':
                $_SESSION['admin_level'] = true;
                header('Location: view/admin.php');
                break;
            case '2':
                $_SESSION['tech_level'] = true;
                header('Location: view/user.php');
                break;
            default:
                $_SESSION['log_message'] = 'Failed Authentication - try again.';
                break;
        }
    
    }


}