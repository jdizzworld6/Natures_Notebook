<?php
session_start();
    require_once '../utilities/security.php';
    require_once '../controller/users.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/photo_category.php';
    require_once '../controller/photo_category_controller.php';
    require_once '../controller/inputBoxErrorHandlerPhotoCategory.php';

// Checking security
    Security::checkAuthority('admin_level');
// user logout
if (isset($_POST['logout'])){
    Security::logout();
}
// creating new user
$photo_category = new PhotoCategory("","");
// setting userNo
$photo_category->setIdPhotoCategory(-1);
// Test to add or update user
    $pageTitle = 'Add a New Photo Category';
// Gets user info
if (isset($_GET['pNo'])) {
    $photo_category = PhotoCategoryController::getCategoryById($_GET['pNo']);
    $pageTitle = 'Update an Existing User';
}
// Saves user details
if (isset($_POST['save'])){

    $photo_category = new PhotoCategory($_POST['category_name'], $_POST['category_description']);

    $photo_category->setIdPhotoCategory($_POST['id_photo_category']);


// Decides to add or update user
    if ($passAllInputBoxTest == true) {

        if ($photo_category->getIdPhotoCategory()==-1){
            PhotoCategoryController::addPhotoCategory($photo_category);
        } else {
            PhotoCategoryController::updatePhotoCategory($photo_category);
    }
// redirects page after post
        header('Location: ./admin_manage_category.php');
    }
}
// redirects page doesn't update
    if (isset($_POST['cancel'])){
            header('Location: ./admin_manage_category.php');
    }
?>

<html>
    
    <?php require_once("admin_nav_bar.php"); ?>

    <h2><?php echo $pageTitle ?></h2>
    <form method="post">
    <input type="hidden" name="id_photo_category" value="<?php echo $photo_category->getIdPhotoCategory(); ?>">
    
    <h2>Photo Category Name: <input type="text" name="category_name" value="<?php echo $photo_category->getCategoryName(); ?>">
        <?php echo (isset($_POST['save']) ? $categoryDescriptionTestReturn : '') ?>
    </h2>
    <h2>Photo Category Description: <input type="text" name="category_description" value="<?php echo $photo_category->getCategoryDescription(); ?>">
        <?php echo (isset($_POST['save']) ? $categoryDescriptionTestReturn : '') ?>
    </h2>

        <input type="submit" name="save" value="Save">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</html>