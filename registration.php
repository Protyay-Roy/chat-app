<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link file -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .reg {
            margin-top: 120px !important;
        }
    </style>

    <title>Registration</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form action="" method="POST" id="login" class="reg" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Enter your name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="password" name="password" required>
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput4" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="exampleFormControlInput4" name="img" required>
                    </div>
                    <div class="mb-3" style="width: 50%; margin:auto;">
                        <input type="submit" value="submit" class="form-control btn btn-success" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("db.php");

    if (isset($_POST["submit"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $userQ = $con->query("SELECT * FROM users");
        $userR = mysqli_fetch_assoc($userQ);

        $userEmail = $userR["email"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($email == $userEmail) {
                echo "<script>alert(' This email is already added. ')</script>";
            } else {
                if (isset($_FILES["img"])) {
                    $img = $_FILES["img"]["name"];
                    $img_tmp = $_FILES["img"]["tmp_name"];


                    $insertQ = $con->query("INSERT INTO `users`(`name`, `email`, `password`, `img`) 
                                                        VALUES ('$name','$email','$password','$img')");
                    if($insertQ) {
                        move_uploaded_file($img_tmp,"images/$img");
                        echo "<script>alert('Registration successful. Please login for chatting others')</script>";
                        echo "<script>window.open('login.php', '_self')</script>";
                    }                                
                }
            }
        } else {
            echo "<script>alert($email' - This email is not valid. ')</script>";
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