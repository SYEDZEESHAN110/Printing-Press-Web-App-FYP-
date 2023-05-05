<?php
require_once "./../includes/connect.php";
require_once "./helpers/rest_request.php";

$email = isset($_POST["email"]) ? $_POST["email"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;

if ($email === null || empty($email)) {
    $response = [
        "success" => false,
        "message" => "Email must not be null",
    ];
    echo json_encode($response);
    exit();
}
if ($password === null || empty($password)) {
    $response = [
        "success" => false,
        "message" => "Password must not be null",
    ];
    echo json_encode($response);
    exit();
}

$sql = "SELECT * FROM shops WHERE email = '{$email}' AND password = '{$password}';";
$result = mysqli_query($conn, $sql);

$shop = mysqli_fetch_assoc($result);
if ($shop) {
    $response = [
        "success" => true,
        "shop" => $shop,
    ];
    echo json_encode($response);
    exit();
} else {
    $response = [
        "success" => false,
        "message" => "No record found",
    ];
    echo json_encode($response);
    exit();
}