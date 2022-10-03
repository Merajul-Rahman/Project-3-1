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
                <th>User Id</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Mobile</th>
                <th>User Address</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">

            <?php
            $get_products = "SELECT * FROM `user`";
            $result = mysqli_query($conn, $get_products);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['username'];
                $email = $row['email'];
                $phone = $row['mobile'];
                $address = $row['address'];
            ?>
                <tr class="text-center">
                    <td><?php echo  $id ?></td>
                    <td><?php echo  $name ?></td>
                    <td><?php echo  $email ?></td>
                    <td><?php echo $phone ?></td>
                    <td><?php echo $address ?></td>

                </tr>
            <?php
            }

            ?>


        </tbody>
    </table>
</body>

</html>