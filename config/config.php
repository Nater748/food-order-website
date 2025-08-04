<?php

session_start();
    $siteurl = "http://localhost/food/";
    $host = "localhost";
    $username = "nater";
    $password = "nater123";
    $database = "food-order";
    $conn = mysqli_connect($host, $username, $password, $database);

    if(!$conn){
        echo "failed connection";
    }
?>