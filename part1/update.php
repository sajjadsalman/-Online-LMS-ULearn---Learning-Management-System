<?php

    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'config.php';
        $userId = $_SESSION['username'];
        $url = $_POST['url'];
        $id = $_POST['id'];
        $sql = "SELECT * FROM `bookmark` WHERE id='$id'";
        $currentRow = mysqli_query($con, $sql);
        $curr = mysqli_fetch_array($currentRow);
        $currURL = $curr['url'];

        $sql2 = "SELECT * FROM bookmark where url!='$currURL' and url='$url' and user_id='$userId'";
        $result = mysqli_query($con, $sql2);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION['duplicate'] = 1;
            header('location: home.php');
        } else {
            $_SESSION['success'] = 1;
            // Insert bookmark into "bookmarks" table with usage_count = 0
            $sql3 = "UPDATE bookmark SET url='$url' WHERE id='$id'";
            mysqli_query($con, $sql3);
            echo $url;
            echo $id;
            // Redirect to bookmark management page
            header('location: home.php');
        }
        mysqli_close($con);
    }
?>