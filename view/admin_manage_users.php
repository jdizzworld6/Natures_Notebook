<?php

    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    
    Security::checkHTTPS();
    Security::checkAuthority('admin_level');

    // deletes user

    if (isset($_POST['userDeleteNo'])){
        UsersController::deleteUser($_POST['userDeleteNo']);
    }
    
    // updates user

    if (isset($_POST['userUpdateNo'])){
        header('Location: ./admin_user_add_update_user.php?pNo=' . $_POST['userUpdateNo']);
    }
// See user photos

    if (isset($_POST['userPhotos'])){
        header('Location: ./admin_user_photos.php?pNo=' . $_POST['userPhotos']);
    }


    if (isset($_POST['add_photos'])){
        header('Location: ./admin_add_photo.php?pNo=' . $_POST['userPhotos']);
    }

?>

<html>

    <?php require_once("admin_nav_bar.php"); ?>

    <body>
<table class="table">
  <thead>
    <tr>
        <!-- 15 -->
      <th scope="col">User ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Profile Image</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Address</th>
      <th scope="col">City</th>
      <th scope="col">State</th>
      <th scope="col">Zip Code</th>
      <th scope="col">Email Address</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">User Level</th>
      <th scope="col">Count Created</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>

    <?php foreach (UsersController::getAllUsers() as $user) : ?>
    <tr>
        <td><?php echo $user->getId_user()?></td>
        <td><?php echo $user->getFirst_name()?></td>
        <td><?php echo $user->getLast_name()?></td>
        <td><?php 
        if ($user->getProfile_image() == ""){
            echo "false";
        } else {
            echo "true";
        }
        ?></td>
        <td><?php echo $user->getDate_of_birth()?></td>
        <td><?php echo $user->getPhone_number()?></td>
        <td><?php echo $user->getAddress()?></td>
        <td><?php echo $user->getCity()?></td>
        <td><?php echo $user->getState()?></td>
        <td><?php echo $user->getZip()?></td>
        <td><?php echo $user->getEmail()?></td>
        <td><?php echo $user->getUsername()?></td>
        <td><?php echo $user->getPassword()?></td>
        <?php if ($user->getUserLevel() == 1) :?>
                    <td>Administrator</td>
                <?php else : ?>
                    <td>Customer</td>
                <?php endif ?>
        <td><?php echo $user->getCountCreated()?></td>
        <td><form method="post">
                <input type="hidden" name="userUpdateNo" value="<?php echo $user->getId_user(); ?>">
                <input type="submit" name="update" value="Update">
            </form></td>
        <td><form method="post">
                <input type="hidden" name="userDeleteNo" value="<?php echo $user->getId_user(); ?>">
                <input type="submit" name="delete" value="Delete">
            </form></td>
        <td><form method="post">
                <input type="hidden" name="userPhotos" value="<?php echo $user->getId_user(); ?>">
                <input type="submit" name="photos" value="Photos">
            </form></td>
        <td><form method="post">
                <input type="hidden" name="userPhotos" value="<?php echo $user->getId_user(); ?>">
                <input type="submit" name="add_photos" value="Add Photo">
            </form></td>
        
    </tr>
    <?php endforeach ?>
</table>
        
        <script src="" async defer></script>
    </body>
</html>