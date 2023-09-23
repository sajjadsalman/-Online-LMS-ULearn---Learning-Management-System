<?php
    session_start();
    $duplicate = 0;
    $success = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'config.php';
        // Get form data
        $userId = $_SESSION['username'];
        $url = $_POST['url'];

        $sql = "SELECT * FROM bookmark where url='$url' and user_id='$userId'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['duplicate'] = 1;
            $_SESSION['success'] = 0;
            header('location: home.php');
        } else {
            $_SESSION['duplicate'] = 0;
            $_SESSION['success'] = 1;
            // Insert bookmark into "bookmarks" table with usage_count = 0
            $sql = "INSERT INTO bookmark (user_id, url) VALUES ('$userId', '$url')";
            $result = mysqli_query($con, $sql);
            // Redirect to bookmark management page
            header('location: home.php');
        }
    }

?>