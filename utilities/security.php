<?php
session_start();
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

        // if ($_SERVER['SCRIPT_FILENAME'] = "C:/xampp/htdocs/Natures_Notebook-1/index.php"){
        //     header($_SERVER['PHP_SELF']);
        // } else {
            header("Location: ../index.php");
        // }
        
    }
// checking authority for web page
    public static function checkAuthority($auth){
        if (!isset($_SESSION[$auth]) || !$_SESSION[$auth]) {
            $_SESSION['log_message'] = 'Current login unauthorized for this page.';
            header("Location: ../index.php");
        }
    }
// Creating session from user level
    public static function setUserLevelSession($userLevel, $userId = null){
        switch ($userLevel) {
            case '1':
                $_SESSION['admin_level'] = true;
                $_SESSION['user_level'] = false;
                header('Location: admin_manage_users.php');
                break;
            case '2':
                $_SESSION['user_level'] = true;
                $_SESSION['admin_level'] = false;
                $_SESSION['user_id'] = $userId;
                header('Location: user_friends_photos.php');
                break;
            default:
                $_SESSION['log_message'] = 'Username or Password Incorrect.';
                break;
        }
    
    }


}