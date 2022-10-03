<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>window.open('chat_login.php','_self')</script>";
} else {
    echo "<script>window.open('chat.php','_self')</script>";
}
