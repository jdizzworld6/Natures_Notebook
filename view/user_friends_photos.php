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

        $profile_image = $user->getProfile_image();

        if (isset($profile_image)){
            $profile_image = 'images/' . $profile_image;
        } else {
            $profile_image = '';
        }
        
        $friends = FriendsController::getAllFriends($_SESSION['user_id']);

        foreach ($friends as $friend) {
            $friend_photos = PhotoController::getAllPhotosByUser($friend->getIdYourFriends());

            foreach ($friend_photos as $photo) {
                // create an object that holds the friend and photo information
                // and add it to the friends_info array
                $photo_categories = PhotoCategoryController::getCategoryById($photo->getId_photo_category());
                
                $friends_info[] = array(
                    'id_user' => $friend->getIdYourFriends(),
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

    <div class="container text-start mt-5">

        <div class="row text-center pt-5">
            <h2>
                <img src=<?php echo $profile_image; ?> alt="User Photo" id="profile_image">
                Welcome <?php echo $user->getFirst_name() . " " . $user->getLast_name(); ?>
            </h2>
        </div>
        <div class="row text-center">
            <h1 class="my-3">Your Friends' Photos</h1>
        </div>
    </div>


    <div class="container text-start">
<div class="row">
    <?php foreach ($friends_info as $my_friend) : ?>
    <div class="col">
        <form method="post">
        <div class="row mt-4">
            <img src="<?php echo 'images/' . $my_friend['profile_image'] ?>" id="profile_image">
            <div class="col mt-4">
                <h3>Name: <?php echo $my_friend['first_name']?> <?php echo $my_friend['last_name']?></h3>
            </div>
            <input type="hidden" name="photo_url" value="<?php echo $my_friend['id_user']?>">
        </div>
        <div class="row-4 mt-4">
            <a href="<?php echo "user_view_one_friends_photo.php?ID_photo=" .
                $my_friend['id_photo'] . "&ID_friend=" . $my_friend['id_user'] ?>">
                <img src=<?php echo "images\\" . $my_friend['photo_url']?> id="regular_photos">
            </a>
        </div>
        <div class="row-4">
            <div class="col">
                <h3>Photo Name: <?php echo $my_friend['photo_name'] ?></h3>
            </div>
        </div>
        <div class="row-4">
            <div class="col">
                <h3>Category: <?php echo $my_friend['photo_category']?></h3>
            </div>
        </div>
        <div class="row-4">
            <div class="col">
                <h3>Date: <?php 
                $dateTimeString = $my_friend['upload_date']; // Your input date and time string

                // Create a DateTime object from the input string:
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTimeString);
                
                if ($dateTime === false) {
                    $dateTime = DateTime::createFromFormat('Y/m/d H:i:s', $dateTimeString);
                    $formattedDate = $dateTime->format('m/d/Y');
                    echo $formattedDate; // Output
                } else {
                    // Format the date to MM/DD/YYYY:
                    $formattedDate = $dateTime->format('m/d/Y');
                    echo $formattedDate; // Output
                }

  
                ?></h3>
            </div>
        </div>
    </div>
    </form>
    <?php endforeach ?>
    </div>
</div>





</html>