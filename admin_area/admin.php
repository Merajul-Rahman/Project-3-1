<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
} else {
    echo "<script>window.open('index.php','_self')</script>";
}
