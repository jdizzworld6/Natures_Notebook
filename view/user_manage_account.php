<?php
    require_once '../utilities/security.php';
    require_once '../controller/users.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/inputBoxErrorHandlerUser.php';


// Checking security
    Security::checkAuthority('user_level');
// user logout
if (isset($_POST['logout'])){
    Security::logout();
}

// creating new user
$user = new User('', '', '', '', '', '', '', '','','','','','','');

// Test to add or update user

// Gets user info
if (isset($_SESSION['user_id'])) {
    $user = UsersController::getUserById($_SESSION['user_id']);
}
// Saves user details
if (isset($_POST['save'])){

    $user = new User($_POST['first_name'], $_POST['last_name'], $_POST['date_of_birth'], $_POST['phone_number'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['user_level'],"", "", $_SESSION['user_id']);

    $user->setId_user($user->getId_user());

    UsersController::updateUser($user);

    header('Location: ./user_friends_photos.php?pNo=' . $user->getId_user());

    }
// redirects page doesn't update
    if (isset($_POST['cancel'])){
            header('Location: ./user_friends_photos.php?pNo=' . $user->getId_user());
    }

    if (isset($_POST['add_photo'])){
        header('Locaiton: ./user_add_profile_photo.php');
    }


?>

<html>

    <?php require_once("user_nav_bar.php");?>
    <input type="hidden" name="id_user" value="<?php echo $user->getId_user(); ?>">
<div class="container text-center mt-5">
    <div class="row pt-5">
        <h1 class="my-3">My Account</h1>
    </div>
    <div class="row">
        <h2>
            <a href="user_add_profile_photo.php" id="profile_button">Add Profile Image</a>
            <img src="<?php echo "images/" .  $user->getProfile_image() ?>" id="profile_image" alt="No Profile Image Selected"
        </h2>
    </div>

    <form method="post">

    <div class="row text-start mt-3" id="account_boarder">
            <div class="col">
                <h2>
                    <label for="">First Name: </label>
                    <input type="text" name="first_name" value="<?php echo $user->getFirst_name(); ?>">
                        <?php echo (isset($_POST['save']) ? $firstNameTestReturn : '') ?>
                </h2>
            </div>
            <div class="col">
                <h2>
                    <label for="">Last Name: </label>
                    <input type="text" name="last_name" value="<?php echo $user->getLast_name(); ?>">
                        <?php echo (isset($_POST['save']) ? $lastNameTestReturn : '') ?>
                </h2>
            </div>
            <div class="col">
                <h2>
                    <label for="">Date Of Birth: </label>
                    <input type="date" name="date_of_birth" value="<?php echo $user->getDate_of_birth(); ?>">
                        <?php echo (isset($_POST['save']) ? $dateOfBirthTestReturn : '') ?>
                </h2>
            </div>
    </div>
        <div class="row text-start mt-3" id="account_boarder">
            <div class="col">
                <h2>
                    <label for="">Address: </label>
                    <input type="text" name="address" value="<?php echo $user->getAddress(); ?>">
                        <?php echo (isset($_POST['save']) ? $addressTestReturn : '') ?>
                </h2>
            </div>
            <div class="col">
                <h2>
                <label for="">City: </label>
                <input type="text" name="city" value="<?php echo $user->getCity(); ?>">
                    <?php echo (isset($_POST['save']) ? $cityTestReturn : '') ?>
                </h2>
            </div>
            <div class="col">
                <h2>
                <label for="">State: </label>
                <input type="text" name="state" value="<?php echo $user->getState(); ?>">
                    <?php echo (isset($_POST['save']) ? $stateTestReturn : '') ?>
                </h2>
            </div>
            <div class="col">
                <h2>
                    <label for="">Zip Code: </label>
                    <input type="text" name="zip" value="<?php echo $user->getZip(); ?>">
                        <?php echo (isset($_POST['save']) ? $zipTestReturn : '') ?>
                </h2> 
            </div>
        </div>
        <div class="row text-start mt-3" id="account_boarder">
            <div class="col">
                <h2>
                    <label for="">Email: </label>
                    <input type="text" name="email" value="<?php echo $user->getEmail(); ?>">
                        <?php echo (isset($_POST['save']) ? $emailTestReturn : '') ?>
                </h2>
            </div>
            <div class="col">
                <h2>
                    <label for="">Phone Number: </label>
                    <input type="text" name="phone_number" value="<?php echo $user->getPhone_number(); ?>">
                    <?php echo (isset($_POST['save']) ? $phoneNumberTestReturn : '') ?>
                </h2>
            </div>
        </div>
        <div class="row text-start mt-3" id="account_boarder">
            <div class="col">
                <h2>
                    <label for="">Username: </label>
                    <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
                    <?php echo (isset($_POST['save']) ? $usernameTestReturn : '') ?>
                </h2>
            </div>
            <div class="col">
                <h2>
                    <label for="">Password: </label>
                    <input type="password" name="password" value="<?php echo $user->getPassword(); ?>">
                    <?php echo (isset($_POST['save']) ? $passwordTestReturn : '') ?>
                </h2>
            </div>
        </div>

    <h2 style="display: none;">User Level: </h2> <select style="display: none;" name="user_level">
        <option value="0">Select User Level</option>
        <option value="1" <?php echo ($user->getUserLevel()==1) ? 'selected' : ''?> >Administrator</option>
        <option value="2"<?php echo ($user->getUserLevel()==2) ? 'selected' : ''?>>Customer</option>
    </select>

    <h2><?php echo (isset($_POST['save']) ? $usernameTestReturn : '') ?></h2>

        <input id="save" type="submit" name="save" value="Save">
        <input id="cancel" type="submit" name="cancel" value="Cancel">
</div>
    </form>
</html>