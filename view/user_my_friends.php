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

<div class="container pt-5">
    <div class="row text-center pt-5">
        <h1 class="mt-4">Your Friends</h1>
    </div>
    <?php foreach (UsersController::getAllUsers($_SESSION['user_id']) as $user) : 
        $friendsStatus = FriendsController::getFiendStatus($_SESSION['user_id'],$user->getId_user());
        if ($friendsStatus == true) {
    ?>
    <div class="row mt-3">
        <div class="col-md-4 d-flex align-items-center justify-content-center">
            <h3>
                <?php echo $user->getFirst_name()?>
                <?php echo $user->getLast_name()?>
            </h3>
        </div>
        <div class="col-md-4 d-flex align-items-center justify-content-center">
            <img src="<?php echo 'images/' . $user->getProfile_image()?>" id="profile_image" alt=""></td>
        </div>
        <div class="col-md-4 d-flex align-items-center justify-content-center">
            <form method="post">
                    <input type="hidden" name="friend_id" value="<?php echo $user->getId_user(); ?>">
                    <input id="logout" type="submit" name="unfollow" value="Unfollow">
                </form>
        </div>
    </div>
    <?php } endforeach ?>

</div>
        <script src="" async defer></script>
    </body>
</html>