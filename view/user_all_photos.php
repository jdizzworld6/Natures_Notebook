<?php

    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    require_once '../controller/photo_category.php';
    require_once '../controller/photo_category_controller.php';
    require_once '../controller/photo.php';
    require_once '../controller/photo_controller.php';
    
    Security::checkHTTPS();
    Security::checkAuthority('user_level');
    $userphoto = "";

    $photos = new Photo("","","","","","","");
// gets user by id
    if (isset($_SESSION['user_id'])) {
        $user = UsersController::getUserById($_SESSION['user_id']);
        $userphoto = $user->getProfile_image();
    }
// Gets all photos
    if (isset($_SESSION['user_id'])) {
        $photos = PhotoController::getAllPhotosByUser($_SESSION['user_id']);
    }

    // deletes user
if (isset($_POST['delete'])) {
    if (isset($_POST['photoDeleteNo'])){
        $delete_image_url = 'C:\xampp\htdocs\Natures_Notebook-1\view\images\\' . $_POST['photo_url'];
        if (file_exists($delete_image_url)){
            unlink($delete_image_url);
            PhotoController::deletePhoto($_POST['photoDeleteNo']);
            header('Location: ' . $_SERVER['PHP_SELF'] . "?pNo=" . $_SESSION['user_id']);
            exit();
        } else {
            $delete_error = "<h4 style='color: red;'>Delete Error Your Photo Did Not Delete</h4>";
        }
    }
}

if(isset($_POST['addPhoto'])){
    header("Location: user_add_photo.php");
}
?>

<html>
    <?php require_once("user_nav_bar.php"); ?>
<div class="container text-start mt-5">
    <div class="row text-end mt-5">
        <form class="mt-3" method="post">
            <input id="logout" class="mt-4" type="submit" name="addPhoto" value="Add Photo" >
        </form>
    </div>
    <div class="row text-center">
        <h1>
            <img src=<?php echo 'images/' . $userphoto ?> id="profile_image" alt="User Photo">
            Your Photos</h1>
    </div>
</div>
    
<div class="container text-start">
  <div class="row">
    <?php foreach ($photos as $photo) : ?>
    <div class="col">
        <form method="post">
            <div class="row">
                <input type="hidden" name="photo_url" value="<?php echo $photo->getPhoto_url()?>">
                <a href="<?php echo "user_view_one_photo.php?ID_photo=" . 
                    $photo->getId_photo() ?>">
                    <img src=<?php echo "images\\" . $photo->getPhoto_url()?> id="regular_photos">
                </a>
            </div>
            <div class="row-4">
                <div class="col">
                    <h3>Name: <?php echo $photo->getPhoto_name() ?></h3>
                </div>
            </div>
            <div class="row-4">
                <div class="col">
                    <h3>Category: <?php $myCategory = PhotoCategoryController::getCategoryById($photo->getId_photo_category());
                    echo $myCategory->getCategoryName();
                    ?></h3>
                </div>
            </div>
            <div class="row-4">
                <div class="col">
                    <h3>Date: <?php echo $photo->getUpload_date() ?></h3>
                </div>
            </div>
            <div class="row-4">
                <div class="col">
                    <?php echo(isset($_POST['delete']) ? $delete_error : '')  ?>
                    <input type="hidden" name="photoDeleteNo" value="<?php echo $photo->getId_photo() ?>">
                    <input id="delete" type="submit" name="delete"  value = "Delete">
                </div>
            </div>
        </div>
        </form>
    <?php endforeach ?>
    </div>
  </div>

</html>