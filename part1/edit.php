<?php
    session_start();
    include 'config.php';
    $id = $_GET['ID'];
    $sql = "SELECT * FROM `bookmark` WHERE id='$id'";
    $editRow = mysqli_query($con, $sql);
    $data = mysqli_fetch_array($editRow);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Bookmark</title>
    <link rel="stylesheet" type="text/css" href="../shared/main.css">
    <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body class="bg-danger">
    <nav class="navbar fixed-top">
            <a href="home.php"><i class="ms-3 fa-solid fa-hippo fa-2xl" style="color: #ff8800;"></i></a>
            <p class="m-0 text-warning">Welcome 
            <?php
               if(isset($_SESSION['username']) && $_SESSION['username']) {
                    echo $_SESSION['username'];
                }
            ?>!</p>
            <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="logout.php">Logout</a>
    </nav>
    <div class="container top">
        <h6 class="fw-bolder">Please update the selected bookmark below:</h6>
    </div>
    <div class="d-flex justify-content-center mborder p-0">
        <div class="text-center container b">
            <form class="container-flcol-md-7 mb-3" action="update.php" method="POST">
                <div class="container mb-3">
                    <h3 class="text-center font-monospace mt-3">Update Bookmark</h3>
                    <div class="d-flex justify-content-center">
                        <input type="url" value="<?php echo $data['url'] ?>" class="form-control" name="url" placeholder="URL" required>
                        <button class="btn btn-warning" onClick='javascript:showTable();'><i class="fa-solid fa-pen-to-square fa-lg" style="color: #06090e;"></i></button>
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>