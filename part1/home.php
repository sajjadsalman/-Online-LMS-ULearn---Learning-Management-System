<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login.php');
    }

    
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bookmark App</title>
        <link rel="stylesheet" type="text/css" href="../shared/main.css">
        <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body class="bg-danger" onload='javascript:showTable();'>
        <nav class="navbar fixed-top">
            <a href="home.php"><i class="ms-3 fa-solid fa-hippo fa-2xl" style="color: #ff8800;"></i></a>
            <p class="m-0 text-warning">Welcome <?php
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                    echo $_SESSION['username'];
                }
            ?>!</p>
            <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="logout.php">Logout</a>
        </nav>
        <?php
            if(isset($_SESSION['duplicate']) && $_SESSION['duplicate']) {
                if ($_SESSION['duplicate']) {
                    echo '<div class="fixed-top alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sorry!</strong> You tried to add a duplicate bookmark!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                $_SESSION['duplicate'] = 0;
                }
            }
        ?>
        <?php
            if(isset($_SESSION['success']) && $_SESSION['success']) {
                if ($_SESSION['success']) {
                    echo '<div class="fixed-top alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Congratulations!</strong> Bookmark added successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                $_SESSION['success'] = 0;
                }
            }
        ?>
        <h6 class="fw-bolder text-center" style="margin-top: 6rem;">Please add your favorite websites to the list of your saved bookmarks below:</h6>
        <div class="d-flex justify-content-center mborder p-0">
            <div class="text-center container b">
                <form class="container-fluid col-md-7 mb-3" action="insert.php" method="POST">
                        <h3 class="text-center font-monospace mt-3">Bookmark System</h3>
                        <div class="d-flex justify-content-center">
                            <input type="url" class="form-control" name="url" placeholder="URL" required>
                            <button class="btn btn-warning" onClick='javascript:showTable();'><i class="fa-solid fa-rocket"></i></button>
                        </div>
                </form>
    
    
                <!-- get data -->
                <?php
                include 'config.php';
                $userId = $_SESSION['username'];
                $sql = "SELECT * FROM `bookmark` WHERE user_id='$userId'";
                $rawData = mysqli_query($con, $sql);
                ?>
    
    
                <div class="container col-md-7">
                    <table id="tableVisibility" hidden class="table table-striped table-dark mt-3">
                    <thead>
                        <tr>
                        <th style="width: 5%;" class="text-center align-middle" scope="col">No.</th>
                        <th class="text-center align-middle" scope="col">URL</th>
                        <th class="text-center align-middle" scope="col" style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 1;
                            while ($row = mysqli_fetch_array($rawData)) {
                        ?>
                        <tr>
                            <th scope="row" class="text-center align-middle"><?php echo $count;?></th>
                            <td class="text-center align-middle" style="margin: auto auto auto auto;"><?php echo $row['url']?></td>
                            <td class="text-center">
                                <a class="btn btn-success" href="edit.php? ID= <?php echo $row['id'] ?>"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #d6bf4c;"></i></a>
                                <a class="btn btn-danger" href="delete.php? ID= <?php echo $row['id'] ?>"><i class="fa-solid fa-trash fa-lg" style="color: #000000;"></i></a>
                            </td>
                        </tr>
                        <?php
                            $count++;
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer></footer>
        <script type="text/javascript" src="table.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>