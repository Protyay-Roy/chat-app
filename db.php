<?php
    $con = mysqli_connect("localhost","root","","chatting");

    if (!$con){
        echo "db connection failed";
    }

?>