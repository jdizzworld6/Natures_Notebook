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

            $user = UsersController::getUserById($_SESSION['user_id']);

            $userUpdate = new User( $user->getFirst_name(), $user->getLast_name(), $newImageName, $user->getDate_of_birth(), $user->getPhone_number(), $user->getAddress(), $user->getCity(), $user->getState(), $user->getZip(), $user->getEmail(), $user->getUsername(), $user->getPassword(), $newImageName, $user->getCountCreated(), $user->getId_user(),);

            UsersController::updateUser($userUpdate);
    
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
<?php require_once("user_nav_bar.php"); ?>
<h1>Add Profile Image</h1>
    <br>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="myFile" id="myFile" >
        <?php echo (isset($_POST['save']) ? $FileError: '') ?>
        <br>
        <input type="submit" name="save" value="Upload">
        <input type="submit" name="cancel" value="Cancel">
    </form>




</html>