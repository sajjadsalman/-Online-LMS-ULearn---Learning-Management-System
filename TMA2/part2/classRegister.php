<?php
	include 'config.php';
	session_start();
	$id = $_SESSION['username'];
	$courseid = $_POST["courseid"];
    $sql = "SELECT id from registration where username='$id'";
    $result = mysqli_query($con, $sql);
    $userid = mysqli_fetch_assoc($result)['id'];
	if ($id && $courseid) {
		$row = "INSERT INTO `user_courses`(`user_id`, `course_id`) VALUES ('$userid','$courseid')";
        $result = mysqli_query($con, $row);
        header("location: main.php");
	}
?>