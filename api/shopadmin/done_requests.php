<?php
require_once "./../../includes/connect.php";
require_once "./../helpers/auth_request.php";

$sql = "SELECT * FROM `print_request` WHERE shop_id='{$shop_id}' AND is_done=1";
$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$costSql = "SELECT * FROM extra_cost;";
$costResult = mysqli_query($conn, $costSql);
$costRow = mysqli_fetch_assoc($costResult);

$mainData = [];

foreach ($data as $d) {
    $d["extra_cost_database_row"] = $costRow;
    array_push($mainData, $d);
}

echo json_encode($mainData, JSON_INVALID_UTF8_SUBSTITUTE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);