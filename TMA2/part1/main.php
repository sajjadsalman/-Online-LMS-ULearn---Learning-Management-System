<?php
    include 'config.php';
    $sql = "SELECT url, COUNT(url) AS count FROM bookmark GROUP BY url ORDER BY count DESC LIMIT 10";
    $result = mysqli_query($con, $sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookmark Manager</title>
    <link rel="stylesheet" type="text/css" href="../shared/main.css">
    <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body class="bg-danger">
    <nav class="navbar fixed-top">
            <a href="main.php"><i class="ms-3 fa-solid fa-hippo fa-2xl" style="color: #ff8800;"></i></a>
            <p class="m-0 text-warning">Welcome</p>
            <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="login.php">Login</a>
    </nav>
    <h1 class="fw-bolder text-warning text-center" style="margin-top: 6rem;">Bookmark Manager</h1>
    <div class="mx-auto text-center w-50 b p-2">
        <span class="align-middle">If you want to keep a track of all your favorite websites in one place: <a class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="sign.php"> Sign Up</a></span>
    </div>
    <h1 class="fw-bolder text-warning text-center mt-5">Most Popular Bookmarks!</h1>
    <div class="d-flex justify-content-center">
        <div class="container col-md-5 p-*-5 m-1 b">
            <table id="tableVisibility" class="table table-striped table-dark mt-3">
                <thead>
                    <tr>
                    <th style="width: 5%;" class="text-center align-middle" scope="col">No.</th>
                    <th class="text-center align-middle" scope="col">URL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $count = 1;
                        while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row" class="text-center align-middle"><?php echo $row['count'];?></th>
                        <td class="text-center align-middle" style="margin: auto auto auto auto;"><?php echo $row['url']?></td>
                    </tr>
                    <?php
                        $count++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <footer></footer>
  </body>
</html>