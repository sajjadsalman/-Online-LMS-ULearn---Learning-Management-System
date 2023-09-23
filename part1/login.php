<?php
        session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page!</title>
    <link rel="stylesheet" type="text/css" href="../shared/main.css">
    <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body class="bg-danger">
  <nav class="navbar fixed-top">
  <a href="main.php"><i class="ms-3 fa-solid fa-hippo fa-2xl" style="color: #ff8800;"></i></a>
            <p class="m-0 text-warning">Bookmark Manager</p>
            <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="main.php">Home</a>
        </nav>
    <?php
    if(isset($_SESSION['invalid']) && $_SESSION['invalid']) {
        if ($_SESSION['invalid']) {
            echo '<div class="fixed-top alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Username or Password is invalid.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        $_SESSION['invalid'] = 0;
    }
    ?>
    <div class="container b lm">
        <h1 class="text-center">Login</h1>
        <form class="text-center mb-3" action="loginHelper.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fl">Username</label>
                <input type="text" class="form-control m-auto mb-3" placeholder="Enter your username" name="username">
                <label for="exampleInputPassword1" class="form-label fl">Password</label>
                <input type="password" class="form-control m-auto" placeholder="Enter your password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="sign.php" class="btn btn-warning">Signup</a>
        </form>
    </div>
    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>