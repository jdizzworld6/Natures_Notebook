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
}

// reformate upload date and have calander

if (isset($_POST['update_photo'])){
    $id_category = $_POST['photo_category'];
    $photo_url = $photo->getPhoto_url();
    $photo = new Photo($_SESSION['user_id'], $id_category, $_POST['photo_name'], $_POST['description'], $photo_url, $_POST['upload_date'], $_POST['location'], $_GET['ID_photo']);

    PhotoController::updatePhoto($photo);
    header('Location: ./user_all_photos.php');
    
}
// Allows user to cancel
if (isset($_POST['cancel'])){
    header('Location: ./user_all_photos.php');
}

if (isset($_POST['delete'])) {
    $delete_image_url = 'C:\xampp\htdocs\Natures_Notebook-1\view\images\\' . $photo->getPhoto_url();
    if (file_exists($delete_image_url)){
        unlink($delete_image_url);
        PhotoController::deletePhoto($photo->getId_photo());
        header('Location: ./user_all_photos.php');
        exit();
    } else {
        $delete_error = "<h4 style='color: red;'>Delete Error Your Photo Did Not Delete</h4>";
    }
}

?>

<html>
    <?php require_once("user_nav_bar.php"); ?>
<body>

<div class="container text-center mt-5">
    <div class="row pt-5">
        <h1>Edit Photo</h1>
    </div>
    <form method="post">
        <div class="row">
            <div class="col">
                <img src=" <?php echo "images\\" . $photo->getPhoto_url() ?>" id="regular_photos" alt="">
            </div>
        </div>
        <div class="row mt-3">
            <h3>
                <label for="photo_name">Name:/Species</label>
                <input type="text" value="<?php echo $photo->getPhoto_name() ?>" name="photo_name">
            </h3>
        </div>
        <div class="row mt-3">
            <h3>
                <label for="photo_category">Category</label>
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
            </h3>
        </div>
        <div class="row mt-3">
            <h3>
                <label for="date_uploaded">Date Found:</label>
                <input name="upload_date" value="<?php echo date("Y-m-d",strtotime($photo->getUpload_date())); ?>" type="date">
            </h3>
        </div>
        <div class="row mt-3">
            <h3>
                <label for="location">Location:</label>
                <input name="location" value="<?php echo $photo->getLocation() ?>" type="text">
            </h3>
        </div>
        <div class="row mt-3">
            <div class="col">
                
                <h3><label for="description">Description:</label></h3>
                <textarea style="text-align: left;" name="description" rows="10" cols="75" id="">
                <?php          
                    $myDescription = trim($photo->getDescription());
                    echo $myDescription;
                ?>
                </textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-8">
                <input id="save" type="submit" name="update_photo" value="Update">
                <input id="cancel" type="submit" name="cancel" value="Cancel">
            </div>
            <div class="col-4">
                <input id="delete"  type="submit" name="delete" value="Delete">
            </div>
        </div>
    
    </form>
</div>
</body>


</html>