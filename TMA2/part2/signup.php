<?php
    include 'config.php';
    session_start();
    $success = 0;
    $user = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the user already exists
        $sql = "SELECT username FROM registration where username='$username'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['user'] = 1;
            header('location: sign.php');
        } else {
            // Insert the new user into the database
            $sql = "INSERT INTO registration (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['success'] = 1;
                header('location:sign.php');
            } else {
                die(mysqli_error($con));
            }
        }
        mysqli_close($con);
    }
?>