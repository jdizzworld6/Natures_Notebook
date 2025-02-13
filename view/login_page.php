<?php
    session_start();
    require_once '../utilities/security.php';
    require_once '../controller/users_controller.php';
    require_once '../controller/users.php';
    
    Security::checkHTTPS();

    $login_message = isset($_SESSION['log_message']) ? $_SESSION['log_message'] : '';

    if (isset($_POST['logID']) & isset($_POST['password'])){
      $userLevel = UsersController::validUser($_POST['logID'], $_POST['password']);
      Security::setUserLevelSession($userLevel);
      $login_message = $_SESSION['log_message'];
    }

?>


<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<form method="post">
  <div class="form-group">
    <label for="exampleInputUserID">User ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="logID" aria-describedby="idHelp" placeholder="Enter id">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</html>