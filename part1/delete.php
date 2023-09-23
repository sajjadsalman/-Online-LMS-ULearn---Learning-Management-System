<?php

    include 'config.php';
    $id = $_GET['ID'];
    $sql = "DELETE FROM `bookmark` WHERE id='$id'";
    mysqli_query($con, $sql);
    header('location: home.php');
?>