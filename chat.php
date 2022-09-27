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

        <style>
            /* ul li:first-child {
                margin-left: 0;
            }

            ul li {
                margin-left: 20px;
            } */
        </style>

        <title>Chat</title>
    </head>

    <body>

        <section>
            <div class="container">
                <div class="row">
                    <!-- <form action="#" method="POST"> -->
                    <div class="col-md-4 m-auto main-page">
                        <div class="user-account d-flex justify-content-around">

                            <?php
                            if (isset($_GET["id"])) {
                                $userEmail = $_SESSION["user_email"];
                                $receiverId = $_GET["id"];

                                $sql = "SELECT * FROM users WHERE user_id = '$receiverId'";
                                if ($query = $con->query($sql)) {
                                    $userRow = mysqli_fetch_assoc($query);
                                }
                            }
                            ?>

                            <div class="user-info">
                                <img src="images/<?= $userRow["img"]; ?>" alt="<?= $userRow["img"]; ?>">
                                <span class="ms-3"><?= ucwords($userRow["name"]); ?></span>
                            </div>
                            <div class="logout">
                                <a href="index.php" class="btn btn-warning" style="color: #fff;"> back</a>
                            </div>
                        </div>

                        <form action="" method="POST" id="chat">
                            <div class="chat-body">

                            </div>
                        </form>

                        <div class="sent-body">
                            <form action="" method="post" class=" d-flex justify-content-space-between" id="sent-body">
                                <input type="text" id="sender_id" value="<?= $userEmail; ?>" hidden>
                                <input type="text" id="receiver_id" value="<?= $receiverId; ?>" hidden>
                                <input type="text" class="form-control" id="msg" style="margin-left:20px;width: 70%;">
                                <button type="btton" class="btn btn-success ms-3" id="sent">sent</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    <?php } ?>

    <!-- js link file -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {

            // loadMsg();

            setInterval(function() {
                loadMsg()
            }, 500);

            function scrollToBottom() {
                var scroll = document.getElementById('chat');
                scroll.scrollTop = scroll.scrollHeight;
            };

            $("#chat").on("mouseenter", function() {
                $(".chat-body").addClass("active");
                // stop.scrollToBottom();
            });

            // $("#chat").on("mouseleave", function() {
            //     $(".chat-body").removeClass("active");
            //     // scrollToBottom();

            // });
            $(window).on("click", function() {
                $(".chat-body").removeClass("active");
            });
            const form = document.querySelector(".typing-area"),
                chatBox = document.querySelector(".chat-body");

            function loadMsg() {

                var active = $(".active");
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        action: "action",
                        senderEmail: $("#sender_id").val(),
                        receiverId: $("#receiver_id").val()
                    },
                    success: function(data) {
                        $(".chat-body").html(data);

                        if (!chatBox.classList.contains("active")) {
                            scrollToBottom();
                        }
                    }
                })
            };

            // $("#chat").animate({ scrollTop: $('#chat').prop("scrollHeight")}, 1000);

            $("#sent").on("click", function(e) {

                e.preventDefault();
                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: {
                        action: "action",
                        senderEmail: $("#sender_id").val(),
                        receiverId: $("#receiver_id").val(),
                        message: $("#msg").val()
                    },
                    success: function(data) {
                        if (data == true) {
                            $("#sent-body").trigger("reset");
                            loadMsg();

                        } else {
                            alert("White something")
                        }
                    }
                })
            })
        });
    </script>
    </body>

    </html>