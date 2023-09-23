<?php

$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = 'root';
$db_db = 'bookmark_system';
$db_port = 8889;

$con = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    $db_port
);

if (!$con) {
    die("Connection error: " . $con->connect_error);
}

return $con;