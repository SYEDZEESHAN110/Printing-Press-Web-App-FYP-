<?php
require_once "./../includes/connect.php";
$sql = "SELECT * FROM services;";
$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($data);