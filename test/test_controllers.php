<?php
require_once '../controller/users_controller.php';
require_once '../controller/users.php';

// $r = UsersController::getAllUsers();

// $r = UsersController::getUserById(1);

// $r = UsersController::deleteUser(20);

// $user1 = new User("test1", "test1", "2023-10-11", "1234567890", "test11", "tes1t", "test1", "123451", "testemail1", "test1", "test1", 2, '2025/05/05',21
// );


// $r = UsersController::updateUser($user1);

$r = UsersController::validUser("davidlee", "password789");

$testing = "";