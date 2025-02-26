<?php
    require_once '../utilities/security.php';
    require_once '../controller/users.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/inputBoxErrorHandlerUser.php';


// Checking security
// user logout

// creating new user
$user = new User('', '', '', '', '', '', '', '','','','','','','');
// setting userNo
$user->setId_user(-1);
// Test to add or update user
$pageTitle = 'Add a New User';
// Gets user info

// Saves user details
if (isset($_POST['save'])){

    $user = new User($_POST['first_name'], $_POST['last_name'], $_POST['date_of_birth'], $_POST['phone_number'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['user_level'], date("Y-m-d H:i:s"), $_POST['id_user']);

    $user->setId_user($_POST['id_user']);

// Decides to add or update user
    if ($passAllInputBoxTest == true) {
        UsersController::addUser($user);
        $_SESSION['user_level'] = true;
        $new_user = UsersController::getUserByUserNamePassword($user->getUsername(), $user->getPassword());
        $_SESSION['user_id'] = $new_user->getId_user();
// redirects page after post
        header('Location: ./user_friends_photos.php');
    }
}
// redirects page doesn't update
    if (isset($_POST['cancel'])){
            header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature's Notebook Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

    <body>
        
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <h1>Create An Account</h1>
        </div>
    </div>

    <form method="post">
    <input type="hidden" name="id_user" value="<?php echo $user->getId_user(); ?>">
    <div class="row mt-3" id="account_boarder">
        <div class="col">
            <h2>First Name: <input type="text" name="first_name" value="<?php echo $user->getFirst_name(); ?>">
                <?php echo (isset($_POST['save']) ? $firstNameTestReturn : '') ?>
            </h2>
            </div>
        <div class="col">
            <h2>Last Name: <input type="text" name="last_name" value="<?php echo $user->getLast_name(); ?>">
                <?php echo (isset($_POST['save']) ? $lastNameTestReturn : '') ?>
            </h2>
        </div>
    </div>
    <div class="row mt-3" id="account_boarder">
        <div class="col">
            <h2>Date of Birth: <input type="date" name="date_of_birth" value="<?php echo $user->getDate_of_birth(); ?>">
                <?php echo (isset($_POST['save']) ? $dateOfBirthTestReturn : '') ?>
            </h2>
        </div>
        <div class="col">
            <h2>Phone Number: <input type="text" name="phone_number" value="<?php echo $user->getPhone_number(); ?>">
                <?php echo (isset($_POST['save']) ? $phoneNumberTestReturn : '') ?>
            </h2>
        </div>
    </div>
    <div class="row mt-3" id="account_boarder">
        <div class="col">
            <h2>Address: <input type="text" name="address" value="<?php echo $user->getAddress(); ?>">
                <?php echo (isset($_POST['save']) ? $addressTestReturn : '') ?>
            </h2>
        </div>
    </div>
    <div class="row mt-3" id="account_boarder">
        <div class="col">
            <h2>City: <input type="text" name="city" value="<?php echo $user->getCity(); ?>">
                <?php echo (isset($_POST['save']) ? $cityTestReturn : '') ?>
            </h2>
        </div>
        <div class="col">
            <h2>State: <input type="text" name="state" value="<?php echo $user->getState(); ?>">
                <?php echo (isset($_POST['save']) ? $stateTestReturn : '') ?>
            </h2>
        </div>
        <div class="col">
            <h2>Zip Code: <input type="text" name="zip" value="<?php echo $user->getZip(); ?>">
                <?php echo (isset($_POST['save']) ? $zipTestReturn : '') ?>
            </h2>
        </div>
    </div>
    <div class="row mt-3" id="account_boarder">
        <div class="col">
            <h2>Email Address: <input type="text" name="email" value="<?php echo $user->getEmail(); ?>">
                <?php echo (isset($_POST['save']) ? $emailTestReturn : '') ?>
            </h2>
        </div>
    </div>
    <div class="row mt-3" id="account_boarder">
        <div class="col">
            <h2>User Name: <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
                <?php echo (isset($_POST['save']) ? $usernameTestReturn : '') ?>
            </h2>
        </div>
        <div class="col">
            <h2>Password: <input type="password" name="password" value="<?php echo $user->getPassword(); ?>">
                <?php echo (isset($_POST['save']) ? $passwordTestReturn : '') ?>
            </h2>
        </div>
    </div>

    <input type="hidden" value="2" name="user_level">

    <h2><?php echo (isset($_POST['save']) ? $usernameTestReturn : '') ?></h2>
</div>
    <div class="container text-center">
    <div class="row mt-3">
        <div class="col">
            <input id="save" type="submit" name="save" value="Save">
        </div>
        <div class="col">
            <input id="cancel" type="submit" name="cancel" value="Cancel">
        </div>
    <div>
    </div>
    </form>

    </body>
</div>
</html>