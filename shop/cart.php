<?php
require("../functions/conn.php");
include("../functions/common_functions.php");
session_start();
$sql_query = "SELECT * FROM product";

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
    <title>Cart Details</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="shop.php"><img class="logo" src="../image/icon.png" alt="logo" height="100px" width="100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex flex-row-reverse mx-5" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item active">
                    <a class="nav-link" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../chat/chat_login.php">Live Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user_area/register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><img src="../image/cart.png" alt="cart" height="30px" width="30px"><sup><?php cart_item_no(); ?></sup></a>
                </li>

            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-warning bg-info">

        <h3 class="mx-3 text-decoration-none"><a class="text-decoration-none" href="shop.php">E Shop </a></h3>

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

    <?php
    cart();
    ?>
    <div class="container">
        <div class="row">
            <form action="" method="POST">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Remove</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require("../functions/conn.php");
                        $ip = getIPAddress();
                        $total_price = 0;
                        $query = "SELECT * FROM `cart` WHERE `ip_address`='$ip'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {

                            $product_id = $row['product_id'];
                            $product_quantity = $row['quantity'];
                            $query1 = "SELECT * FROM `product` WHERE `id`='$product_id'";
                            $result1 = mysqli_query($conn, $query1);
                            while ($row_product_price = mysqli_fetch_array($result1)) {
                                $product_price = array($row_product_price['price']);
                                $product_name = $row_product_price['name'];
                                $table_price = $row_product_price['price'];
                                $product_image = "../" . $row_product_price['image'];

                                $product_values = array_sum($product_price);
                                $total_price += $product_values * $product_quantity;

                        ?>
                                <tr>
                                    <td><?php echo $product_name ?></td>
                                    <td><img src="<?php echo $product_image ?>" height="150px" width="150px" alt="imp"></td>
                                    <td><input type="text" name="quantity" id="quantity" value="<?php echo $product_quantity ?>"></td>
                                    <?php
                                    require("../functions/conn.php");
                                    if (isset($_POST['update_cart'])) {
                                        $ip = getIPAddress();
                                        $get_product = $_POST['quantity'];
                                        echo $product_id;
                                        $query = " UPDATE `cart` SET `quantity`=$get_product WHERE `ip_address`='$ip'";
                                        $result = mysqli_query($conn, $query);
                                        if ($result) {
                                            echo "<script>alert('Item is updated')</script>";
                                            echo "<script>window.open('cart.php','_self')</script>";
                                        }
                                    }
                                    ?>
                                    <td><?php echo $table_price ?></td>
                                    <td><input type="checkbox" name="remove_item[]" value=" <?php echo $product_id ?>" id="remove_item"></td>
                                    <td>
                                        <input type="submit" value="Update" name="update_cart" class="btn btn-info mx-3 px-3 py-2 border-0">
                                        <input type="submit" value="Remove" name="remove_cart" class="btn btn-info mx-3 px-3 py-2 border-0">
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        ?>

                    </tbody>
                </table>

                <div class="d-flex my-3">
                    <h4 class="px-3 text-info">Subtotal: <strong><?php echo $total_price ?></strong></h4>

                    <button class="btn btn-info mx-3 px-3 py-2 border-0"><a href="shop.php" class="text-decoration-none">Continue Shopping</a></button>
                    <button class="btn btn-info mx-3 px-3 py-2 border-0"><a href="checkout.php" class="text-decoration-none">Check Out</a></button>
                </div>
            </form>
        </div>
    </div>
    <?php
    function remove_cart_item()
    {
        require("../functions/conn.php");
        if (isset($_POST['remove_cart'])) {
            # code...
            foreach ($_POST['remove_item'] as $remove_id) {
                echo $remove_id;
                $delete_query = "DELETE FROM `cart` WHERE product_id=$remove_id";
                $result = mysqli_query($conn, $delete_query);
                if ($result) {
                    echo "<script>window.open('cart.php','_self')</script>";
                }
            }
        }
    }

    echo $remove_item = remove_cart_item();
    include("../functions/footer.php");

    ?>