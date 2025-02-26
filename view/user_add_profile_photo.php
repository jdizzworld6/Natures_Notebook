<?php

    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    require_once '../controller/photo_category.php';
    require_once '../controller/photo_category_controller.php';
    require_once '../controller/photo.php';
    require_once '../controller/photo_controller.php';
    require_once '../controller/image_utilities.php';


    Security::checkHTTPS();
    Security::checkAuthority('user_level');
    
    $dir = "C:\\xampp\htdocs\Natures_Notebook-1/view/images/";
    $displayImage = "style='display: none;'";
    $FileError = '';

    // uploads a new image to all image size folders and image dir

if (isset($_POST['save'])){
    $fileName = $_FILES['myFile']['name'];
    $randomNumber = rand(1, 999999999);
    
// imports and renames image file to prevent duplication
    if ($fileName !== ""){
        // -------------start here with pass checker ----------

            $newImageName = $_SESSION['user_id'] . "_" . $randomNumber . "_" . $fileName;
            $target = $dir . $newImageName;
            move_uploaded_file($_FILES['myFile']['tmp_name'], $target);

            ImageUtilities::ProcessImage($target);

            $didrename = rename($dir . $fileName, $dir . $newImageName);
    // add image file to user

            UsersController::updateUserProfileImage($_SESSION['user_id'], $newImageName);
    
            $imgName='';
        
            header('Location: ./user_manage_account.php');

    } else {
        $FileError = "<h4 style='color: red'> Need to select a file. </h4>";
    }
}

if (isset($_POST['cancel'])){
    header('Location: ./user_all_photos.php');
}

?>
<html>
<script src="view\temp_view_photo.js"></script>
<?php require_once("user_nav_bar.php"); ?>
<div class="container text-center mt-5">
    <div class="row pt-5">
        <div class="col">
            <h1>Add Profile Image</h1>
        </div>
    </div>
    <div class="row mt-3">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="myFile" id="logout" accept="image/*" onchange="previewImage(event);">
            <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 300px; max-height: 300px;">
    </div>
            <?php echo (isset($_POST['save']) ? $FileError: '') ?>
            <br>
            <input id="save" type="submit" name="save" value="Upload">
            <input id="cancel" type="submit" name="cancel" value="Cancel">
        </form>
</div>
</html>