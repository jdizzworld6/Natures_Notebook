<?php

    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    
    Security::checkHTTPS();

    $login_message = isset($_SESSION['log_message']) ? $_SESSION['log_message'] : '';
// allws user to login check credentials
    if (isset($_POST['logID']) & isset($_POST['password'])){
      $user = UsersController::validUser($_POST['logID'], $_POST['password']);
    if ($user == false){
        $error_message = "<h4 style = 'color: red'>Username or Password Incorrect.</h4>";
      } else {
      $userLevel = $user->getUserLevel();
      $userNo = $user->getId_user();
      Security::setUserLevelSession($userLevel, $userNo);
      if ($_SESSION['log_message']){
        $error_message = "<h4 style = 'color: red'>".$_SESSION['log_message']."</h4>";
      }
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature's Notebook Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container text-center mt-5">
      <h1>Welcome to Nature's Notebook!</h1>
        <div class="row mt-3">
        <div class="col-md-2">
          <img src="imagesWebpage\venusFlytrap.png" alt="venusFlytrap" width="250" height="200" >
        </div>
        <div class="col-md-2">
          <img src="imagesWebpage\bluejay.png" alt="bluejay" width="250" height="200">
        </div>
        <div class="col-md-2">
          <img src="imagesWebpage\racoon.png" alt="racoon" width="250" height="200">
        </div>
        <div class="col-md-2">
          <img src="imagesWebpage\redmushroom.png" alt="redmushroom" width="250" height="200">
        </div>
        <div class="col-md-2">
          <img src="imagesWebpage\naturalbridge.png" alt="naturalbridge" width="250" height="200">
        </div>
        <div class="col-md-2">
          <img src="imagesWebpage\rhinobeetle.png" alt="rhinobeetle" width="250" height="200">
        </div>
      </div>
    <h2 class="mt-3">Already a member? Sign in here</h2>
    <h3>Still need to start your adventure? Click below to Create and Account:</h3>
    </div>
    <div class="container text-center mt-5">
      <h2>Already a member? Sign in here</h2>
      <form method="post">
          <div class="row-4">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
          </div>
          <div class="row-4">
            <input type="text" name="logID" >
          </div>
          <div class="row-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
          </div>
          <div class="row-4">
            <input type="password" id="exampleInputPassword1" name="password">
          </div>
            <?php echo (isset($_POST['save']) ? $error_message : '') ?>
          <div class="row-4 mt-3">
          <button name="save" type="submit" class="btn btn-secondary btn-lg">Sign In</button>
          </div>
        </form>
        <h6 class="mt-5">About Us</h6>
        <p> Nature's Notebook is a unique website where you can upload photos of your nature adventures! 
          Upload images, add descriptions and dates, and even share with your friends and other fellow adventurers! 
          This website is meant to be your own personal wildlife journal. Happy exploring! 
        </p>
      </div>
    
</body>

</html>
