<!-- Nav bar for all admin pages -->
<?php

  error_reporting(0);
  Security::checkHTTPS();

 if (!isset($_SESSION['admin_level'])){
    $_SESSION['admin_level'] = false;
 }
 if (!isset($_SESSION['user_level'])){
  $_SESSION['user_level'] = false;
}

  if (isset($_POST['logout'])){
      Security::logout();
      header("Location: ../index.php");
  }

  if (isset($_POST['login'])){
    header("Location: login_page.php");
  }

  if ($_SESSION['admin_level'] == true || $_SESSION['user_level'] == true) {
    $loginButton = '<input type="submit" name="logout" value="Log Out">';
  } else {
    $loginButton = '<input type="submit" name="login" value="Log In">';
  }

  ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Nature's Notebook</title>
</head>


<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid ">
  <a class="navbar-brand" href="user_manage_account.php"">My Account</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="user_find_friends.php">Find Friends</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="user_my_friends.php">My Friends</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="user_all_photos.php">My Photos</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="user_friends_photos.php">Friends Photos</a>
        </li>

      </ul>
      <form method="post" class="d-flex">
        <input id="logout" type="submit" name="logout" value="Logout">
      </form>
    </div>
  </div>
</nav>

<script src="temp_view_photo.js"></script>