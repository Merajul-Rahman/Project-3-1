<?php
include("../functions/conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-border-mt-5">
        <thead class="bg-info">
            <tr>
                <th>Product Id</th>
                <th>Product name</th>
                <th>Product Image</th>
                <th>Product price</th>
                <th>Product status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">

            <?php
            $get_products = "SELECT * FROM `product`";
            $result = mysqli_query($conn, $get_products);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $image = "../" . $row['image'];
                $price = $row['price'];
                $status = $row['status'];
            ?>
                <tr class="text-center">
                    <td><?php echo  $id ?></td>
                    <td><?php echo  $name ?></td>
                    <td><img src="<?php echo  $image ?>" alt="img" height="100px" width="100px"></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $status ?></td>
                    <td><a href="index.php?edit_products=<?php echo  $id ?>" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href="index.php?delete_product=<?php echo  $id ?>" class="text-light"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
            <?php
            }

            ?>


        </tbody>
    </table>
</body>

</html>