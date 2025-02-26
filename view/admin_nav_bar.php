<!-- Nav bar for all admin pages -->
<?php
error_reporting(0);
session_start();
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


echo '
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Nature\'s Notebook</title>
</head>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin_manage_users.php"">Users Account</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_user_add_update_user.php">Add User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_manage_category.php">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_manage_category_add_update.php">Add Category</a>
        </li>
      </ul>
    </div>
  </div>
</nav>';

?>

<html>
  <form method="post">
    <?php echo $loginButton ?>
  </form>
</html>