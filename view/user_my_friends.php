<?php

    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    require_once '../controller/friends.php';
    require_once '../controller/friends_controller.php';
    
    Security::checkHTTPS();
    Security::checkAuthority('user_level');

    // deletes user

    if (isset($_POST['add_friend'])) {
        FriendsController::addFriend($_SESSION['user_id'], $_POST['friend_id']);
    }
    
    // updates user

    if (isset($_POST['unfollow'])) {
        FriendsController::deleteFriend($_SESSION['user_id'], $_POST['friend_id']);
    }
// See user photos

?>

<html>

    <?php require_once("user_nav_bar.php"); ?>

    <body>
<table class="table">

    <?php foreach (UsersController::getAllUsers($_SESSION['user_id']) as $user) : 

        $friendsStatus = FriendsController::getFiendStatus($_SESSION['user_id'],$user->getId_user());

        if ($friendsStatus == true) {
    ?>

    
    
    <tr>
        <td><?php echo $user->getFirst_name()?></td>
        <td><?php echo $user->getLast_name()?></td>
        <td>
            <img src="<?php echo 'images/' . $user->getProfile_image()?>" alt=""></td>
    
        <td <?php if ($friendsStatus == true) { echo 'style="display: none;"'; } ?> ><form method="post">
                <input type="hidden" name="friend_id" value="<?php echo $user->getId_user(); ?>">
                <input type="submit" name="add_friend" value="Add Friend">
            </form></td>
        <td <?php if ($friendsStatus == false) { echo 'style="display: none;"'; } ?> ><form method="post">
                <input type="hidden" name="friend_id" value="<?php echo $user->getId_user(); ?>">
                <input type="submit" name="unfollow" value="Unfollow">
            </form></td>
        <td><?php if ($friendsStatus == true){
            echo "Friends";
        } else {
            echo "Not Friends";
        } ?></td>
        
    </tr>
    <?php } endforeach ?>
</table>
        
        <script src="" async defer></script>
    </body>
</html>