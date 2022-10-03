<?php
session_start();
include("DB_connection.php");
include("links.php");
if (isset($_POST['submit'])) {
    $username = $_POST["name"];
    $email = $_POST['email'];
    $sql = "INSERT INTO users(username,email) values('$username','$email')";
    if ($connect->query($sql)) {
        header('Location:chat.php');
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    } else {
        echo "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

</head>

<body>
    <div class="text-center">
        <div>
            <h4>Register your name</h4>
        </div>
        <div>
            <form method="post">
                <div class="class=my-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">

                </div>
                <div class="my-3">
                    <label for="name">Email</label>
                    <input type="email" name="email" id="email">

                </div>


                <input type="submit" value="Submit" name="submit">
            </form>


        </div>
    </div>




</body>

</html>