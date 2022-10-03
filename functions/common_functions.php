<?php

function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();

//cart_function
function cart()
{
    require("../functions/conn.php");
    if (isset($_GET['add_to_cart'])) {
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $query = "SELECT * FROM `cart` WHERE `ip_address`='$ip' and  `product_id`=$get_product_id";
        $result = mysqli_query($conn, $query);
        $num_of_rows = mysqli_num_rows($result);
        if ($num_of_rows > 0) {
            echo "<script>alert('This Item is already present inside cart')</script>";
            echo "<script>window.open('shop.php','_self')</script>";
        } else {
            $insert_query = "insert into `cart` (product_id,user_id,ip_address,quantity)
            values($get_product_id,1,'$ip',1)";
            $result_q = mysqli_query($conn, $insert_query);
            echo "<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('shop.php','_self')</script>";
        }
    }
}
//function to get cart item number

function cart_item_no()
{
    require("../functions/conn.php");
    if (isset($_GET['add_to_cart'])) {
        $ip = getIPAddress();
        $query = "SELECT * FROM `cart` WHERE `ip_address`='$ip'";
        $result = mysqli_query($conn, $query);
        $cart_items = mysqli_num_rows($result);
    } else {
        $ip = getIPAddress();
        $query = "SELECT * FROM `cart` WHERE `ip_address`='$ip'";
        $result = mysqli_query($conn, $query);
        $cart_items = mysqli_num_rows($result);
    }
    echo $cart_items;
}
//total price
function total_price()
{
    require("../functions/conn.php");
    $ip = getIPAddress();
    $total_price = 0;
    $query = "SELECT * FROM `cart` WHERE `ip_address`='$ip'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $query1 = "SELECT * FROM `product` WHERE `id`='$product_id'";
        $result1 = mysqli_query($conn, $query1);
        while ($row_product_price = mysqli_fetch_array($result1)) {
            $product_price = array($row_product_price['price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}
