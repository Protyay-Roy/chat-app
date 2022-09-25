<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link file -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Log In</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form action="" method="POST" id="login">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" required>
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput2" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="password" name="password" required>
                    </div>
                    <div class="mb-3" style="width: 50%; margin:auto;">
                        <input type="submit" value="Login" class="form-control btn btn-success" name="login">
                    </div>

                    <!-- <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div> -->
                    <div class="registration mb-2">
                        Don't have an account? <a href="registration.php">Registration here</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php
    include("db.php");

    if (isset($_POST["login"])) {

        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = $con->query($sql);


        if (mysqli_num_rows($query) > 0) {

            $row = $query->fetch_assoc();
            $userPass = $row["password"];
            if ($password == $userPass) {

                session_start();
                $_SESSION["user_email"] = $row["email"];

                $status = 1;
                $updateS = "UPDATE `users` SET `status`='$status' WHERE `email` = '{$_SESSION["user_email"]}'";
                if ($updateQ = $con->query($updateS)) {

                    echo "<script>alert('Login successful')</script>";
                    echo "<script>window.open('index.php', '_self')</script>";
                }
            } else {

                echo "<script>alert('Your password is wrong')</script>";
                die();

            }
        } else {

            echo "<script>alert('Your email is wrong')</script>";
            die();
        }
    }

    ?>


    <!-- js link file -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>
</body>

</html>