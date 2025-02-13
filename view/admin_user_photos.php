<?php
    session_start();
    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    
    Security::checkHTTPS();
    Security::checkAuthority('admin_level');

?>