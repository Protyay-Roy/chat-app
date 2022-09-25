<?php
include("db.php");
session_start();

$status = 0;
$updateS = "UPDATE `users` SET `status`='$status' WHERE `email` = '{$_SESSION["user_email"]}'";
if ($updateQ = $con->query($updateS)) {

    unset($_SESSION["user_email"]);

    session_destroy();

    echo "<script>alert('logout successful')</script>";
    echo "<script>window.open('login.php', '_self')</script>";

    die();
}
