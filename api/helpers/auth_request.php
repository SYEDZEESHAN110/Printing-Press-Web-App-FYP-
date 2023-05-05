<?php
$headers = apache_request_headers();

$authToken = isset($headers["authorization"]) ? $headers["authorization"] : "";
if(empty($authToken)) {
    $authToken = isset($headers["Authorization"]) ? $headers["Authorization"] : "";    
}

$tokens = explode("Bearer ", $authToken);

if (sizeof($tokens) >= 2) {
    $shop_id = $tokens[1];
    $sql = "SELECT * FROM shops WHERE id = '{$shop_id}'";
    $result = mysqli_query($conn, $sql);
    $shop = mysqli_fetch_assoc($result);
    if ($shop) {
        $_SHOP = $shop;
    } else {
        $response = [
            "success" => false,
            "message" => "Unauthorized",
        ];
        echo json_encode($response);
        exit();
    }
} else {
    $response = [
        "success" => false,
        "message" => "Unauthorized",
    ];
    echo json_encode($response);
    exit();
}