<?php
if (isset($_GET['delete_product'])) {
    $p_id = $_GET['delete_product'];
}

include("../functions/conn.php");
$del_product = "DELETE  FROM `product` where product.id=$p_id ";
$result = mysqli_query($conn, $del_product);
if ($result) {
    echo "<script>alert('Product is successfully DELETED')</script>";
    echo "<script>window.open('./index.php?view_product','_self')</script>";
}
