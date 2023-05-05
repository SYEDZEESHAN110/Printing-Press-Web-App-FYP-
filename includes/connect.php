<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "plc";

if (isset($conn) && $conn instanceof mysqli) {
    if ($conn->connect_errno) {
        $conn = mysqli_connect($servername, $username, $password, $database) or die("Unable to connect to database");
    }
    if ($conn->ping() == false) {
        $conn = mysqli_connect($servername, $username, $password, $database) or die("Unable to connect to database");
    }
} else {
    $conn = mysqli_connect($servername, $username, $password, $database) or die("Unable to connect to database");
}