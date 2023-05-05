<?php

try {
    require_once "./helpers/rest_request.php";
    require_once "./../includes/connect.php";

    $owner_name = $_POST["owner_name"];
    $shop_email = $_POST["shop_email"];
    $shop_password = $_POST["shop_password"];
    $owner_gender = $_POST["owner_gender"];
    $contact_number = $_POST["contact_number"];
    $shop_name = $_POST["shop_name"];
    $shop_city = $_POST["shop_city"];
    $shop_address = $_POST["shop_address"];
    $shop_lat = $_POST["shop_lat"];
    $shop_lon = $_POST["shop_lon"];
    $easypaisa_number = $_POST["easypaisa_number"];
    $jazzcash_number = $_POST["jazzcash_number"];

    $sql = "INSERT INTO shops(name,email,password,gender,phone_number,shop_name,shop_city,shop_address,shop_lat,shop_lon,easypaisa_number,jazzcash_number) VALUES('$owner_name','$shop_email','$shop_password','$owner_gender','$contact_number','$shop_name','$shop_city','$shop_address','$shop_lat','$shop_lon','$easypaisa_number','$jazzcash_number')";

    if ($conn->query($sql) == true) {
        $response = [
            "success" => true,
        ];
        echo json_encode($response);
    }
    $conn->close();

} catch (Exception $e) {
    $response = [
        "success" => false,
        "message" => $e->getMessage(),
    ];
    echo json_encode($response);
}