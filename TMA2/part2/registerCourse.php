<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Course Registration!</title>
        <link rel="stylesheet" type="text/css" href="../shared/main.css">
        <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    </head>
    <body class="bg-danger">
        <nav class="navbar fixed-top">
            <a href="main.php"><i class="icon ms-3 fa-solid fa-hippo fa-2xl" style="color: #ff8800;"></i></a>
            <p class="m-0 text-warning">Welcome to ULearn <?php
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                    echo $_SESSION['username'];
                }
            ?>!</p>
            <div>
                <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="registerCourse.php">Register</a>
                <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="logout.php">Logout</a>
            </div>        
        </nav>

        <div class="container" style="margin-top: 5rem;">
            <div class="card-panel">
                <h4>Available Courses</h4>
                <hr>
                <ul class="collapsible">
                    <?php
                        include 'config.php';
                        $id = $_SESSION['username'];
                        if ($id) {
                            $sql = "SELECT * from courseList where course_id not in (select course_id from user_courses where user_id in (select id from registration where username='$id'))";
                            $result = mysqli_query($con, $sql);
                            if(mysqli_num_rows($result) > 0) {
                                while ($courseRows = mysqli_fetch_assoc($result)) {
                                    $cardTitle = $courseRows['course_name'];
                                    $cardText = $courseRows['course_content'];
                                    // Output the HTML code for the card
                                    echo '
                                    <div class="card text-white bg-warning mb-3" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">' . $cardTitle . '</h5>
                                            <form action="classRegister.php" method="post"><p class="card-text">' . $cardText . '</p> 
                                            <input type="hidden" name="courseid" value="'. $courseRows['course_id'] . '">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info"><i class="fa-solid fa-paper-plane"></i>  Register</button>  </form> </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<b>No more courses are available.</b>';
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>

    </body>
</html>
