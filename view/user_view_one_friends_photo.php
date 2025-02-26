<?php

require_once '../utilities/security.php';
require_once '../controller/users.php';
require_once '../controller/users_controller.php';
require_once '../controller/photo_category.php';
require_once '../controller/photo_category_controller.php';
require_once '../controller/photo.php';
require_once '../controller/photo_controller.php';
require_once '../controller/inputBoxErrorHandlerPhotoCategory.php';


// Checking security
Security::checkAuthority('user_level');
// user logout
if (isset($_POST['logout'])){
    Security::logout();
}
// gets one user by id
if (isset($_SESSION['user_id'])) {
    $user = UsersController::getUserById($_SESSION['user_id']);
}

// gets one user photo to be updated
if (isset($_GET['ID_photo'])) {
    $photo = PhotoController::getPhotoById($_GET['ID_photo']);
    $photo_categories = PhotoCategoryController::getAllPhotoCategory();
    $friend = UsersController::getUserById($_GET['ID_friend']);
}

// reformate upload date and have calander

if (isset($_POST['update_photo'])){
    $id_category = (int)$_POST['photo_category'];
    $photo_url = $photo->getPhoto_url();
    $photo = new Photo((int)$_SESSION['user_id'], $id_category, $_POST['photo_name'], $_POST['description'], $photo_url, $_POST['upload_date'], $_POST['location'], (int)$_GET['ID_photo']);

    PhotoController::updatePhoto($photo);
    header('Location: ./user_all_photos.php');
    
}
// Allows user to cancel
if (isset($_POST['all_photos'])){
    header('Location: ./user_friends_photos.php');
}
?>

<html>
    <?php require_once("user_nav_bar.php"); ?>
<div class="container text-center mt-5">
    <div class="row pt-5">
        <h1>
            <img src="<?php echo $friend->getProfile_image() ?>" id="profile_image" alt="">
            <?php echo $friend->getFirst_name() . " " . $friend->getLast_name();?> Photo
        </h1>
    </div>
    <div class="row mt-3">
        <div class="col">
            <img src=" <?php echo "images\\" . $photo->getPhoto_url() ?>" id="regular_photos" alt="">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <h3>Name/Secies: <?php echo $photo->getPhoto_name() ?> </h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <h3>Category: <?php $myCategory = PhotoCategoryController::getCategoryById($photo->getId_photo_category()); 
            echo $myCategory->getCategoryName(); ?></h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <h3>Date: <?php echo date("m-d-Y",strtotime($photo->getUpload_date())); ?></h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <h3>Location: <?php echo $photo->getLocation() ?></h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <h3>Description: </h3>
            <p><?php echo $photo->getDescription() ?></p>
        </div>
    </div>

</div>




</html>