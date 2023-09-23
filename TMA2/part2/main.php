<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../shared/main.css">
        <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    </head>
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
                <h4>Courses</h4>
                <hr>
                <ul class="collapsible">
                    <?php
                    include 'config.php';
                    $id = $_SESSION['username'];
                    $sql = "SELECT * from courseList where course_id in (select course_id from user_courses where user_id  in (select id from registration where username='$id'))";
                    $result = mysqli_query($con, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        while ($courseRows = mysqli_fetch_assoc($result)) {
                            echo '<li>';
                            echo '<a class="btn btn-warning" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">' . $courseRows['course_name'] . ' </a>' ;
                            $courseid = $courseRows['course_id'];
                            $units = "SELECT * from units where parent_course_id='$courseid'";
                            $unit = mysqli_query($con, $units);
                            while ($row = mysqli_fetch_assoc($unit)) {
                                // echo '<div class="row">
                                //         <div class="col">
                                //             <div class="collapse multi-collapse" id="multiCollapseExample1">
                                //                 <div class="card card-body">' . 
                                //                     $row['unitid'] . " - " . $row['unitname'] .
                                //                 '</div>
                                //             </div>
                                //         </div>
                                //     </div>';
                                $unitid = $row['unit_id'];
                                echo '<div class="row">
                                        <div class="col">
                                            <div class="btn border-0 collapse multi-collapse" style="width:15rem;" id="multiCollapseExample1">
                                                <div class="btn card card-body bg-info">';
                                echo '<a class="text-decoration-none" onclick="submitForm(this)" href="displayLesson.php?unitid=' . $unitid . '" id="' . $row['unit_id'] . '">' . $row['unit_name'] . '</a>';

                                echo '</div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            echo '</li>';
                        }
                    }
                    else {
                        echo '<b>No courses assigned to you currently. To register to a new course, please visit: <a href="registerCourse.php">Course List</a></b>';
                    } ?>
                </ul>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>

</html>
