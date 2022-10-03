<?php
include("./functions/header.php");
require("./functions/conn.php");

$sql_query = "SELECT * FROM home";
$result = $conn->query($sql_query);
?>
<title>Home</title>
<link rel="stylesheet" href="./CSS/card.css">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="card">
            <img src="<?php echo $row["image"] ?>" class="card-img-top" alt="./image/profile.png.">
            <div class="card-body">
                <h5 class="p-0 card-title text-center"><?php echo $row["name"] ?></h5>
                <div class="p-0 text-center">
                    <a href="home_det.php?id=<?php echo $row["id"] ?>"><button class="btn btn-success btn-outline-warning">Read More</button></a>
                </div>
            </div>
        </div>
<?php
    }
}
?>
<?php
include("./functions/footer.php");
?>