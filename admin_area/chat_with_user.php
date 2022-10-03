<?php

include("../chat/DB_connection.php");
include("../chat/links.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My chatbox</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                Chat With:
                </p>
                <ul>
                    <?php
                    $query1 = "SELECT * FROM USERS where id!=1";
                    $users = mysqli_query($connect, $query1) or die("Failed to connect to database ");
                    while ($user = mysqli_fetch_assoc($users)) {
                        echo '<li><a href="chatbox.php?user_id=' . $user["id"] . '">' . $user["username"] . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>