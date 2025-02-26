<?php

    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    require_once '../controller/photo_category.php';
    require_once '../controller/photo_category_controller.php';
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
        $photo_categories = PhotoCategoryController::getAllPhotoCategory();
    }

    // deletes user
if (isset($_POST['delete'])) {
    if (isset($_POST['photoDeleteNo'])){
        $delete_image_url = 'C:\xampp\htdocs\Natures_Notebook-1\view\images\\' . $_POST['photo_url'];
        if (file_exists($delete_image_url)){
            unlink($delete_image_url);
            PhotoController::deletePhoto($_POST['photoDeleteNo']);
            header('Location: ' . $_SERVER['PHP_SELF'] . "?pNo=" . $_GET['pNo']);
            exit();
        } else {
            $delete_error = "<h4 style='color: red;'>Delete Error Your Photo Did Not Delete</h4>";
        }
    }
}
// updates user
if (isset($_POST['update'])){
    if (isset($_POST['categoryUpdateNo'])){
        header('Location: ./admin_manage_category_add_update.php?pNo=' . $_POST['categoryUpdateNo']);
    }
}

if(isset($_POST['addPhoto'])){
    header("Location: admin_add_photo.php?pNo=" . $_GET['pNo']);
}
?>

<html>
    <?php require_once("admin_nav_bar.php"); ?>
    <form method="post">
        <input type="submit" name="addPhoto" value="Add Photo" >
    </form>

    <img src=<?php echo $userphoto ?> alt="User Photo">
    <?php  ?>
    <div class="container text-center">
  <div class="row row-cols-4">
    <?php foreach ($photos as $photo) : ?>
        <div class="col">
            <form method="post">
                <input type="hidden" name="photo_url" value="<?php echo $photo->getPhoto_url()?>">
                <a href="<?php echo "admin_update_single_photo.php?q=SinglePhoto&ID_photo=" . 
                    $photo->getId_photo() . "&IDUser=" . $user->getId_user()?>">
                    
                    <img src=<?php echo "images\\" . $photo->getPhoto_url()?>>
                </a>
                <br>
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $photo->getPhoto_name() ?>">
                <br>
                <label for="category">category</label>
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
                <label for="txtdate">Date</label>
                <input type="text" name="txtdate" value="<?php echo $photo->getUpload_date() ?>">
                <br>
                <?php echo(isset($_POST['delete']) ? $delete_error : '')  ?>
                <input type="hidden" name="photoDeleteNo" value="<?php echo $photo->getId_photo() ?>">
                <input type="submit" name="delete"  value = "Delete">
            </form>
        </div>
    <?php endforeach ?>
  </div>
</div>

</html>