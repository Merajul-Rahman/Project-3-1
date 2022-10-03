<?php
include("../functions/conn.php");
if (isset($_POST['insert_product'])) {
    $name = $_POST['product_name'];
    $details = $_POST['product_details'];
    $price = $_POST['product_price'];
    $status = $_POST['product_status'];
    $image = $_FILES['product_image1']['name'];
    $a = "../image/product/";
    $url = $a . $image;
    //checcking empty condition
    if ($name == '' or $details == '' or $price == '' or $status == '' or $image == '' or $temp_image = '') {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        move_uploaded_file($_FILES['product_image1']['tmp_name'], $url);
        //insert query
        $sql_query = "insert into `product` (name,price,image,short_desc,status) values('$name',$price,'$imagex','$details',$status)";
        $result_query = mysqli_query($conn, $sql_query);
        if ($result_query) {
            echo "<script>alert('Product is inserted successfully')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/index.css">
</head>

<body class="bg-light">
    <h3 class="text-center text-success">Insert Product</h3>
    <div class="container mt-3 text-center">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4  m-auto">
                <lable class="from-label" for="product_name">Product Name</lable>
                <input type="text" name="product_name" id="product_name" class="from-control" placeholder="Enter product name" autocomplete="off" required="requried">
            </div>
            <div class="form-outline mb-4 m-auto">
                <lable class="from-label" for="product_details">Product Details</lable>
                <input type="text" name="product_details" id="product_details" class="from-control" placeholder="Enter product details" autocomplete="off" required="requried">
            </div>
            <div class="form-outline mb-4 m-auto">
                <lable class="from-label" for="product_price">Product price</lable>
                <input type="text" name="product_price" id="product_price" class="from-control" placeholder="Enter product price" autocomplete="off" required="requried">
            </div>
            <div class="form-outline mb-4 m-auto">
                <lable class="from-label" for="product_status">Product Status</lable>
                <input type="text" name="product_status" id="product_status" class="from-control" placeholder="Enter product status 0/1" autocomplete="off" required="requried">
            </div>

            <div class="form-outline mb-4 m-auto text-center">
                <lable class="from-label" for="product_image1">Product Image</lable>
                <input type="file" name="product_image1" id="product_image1" class="from-control" required="requried">
            </div>
            <div class="form-outline mb-4 m-auto">
                <input value="Insert Product" type="submit" name="insert_product" id="insert_product" class="btn btn-info">
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>