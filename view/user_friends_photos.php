<?php
    require_once '../utilities/security.php';
    require_once '../controller/friends.php';
    require_once '../controller/friends_controller.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    require_once '../controller/photo_category.php';
    require_once '../controller/photo_category_controller.php';
    require_once '../controller/photo.php';
    require_once '../controller/photo_controller.php';
    
    Security::checkHTTPS();
    Security::checkAuthority('user_level');

    $photos = new Photo("","","","","","","");
    $userphoto = "";
// gets user by id
    if (isset($_SESSION['user_id'])) {
        $user = UsersController::getUserById($_SESSION['user_id']);
        $userphoto = $user->getProfile_image();
    }
// Gets all photos
    if (isset($_SESSION['user_id'])) {
        $friends_info = [];
        
        $friends = FriendsController::getAllFriends($_SESSION['user_id']);

        foreach ($friends as $friend) {
            $friend_photos = PhotoController::getAllPhotosByUser($friend->getIdYourFriends());

            foreach ($friend_photos as $photo) {
                // create an object that holds the friend and photo information
                // and add it to the friends_info array
                $photo_categories = PhotoCategoryController::getCategoryById($photo->getId_photo_category());
                
                $friends_info[] = array(
                    'id_user' => $friend->getIdFriends(),
                    'first_name' => $friend->getFirstName(),
                    'last_name' => $friend->getLastName(),
                    'profile_image' => $friend->getProfileImage(),
                    'id_photo' => $photo->getId_photo(),
                    'photo_url' => $photo->getPhoto_url(),
                    'photo_name' => $photo->getPhoto_name(),
                    'upload_date' => $photo->getUpload_date(),
                    'photo_category' => $photo_categories->getCategoryName()
                );

            }
        }
        $photo_categories = PhotoCategoryController::getAllPhotoCategory();
    }
    // deletes user
?>

<html>
    <?php require_once("user_nav_bar.php"); ?>
    <h1>My Friend Photos</h1>
    <img src=<?php echo 'images/' . $user->getProfile_image() ?> alt="User Photo">
    <?php  ?>
    <div class="container text-center">
  <div class="row row-cols-4">
    <?php foreach ($friends_info as $my_friend) : ?>
        <div class="col">
            <form method="post">
            <img src="<?php echo 'images/' . $my_friend['profile_image'] ?>" alt="">
            <label for="name">Name:</label>
            <input type="text" name="photo_first_name" value="<?php echo $my_friend['first_name']?>">
            <input type="text" name="photo_last_name" value="<?php echo $my_friend['last_name']?>">
                <input type="hidden" name="photo_url" value="<?php echo $my_friend['id_user']?>">
            <a href="<?php echo "user_view_one_friends_photo.php?ID_photo=" .
                    $my_friend['id_photo'] ?>">
                    <img src=<?php echo "images\\" . $my_friend['photo_url']?>>
                </a>
                <br>
                <br>
                <label for="name">Photo Name:</label>
                <input type="text" name="name" value="<?php echo $my_friend['photo_name'] ?>">
                <br>
                <label for="category">category</label>
                <br>
                <input type="text" name="category" value="<?php echo $my_friend['photo_category']?>">
                <br>
                <label for="txtdate">Date</label>
                <input type="text" name="txtdate" value="<?php echo $my_friend['upload_date']?>">
            </form>
        </div>
    <?php endforeach ?>
  </div>
</div>

</html>