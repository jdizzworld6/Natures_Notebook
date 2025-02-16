<?php
session_start();
require_once '../utilities/security.php';
require_once '../controller/users.php';
require_once '../controller/users_controller.php';
require_once '../controller/photo_category.php';
require_once '../controller/photo_category_controller.php';
require_once '../controller/photo.php';
require_once '../controller/photo_controller.php';
require_once '../controller/inputBoxErrorHandlerPhotoCategory.php';


// Checking security
Security::checkAuthority('admin_level');
// user logout
if (isset($_POST['logout'])){
    Security::logout();
}
// gets one user by id
if (isset($_GET['IDUser'])) {
    $user = UsersController::getUserById($_GET['IDUser']);
}

// gets one user photo to be updated
if (isset($_GET['ID_photo'])) {
    $photo = PhotoController::getPhotoById($_GET['ID_photo']);
    $photo_categories = PhotoCategoryController::getAllPhotoCategory();
}

// reformate upload date and have calander

if (isset($_POST['update_photo'])){
    $id_category = (int)$_POST['photo_category'];
    $photo_url = $photo->getPhoto_url();
    $photo = new Photo((int)$_GET['IDUser'], $id_category, $_POST['photo_name'], $_POST['description'], $photo_url, $_POST['upload_date'], $_POST['location'], (int)$_GET['ID_photo']);

    PhotoController::updatePhoto($photo);

    header('Location: ./admin_manage_users.php');
    
}
// Allows user to cancel
if (isset($_POST['cancel'])){
    header('Location: ./admin_manage_users.php');
}

?>

<html>
    <?php require_once("admin_nav_bar.php"); ?>

    <form method="post">
        <img src=" <?php echo "images\\" . $photo->getPhoto_url() ?>" alt="">
        <br>
        <label for="photo_name">Name:/Species</label>
        <br>
        <input type="text" value="<?php echo $photo->getPhoto_name() ?>" name="photo_name">
        <br>
        <label for="photo_category">Category</label>
        <br>
        <select name="photo_category">

            <?php foreach($photo_categories as $category) :
                if ($photo->getId_photo_category()==$category->getIdPhotoCategory()){ ?>
                    <?php $selectedOption = '<option value ="' . $category->getIdPhotoCategory() . '"selected>' . $category->getCategoryName() . '</option>' ;
                    echo $selectedOption;
                    ?>
                <?php } else { ?>
                    <option value="<?php echo $category->getIdPhotoCategory() ?>"><?php echo $category->getCategoryName()?></option>
                <?php }  ?>
            <?php endforeach ?>
        </select>
        <br>
        <label for="date_uploaded">Date Found:</label>
        <br>
        
        <input name="upload_date" value="<?php echo date("Y-m-d",strtotime($photo->getUpload_date())); ?>" type="date">
        <br>
        <label for="location">Location:</label>
        <br>
        <input name="location" value="<?php echo $photo->getLocation() ?>" type="text">
        <br>
        <label for="description">Description:</label>
        <br>
        <textarea name="description" rows="10" cols="75" id="">
        <?php echo $photo->getDescription() ?>
        </textarea>
        <br>
        <input type="submit" name="update_photo" value="Update">
        <input type="submit" name="cancel" value="Cancel">
    
    </form>




</html>