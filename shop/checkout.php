<?php
require("../functions/conn.php");
include("../functions/common_functions.php");

$sql_query = "SELECT * FROM product";
session_start();
$result = $conn->query($sql_query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Shop</title>
    <style>
        h4 {
            color: aqua;
        }

        li {
            color: aquamarine;
            display: block;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="shop.php"><img class="logo" src="../image/product/icon.png" alt="logo" height="100px" width="100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex flex-row-reverse mx-5" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../chat/chat_login.php">Live Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user_area/register.php">Register</a>
                </li>

            </ul>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-warning bg-info">

        <h3 class="mx-3"><a href="shop.php" class="text-decoration-none">E Shop </a></h3>

        <div class="collapse navbar-collapse d-flex flex-row-reverse mx-5" id="navbarSupportedContent">
            <ul style="padding-left:30vw" class="navbar-nav mr-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='../user_area/user_login.php'>Login</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='../user_area/user_logout.php'>Logout</a>
                </li>";
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="row px-1">
        <div class="col-md-12">
            <div class="row">
                <?php
                if (!isset($_SESSION['username'])) {
                    include("../user_area/user_login.php");
                } else {
                    include("payment.php");
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include("../functions/footer.php");

    ?>