<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'onlineCourse';

$con = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);


if (!$con) {
    die("Connection error: " . $con->connect_error);
}

return $con;