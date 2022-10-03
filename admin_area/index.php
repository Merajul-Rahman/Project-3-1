<?php
include("../functions/conn.php");
include("../functions/common_functions.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/index.css">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <a href="../home.php"><img src="../image/profile.png" height="50" width="50" alt="profile"></a>
                <nav class="navbar navbar-expand-lg navbar-light bg-info">
                    <ul class="navbar-nav">
                        <?php echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                </li>"; ?>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <div class="bg-light">
        <h3 class="text-center">Manage Details</h3>
    </div>

    <div class="row ">
        <div class="col-md-12 align-items-center">
            <div class="button text-center">
                <button><a href="index.php?insert_product" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                <button><a href="index.php?view_product" class="nav-link text-light bg-info my-1">View Products</a></button>
                <button><a href="index.php?all_orders" class="nav-link text-light bg-info my-1">All Orders</a></button>
                <button><a href="index.php?chat" class="nav-link text-light bg-info my-1">Chat With Users</a></button>
                <button><a href="index.php?user_list" class="nav-link text-light bg-info my-1">User List</a></button>
                <button><a href="admin_logout.php" class="nav-link text-light bg-info my-1">Logout</a></button>
            </div>
        </div>


    </div>
    <div class="container">
        <?php
        $ip = getIPAddress();
        if (isset($_GET['insert_product'])) {
            include("insert_product.php");
        } else if (isset($_GET['view_product'])) {
            include("view_product.php");
        } else if (isset($_GET['all_orders'])) {
            include("orders.php");
        } else if (isset($_GET['chat'])) {
            include("chat_with_user.php");
        } else if (isset($_GET['user_list'])) {
            include("users.php");
        }
        if (isset($_GET['edit_products'])) {
            include("edit_products.php");
        }
        if (isset($_GET['delete_product'])) {
            include("delete_product.php");
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php
    include("../functions/footer.php");
    ?>