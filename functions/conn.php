<?php
$user_name = "root";
$host_name = "localhost";
$password = "";
$db_name = "project";

$conn = new mysqli($host_name, $user_name, $password, $db_name);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
