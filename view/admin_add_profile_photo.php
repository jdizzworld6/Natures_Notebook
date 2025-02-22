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
    Security::checkAuthority('admin_level');
    
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

            $newImageName = $_GET['pNo'] . "_" . $randomNumber . "_" . $fileName;
            $target = $dir . $newImageName;
            move_uploaded_file($_FILES['myFile']['tmp_name'], $target);

            ImageUtilities::ProcessImage($target);

            $didrename = rename($dir . $fileName, $dir . $newImageName);
    // add image file to user


            UsersController::updateUserProfileImage($_GET['pNo'], $newImageName);
    
            $imgName='';
        
            header('Location: ./admin_user_add_update_user.php?pNo=' . $_GET['pNo']);

    } else {
        $FileError = "<h4 style='color: red'> Need to select a file. </h4>";
    }
}

if (isset($_POST['cancel'])){
    header('Location: ./admin_user_add_update_user.php?pNo=' . $_GET['pNo']);
}

?>
<html>
<script src="view\temp_view_photo.js"></script>
<?php require_once("admin_nav_bar.php"); ?>
<h1>Add Profile Image</h1>
    <br>

    <form method="post" enctype="multipart/form-data">
    <input type="file" name="myFile" id="file-upload" accept="image/*" onchange="previewImage(event);">
        <br>
        <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 300px; max-height: 300px;">
        <?php echo (isset($_POST['save']) ? $FileError: '') ?>
        <br>
        <input type="submit" name="save" value="Upload">
        <input type="submit" name="cancel" value="Cancel">
    </form>




</html>