<?php
include("../functions/conn.php");
include("../functions/common_functions.php")
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Register user</title>
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div>

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4" method="POST">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <label class="form-label">User Name</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" class="form-control" name="username" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <label class="form-label">Email</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" class="form-control" name="email" />

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <label class="form-label">Mobile</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" class="form-control" name="mobile" />

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <label class="form-label">Address</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" class="form-control" name="address" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="form3Example4c">Password</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" class="form-control" name="password" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label class="form-label">Repeat password</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" class="form-control" name="r_password" />

                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" value="Register" class="rounded bg-info py-2 px-3 border-0" name="user_registration">
                                            <p class=" fw-bold mt-2 pt-1 mb-0 ml-3">Already have an account?</p>
                                            <a href="user_login.php" class=" ml-3 text-danger text-decoration-none mt-2 pt-1 mb-0"> Login</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<?php
if (isset($_POST['user_registration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $r_password = $_POST['r_password'];
    $ip = getIPAddress();

    $u_c_query = "SELECT * FROM `user` WHERE username='$username'";
    $u_result = mysqli_query($conn, $u_c_query);
    $rows_count = mysqli_num_rows($u_result);
    if ($rows_count > 0) {
        echo "<script>alert('Username is already taken.')</script>";
    } else {

        if ($username == '' or $email == '' or $mobile == '' or $address == '' or $password == '' or $r_password == '') {
            echo "<script>alert('Please fill all the fields')</script>";
            exit();
        } else {
            if ($password == $r_password) {
                $sql_query = "INSERT INTO `user` (`username`, `password`, `email`, `mobile`, `address`, `ip`) VALUES('$username','$hash_password','$email','$mobile','$address','$ip')";
                $result_query = mysqli_query($conn, $sql_query);
                if ($result_query) {
                    echo "<script>alert('User is registered successfully.')</script>";
                }
            } else {
                echo "<script>alert('Confirm Password doesn't match.')</script>";
                exit();
            }
        }
    }

    $select_cart_items = "select * from cart where ip_address='$ip' ";
    $result_cart = mysqli_query($conn, $select_cart_items);
    $rows_count = mysqli_num_rows($result_cart);
    if ($rows_count > 0) {
        $_SESSION['username'] = $username;
        echo "<script>alert('You have items in Cart.')</script>";
        echo "<script>window.open('../shop/shop.php','_self')</script>";
    } else {
        echo "<script>window.open('../shop/shop.php','_self')</script>";
    }
}
?>