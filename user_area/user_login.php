<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>User Login</title>
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

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Log in</p>

                                    <form class="mx-1 mx-md-4" method="POST">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="username">User Name</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" class="form-control" name="username" />

                                            </div>
                                        </div>


                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="user_password">Password</label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" class="form-control" name="user_password" />

                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" value="Login" class="rounded bg-info py-2 px-3 border-0" name="user_login">
                                            <p class=" fw-bold mt-2 pt-1 mb-0 ml-3">Don't have an account?</p>
                                            <a href="../user_area/registration.php" class=" ml-3 text-danger text-decoration-none mt-2 pt-1 mb-0"> Register</a>
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
include("../functions/conn.php");
if (isset($_POST['user_login'])) {
    $username = $_POST['username'];
    $password = $_POST['user_password'];
    $query = "SELECT * FROM `user` WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    session_start();
    if ($row_count > 0) {
        if (password_verify($password, $row_data['password'])) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Login Successfull.')</script>";
            echo "<script>window.open('../shop/shop.php','_self')</script>";
        } else {

            echo "<script>alert('Username and password doesn't match.')</script>";
        }
    } else {
        echo "<script>alert('User not Registered.')</script>";
    }
}
?>