<?php
    session_start();
    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    require_once '../controller/photo.php';
    require_once '../controller/photo_controller.php';
    
    Security::checkHTTPS();
    Security::checkAuthority('admin_level');

    $photos = new Photo("","","","","","","");
// gets user by id
    if (isset($_GET['pNo'])) {
        $user = UsersController::getUserById($_GET['pNo']);
        $userphoto = $user->getProfile_image();
    }
// Gets all photos
    if (isset($_GET['pNo'])) {
        $photos = PhotoController::getAllPhotosByUser($_GET['pNo']);
    }

    // deletes user
if (isset($_POST['delete'])) {
    if (isset($_POST['photoDeleteNo'])){
        PhotoController::deletePhoto($_POST['photoDeleteNo']);
        $testurl = 'Location: ' . $_SERVER['PHP_SELF'] . "?pNo=" . $_GET['pNo'];
        header('Location: ' . $_SERVER['PHP_SELF'] . "?pNo=" . $_GET['pNo']);
        exit();
    }
}
// updates user
if (isset($_POST['update'])){
    if (isset($_POST['categoryUpdateNo'])){
        header('Location: ./admin_manage_category_add_update.php?pNo=' . $_POST['categoryUpdateNo']);
    }
}
?>

<html>
    <?php require_once("admin_nav_bar.php"); ?>
    <img src=<?php echo $userphoto ?> alt="User Photo">
    <?php  ?>
    <div class="container text-center">
  <div class="row row-cols-4">
    <?php foreach ($photos as $photo) : ?>
        <div class="col">
            <form method="post">
                <a href="<?php echo "admin_update_single_photo.php?q=SinglePhoto&ID_photo=" . 
                    $photo->getId_photo() . "&IDUser=" . $user->getId_user()?>">
                    
                    <img src=<?php echo "images\\" . $photo->getPhoto_url()?>>
                </a>
                <input type="hidden" name="photoDeleteNo" value="<?php echo $photo->getId_photo() ?>">
                <input type="submit" name="delete"  value = "Delete">
            </form>
        </div>
    <?php endforeach ?>

  </div>
</div>


</html>