<?php
    session_start();
    require_once '../utilities/security.php';
    require_once '../controller/users.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/inputBoxErrorHandlerUser.php';


// Checking security
    Security::checkAuthority('admin_level');
// user logout
if (isset($_POST['logout'])){
    Security::logout();
}

// creating new user
$user = new User('', '', '', '', '', '', '', '','','','','','','');
// setting userNo
$user->setId_user(-1);
// Test to add or update user
$pageTitle = 'Add a New User';
// Gets user info
if (isset($_GET['pNo'])) {
    $user = UsersController::getUserById($_GET['pNo']);
    $pageTitle = 'Update an Existing User';
}
// Saves user details
if (isset($_POST['save'])){

    $user = new User($_POST['first_name'], $_POST['last_name'], "", $_POST['date_of_birth'], $_POST['phone_number'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['user_level'], "", $_POST['id_user']);

    $user->setId_user($_POST['id_user']);


// Decides to add or update user
    if ($passAllInputBoxTest == true) {

        if ($user->getId_user()==-1){
            UsersController::addUser($user);
        } else {
            UsersController::updateUser($user);
    }
// redirects page after post
        header('Location: ./admin_manage_users.php');
    }
}
// redirects page doesn't update
    if (isset($_POST['cancel'])){
            header('Location: ./admin_manage_users.php');
    }
?>

<html>
    <?php require_once("admin_nav_bar.php"); ?>

    <h2><?php echo $pageTitle ?></h2>
    <form method="post">
    <input type="hidden" name="id_user" value="<?php echo $user->getId_user(); ?>">
    <h2>User ID: <input type="text" name="id_user" value="<?php echo $user->getId_user(); ?>">
    </h2>
    <h2>First Name: <input type="text" name="first_name" value="<?php echo $user->getFirst_name(); ?>">
        <?php echo (isset($_POST['save']) ? $firstNameTestReturn : '') ?>
    </h2>
    <h2>Last Name: <input type="text" name="last_name" value="<?php echo $user->getLast_name(); ?>">
        <?php echo (isset($_POST['save']) ? $lastNameTestReturn : '') ?>
    </h2>
    <h2>Date of Birth: <input type="date" name="date_of_birth" value="<?php echo $user->getDate_of_birth(); ?>">
        <?php echo (isset($_POST['save']) ? $dateOfBirthTestReturn : '') ?>
    </h2>
    <h2>Phone Number: <input type="text" name="phone_number" value="<?php echo $user->getPhone_number(); ?>">
        <?php echo (isset($_POST['save']) ? $phoneNumberTestReturn : '') ?>
    </h2>
    <h2>Address: <input type="text" name="address" value="<?php echo $user->getAddress(); ?>">
        <?php echo (isset($_POST['save']) ? $addressTestReturn : '') ?>
    </h2>
    <h2>City: <input type="text" name="city" value="<?php echo $user->getCity(); ?>">
        <?php echo (isset($_POST['save']) ? $cityTestReturn : '') ?>
    </h2>
    <h2>State: <input type="text" name="state" value="<?php echo $user->getState(); ?>">
        <?php echo (isset($_POST['save']) ? $stateTestReturn : '') ?>
    </h2>
    <h2>Zip Code: <input type="text" name="zip" value="<?php echo $user->getZip(); ?>">
        <?php echo (isset($_POST['save']) ? $zipTestReturn : '') ?>
    </h2>
    <h2>Email Address: <input type="text" name="email" value="<?php echo $user->getEmail(); ?>">
        <?php echo (isset($_POST['save']) ? $emailTestReturn : '') ?>
    </h2>
    <h2>User Name: <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
        <?php echo (isset($_POST['save']) ? $usernameTestReturn : '') ?>
    </h2>
    <h2>Password: <input type="text" name="password" value="<?php echo $user->getPassword(); ?>">
        <?php echo (isset($_POST['save']) ? $passwordTestReturn : '') ?>
    </h2>

    <h2>User Level:</h2> <select name="user_level">
        <option value="0">Select User Level</option>
        <option value="1" <?php echo ($user->getUserLevel()==1) ? 'selected' : ''?> >Administrator</option>
        <option value="2"<?php echo ($user->getUserLevel()==2) ? 'selected' : ''?>>Customer</option>
    </select>

    <h2><?php echo (isset($_POST['save']) ? $usernameTestReturn : '') ?></h2>

        <input type="submit" name="save" value="Save">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</html>