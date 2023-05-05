<?php
require_once "./../includes/connect.php";
$sql = "SELECT * FROM extra_cost;";
$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($result);

$costs = array();

$costs["rgb"] = $data["RGB"];
$costs["cmyk"] = $data["CMYK"];
$costs["grayscale"] = $data["grayscale"];

echo json_encode($costs);