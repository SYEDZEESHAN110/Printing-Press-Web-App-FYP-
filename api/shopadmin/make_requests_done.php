<?php
require_once "./../../includes/connect.php";
require_once "./../helpers/rest_request.php";
require_once "./../helpers/auth_request.php";

$request_id = isset($_POST["request_id"]) ? $_POST["request_id"] : 0;

if ($request_id > 0) {

    $sql = "UPDATE print_request SET is_done=1 WHERE id = '$request_id';";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response = [
            "success" => true,
            "message" => "Print Request done successfully",
        ];
        echo json_encode($response);
        exit();
    } else {
        $response = [
            "success" => false,
            "message" => "Datebase error occured",
        ];
        echo json_encode($response);
    }

} else {
    $response = [
        "success" => false,
        "message" => "Request id is required",
    ];
    echo json_encode($response);
}