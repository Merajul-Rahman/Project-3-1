<?php
if (isset($_GET['edit_products'])) {
    $p_id = $_GET['edit_products'];
}

include("../functions/conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>

<body>

    <body>
        <div class="container">
            <h3>Edit Product</h3>
            <?php
            $get_products = "SELECT * FROM `product` where product.id=$p_id ";
            $result = mysqli_query($conn, $get_products);

            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            $details = $row['short_desc'];
            $name = $row['name'];
            $image = "../" . $row['image'];
            $price = $row['price'];
            $status = $row['status'];
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4  m-auto">
                    <lable class="from-label" for="product_name">Product Name</lable>
                    <input type="text" name="product_name" id="product_name" class="from-control" value="<?php echo  $name ?>" autocomplete="off" required="requried">
                </div>
                <div class="form-outline mb-4 m-auto">
                    <lable class="from-label" for="product_details">Product Details</lable>
                    <input type="text" name="product_details" id="product_details" class="from-control" value="<?php echo  $details ?>" autocomplete="off" required="requried">
                </div>
                <div class="form-outline mb-4 m-auto">
                    <lable class="from-label" for="product_price">Product price</lable>
                    <input type="text" name="product_price" id="product_price" class="from-control" value="<?php echo  $price ?>" autocomplete="off" required="requried">
                </div>
                <div class="form-outline mb-4 m-auto">
                    <lable class="from-label" for="product_status">Product Status</lable>
                    <input type="text" name="product_status" id="product_status" class="from-control" value="<?php echo  $status ?>" autocomplete="off" required="requried">
                </div>

                <div class="form-outline mb-4 m-auto d-flex ">
                    <lable class="from-label" for="product_image1">Product Image</lable>
                    <div class="d-flex ">
                        <input type="file" name="product_image1" id="product_image1" class="from-control text-center" required="requried">
                        <img height="100px" width="100px" src="<?php echo  $image ?>" alt="image">
                    </div>
                </div>
                <div class="form-outline mb-4 m-auto">
                    <input value="Save Edit" type="submit" name="insert_product" id="insert_product" class="btn btn-info">
                </div>
            </form>
        </div>

        <?php

        if (isset($_POST['insert_product'])) {
            $name = $_POST['product_name'];
            $details = $_POST['product_details'];
            $price = $_POST['product_price'];
            $status = $_POST['product_status'];
            $image = $_FILES['product_image1']['name'];
            $imagex = "image/product/" . $_FILES['product_image1']['name'];
            $a = "../image/product/";
            $url = $a . $image;
            //checcking empty condition
            if ($name == '' or $details == '' or $price == '' or $status == '' or $image == '' or $temp_image = '') {
                echo "<script>alert('Please fill all the fields')</script>";
                exit();
            } else {
                move_uploaded_file($_FILES['product_image1']['tmp_name'], $url);
                //insert query
                $sql_query = "update `product` set `name`='$name',`price`=$price,`image`='$imagex',`short_desc`='$details',`status`=$status where `id`=$p_id";
                $result_query = mysqli_query($conn, $sql_query);
                if ($result_query) {
                    echo "<script>alert('Product is successfully edited')</script>";
                    echo "<script>window.open('./index.php?view_product','_self')</script>";
                }
            }
        }

        ?>



    </body>
</body>

</html>