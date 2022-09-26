<?php

include("db.php");

if (isset($_POST["message"])) {

    $message = $_POST["message"]; 
    //  echo var_dump($message);die();

    if (!empty($message)) {

        $receiverId = $_POST["receiverId"];
        $senderEmail = $_POST["senderEmail"];

        $senderQ = $con->query("SELECT * FROM users WHERE email = '$senderEmail'");
        // echo ($senderQ); die();
        if ($senderQ) {
            $senderR = $senderQ->fetch_assoc();
            $senderId = $senderR["user_id"];
        }

        $s = "INSERT INTO `massage`(`send_id`, `receive_id`, `send_text`) VALUES ('$senderId','$receiverId','$message')";
        // echo ($s); die();
        if ($con->query($s)) {
            echo true;
        }
    } else {
        echo false;
    }
} 
