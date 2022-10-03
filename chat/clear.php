<?php
include("DB_connection.php");
session_start();
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$qgetid = "SELECT * FROM users WHERE username='$username' and email='$email'";
$from_users = mysqli_query($connect, $qgetid);
$from_user = mysqli_fetch_assoc($from_users);
$from_id = $from_user['id'];
$query = "DELETE FROM `message` WHERE fromuser=$from_id";
$query1 = "DELETE FROM `message` WHERE touser=$from_id";
$result = mysqli_query($connect, $query);
$result1 = mysqli_query($connect, $query1);
echo "<script>window.open('../home.php','_self')</script>";
