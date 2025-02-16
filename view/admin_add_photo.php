<?php
    session_start();
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

    // uploads a new image to all image size folders and image dir

if (isset($_POST['fileUpload'])){
    $fileName = $_FILES['myFile']['name'];
    $randomNumber = rand(1, 999999999);
// imports and renames image file to prevent duplication
    if ($fileName !== null){
        // -------------start here with pass checker ----------
        if ($passAllInputBoxTest) {
        $target = $dir . $fileName;
        $newImageName = $_GET['pNo'] . "_" . $randomNumber . "_" . $fileName;

        move_uploaded_file($_FILES['myFile']['tmp_name'], $target);

        $didrename = rename($dir . $fileName, $dir . $newImageName);
    // add image file to user
        $photo = new Photo((int)$_GET['pNo'], (int)$_POST['photo_category'],$_POST['name'],$_POST['description'], $newImageName, $_POST['date_found'], $_POST['location']);
    
        PhotoController::addPhoto($photo);
    
        $imgName='';
        }
    }
}

?>
<html>
<?php require_once("admin_nav_bar.php"); ?>
<h1>Add New Entry</h1>
    <h2>Photo:</h2>
    <br>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="myFile" id="myFile" >
        <br>
        <label for="name">Name/Species:</label>
        <br>
        <input type="text" name="name">
        <br>
        <label for="category">Category</label>
        <br>
        <select name="photo_category">
            <?php foreach(PhotoCategoryController::getAllPhotoCategory() as $category) : ?>
                <option value="<?php echo $category->getIdPhotoCategory() ?>"><?php echo $category->getCategoryName() ?></option>
            <?php endforeach ?>
        </select>
        <br>
        <label for="date_found">Date Found:</label>
        <br>
        <input type="date" name="date_found">
        <br>
        <label for="location">Location:</label>
        <br>
        <input type="text" name="location">
        <br>
        <label for="description">Description:</label>
        <br>
        <textarea name="description" cols="75" rows="10"></textarea>
        <input type="submit" name="fileUpload" value="Upload">
    </form>


</html>