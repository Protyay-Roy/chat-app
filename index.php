<?php
include("db.php");
session_start();

if (!isset($_SESSION["user_email"])) {
    echo "<script>window.open('login.php', '_self')</script>";
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- css link file -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">

        <title>Chat Application</title>
    </head>

    <body>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 m-auto main-page">
                        <div class="user-account d-flex justify-content-around">

                            <?php
                            $userEmail = $_SESSION["user_email"];
                            $sql = "SELECT * FROM users WHERE email = '$userEmail'";
                            if ($query = $con->query($sql)) {
                                $userRow = mysqli_fetch_assoc($query);
                            }

                            ?>

                            <div class="user-info">
                                <img src="images/<?= $userRow["img"]; ?>" alt="<?= $userRow["img"]; ?>">
                                <h5><?= ucwords($userRow["name"]); ?></h5>
                            </div>
                            <div class="logout">
                                <a href="logout.php" class="btn btn-warning" style="color: #fff;"> Log out</a>
                            </div>
                            <input type="hidden" id="sessionEmail" value="<?= $userEmail; ?>">
                        </div>
                        <ul class="user-list">

                        </ul>
                    </div>
                </div>
            </div>
        </section>

    <?php } ?>

    
    <!-- js link file -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>
    <script>
        setInterval(function() {
            $.ajax({
                url: "users.php",
                method: "POST",
                data: {
                    userEmail: $("#sessionEmail").val()
                },
                success: function(data) {
                    $(".user-list").html(data);
                }
            })

        }, 500)
    </script>

    </body>

    </html>