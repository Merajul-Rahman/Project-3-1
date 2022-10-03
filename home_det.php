<?php
include("./functions/header.php");
include_once("./functions/conn.php");

$id = "";
if (isset($_GET["id"])) {
    # code...
    $id = $_GET["id"];
}
$sql_query = "SELECT * FROM home WHERE id=$id";
$result = $conn->query($sql_query);
?>

<style>
    .image {
        text-align: center;
    }

    h3 {
        text-align: center;
        color: black;
    }

    p {
        padding: 10px 0px 0px 10px;
    }
</style>
<title>Information</title>
<div>
    <h1 align="center">Information</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
            <div class="row">
                <div class="col-md-4">
                    <p class="image">
                        <img src="<?php echo $row["image"] ?>" alt="<?php echo $row["name"] ?>">
                    <h3><?php echo $row["name"] ?></h3>

                    </p>
                </div>
                <div class="col-md-8">
                    <p>
                        <?php echo $row["details"] ?>
                    </p>
                </div>
            </div>

    <?php
        }
    }
    ?>
</div>

</div>
<?php
include("./functions/footer.php");
?>