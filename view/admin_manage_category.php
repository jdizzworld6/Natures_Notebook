<?php
session_start();
require_once '../utilities/security.php';
require_once '../controller/users.php';
require_once '../controller/users_controller.php';
require_once '../controller/photo_category.php';
require_once '../controller/photo_category_controller.php';

// Checking security
Security::checkAuthority('admin_level');
// user logout
if (isset($_POST['logout'])){
    Security::logout();
}
// deletes user
if (isset($_POST['delete'])) {
    if (isset($_POST['categoryDeleteNo'])){
        PhotoCategoryController::deletePhotoCategory($_POST['categoryDeleteNo']);
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
    <body>

<table class="table">
  <thead>
    <tr>
        <!-- 15 -->
      <th scope="col">Category ID</th>
      <th scope="col">Category Name</th>
      <th scope="col">Category Description</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>

    <?php foreach (PhotoCategoryController::getAllPhotoCategory() as $photo_category) : ?>
    <tr>
        <td><?php echo $photo_category->getIdPhotoCategory()?></td>
        <td><?php echo $photo_category->getCategoryName()?></td>
        <td><?php echo $photo_category->getCategoryDescription()?></td>

        <td><form method="post">
                <input type="hidden" name="categoryUpdateNo" value="<?php echo $photo_category->getIdPhotoCategory(); ?>">
                <input type="submit" name="update" value="Update">
            </form></td>
        <td><form method="post">
                <input type="hidden" name="categoryDeleteNo" value="<?php echo $photo_category->getIdPhotoCategory(); ?>">
                <input type="submit" name="delete" value="Delete">
            </form></td>
        
    </tr>
    <?php endforeach ?>
</table>
        
        <script src="" async defer></script>
    </body>
</html>