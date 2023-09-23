<?php

    session_start();
    $login = 0;
    $invalid = 0;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'config.php';
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the user already exists
        $sql = "SELECT * FROM registration where username='$username' and password='$password'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['username']=$username;
            header('location:home.php');
        } else {
            $_SESSION['invalid'] = 1;
            header('location:login.php');
        }
        mysqli_close($con);
    }
?>