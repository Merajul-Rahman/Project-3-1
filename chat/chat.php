<?php
session_start();
include("DB_connection.php");
include("links.php");

$to_id = 1;

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$qgetid = "SELECT * FROM users WHERE username='$username' and email='$email'";
$from_users = mysqli_query($connect, $qgetid);
$from_user = mysqli_fetch_assoc($from_users);
$from_id = $from_user['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="chat-container">
        <div class="container-fluid flex text-right">
            <a href="clear.php">
                <h3>Close Chat</h3>
            </a>
        </div>
        <ul class="chat">
            <?php
            $message_query = "SELECT * from `MESSAGE` WHERE (fromuser= $from_id and touser=$to_id) or (fromuser=$to_id and touser= $from_id)";
            $messages = mysqli_query($connect, $message_query);
            while ($message = mysqli_fetch_assoc($messages)) {

                if ($message['fromuser'] == $from_id) {
            ?>
                    <li class="message right">
                        <p><?php echo $message['message'] ?></p>
                    </li>
                <?php
                } else {
                ?>
                    <li class="message left">
                        <p><?php echo $message['message'] ?></p>
                    </li>
            <?php
                }
            }
            ?>

        </ul>

        <div class="container-fluid flex">
            <form method="POST">
                <input type="text" class="text_input" name="message" placeholder="Message..." />
                <input type="submit" value="Send" style="width:9% ;" name="send">
            </form>
        </div>
    </div>


</body>

</html>
<?php
if (isset($_POST['send'])) {
    $send_message = $_POST['message'];
    $insert = "INSERT INTO `message` ( `fromuser`, `touser`, `message`) VALUES ($from_id, $to_id, '$send_message')";
    $result = mysqli_query($connect, $insert);
    header("Location:chat.php?user_id= $to_id");
}
?>