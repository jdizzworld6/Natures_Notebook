<?php

    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    require_once '../controller/photo_category.php';
    require_once '../controller/photo_category_controller.php';
    require_once '../controller/photo.php';
    require_once '../controller/photo_controller.php';
    require_once '../controller/image_utilities.php';
    require_once '../controller/inputBoxErrorHandlerPhotoAdd.php';

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
        if ($passAllInputBoxTest) {
            $newImageName = $_SESSION['user_id'] . "_" . $randomNumber . "_" . $fileName;
            $target = $dir . $newImageName;
            move_uploaded_file($_FILES['myFile']['tmp_name'], $target);

            ImageUtilities::ProcessImage($target);

            $didrename = rename($dir . $fileName, $dir . $newImageName);
    // add image file to user
            $photo = new Photo((int)$_SESSION['user_id'], (int)$_POST['photo_category'],$_POST['name'],$_POST['description'], $newImageName, $_POST['date_found'], $_POST['location']);
    
            PhotoController::addPhoto($photo);
    
            $imgName='';
        
            header('Location: ./user_all_photos.php');

        }

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
<h1>Add New Photo</h1>
    <br>

    <form method="post" enctype="multipart/form-data">
    <input type="file" name="myFile" id="file-upload" accept="image/*" onchange="previewImage(event);">
        <br>
        <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 300px; max-height: 300px;">
        <?php echo (isset($_POST['save']) ? $FileError: '') ?>
        <br>
        <label for="name">Name/Species:</label>
        <br>
        <input type="text" name="name">
            <?php echo (isset($_POST['save']) ? $photoNameTestReturn: '') ?>
        <br>
        <label for="category">Category</label>
        <br>
        <select name="photo_category">
            <?php foreach(PhotoCategoryController::getAllPhotoCategory() as $category) : ?>
                <option value="<?php echo $category->getIdPhotoCategory() ?>"><?php echo $category->getCategoryName() ?></option>
            <?php endforeach ?>
        </select>
        <?php echo (isset($_POST['save']) ? $categorySelectReturn: '') ?>
        <br>
        <label for="date_found">Date Found:</label>
        <br>
        <input type="date" name="date_found" value="<?php echo date('Y-m-d'); ?>">
        <br>
        <label for="location">Location:</label>
        <br>
        <input type="text" name="location">
        <br>
        <label for="description">Description:</label>
        <br>
        <textarea name="description" cols="75" rows="10"></textarea>
        <br>
        <input type="submit" name="save" value="Upload">
        <input type="submit" name="cancel" value="Cancel">
    </form>




</html>