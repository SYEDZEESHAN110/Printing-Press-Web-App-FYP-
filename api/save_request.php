<?php
require_once "./helpers/rest_request.php";
require_once "./../includes/connect.php";

$phone_number = $_POST["phone_number"];
$design = $_POST["design"];
$fileName = "upload/" . time() . $phone_number . ".jpg";
$imagePath = __DIR__ . "/../" . $fileName;

base64_to_jpeg($design, $imagePath);

$selectedService = $_POST["service"];
$sizeOfProduct = $_POST["size"];
$paperQuality = $_POST["paper_quality"];
$quantity = $_POST["quantity"];
$colorScheme = $_POST["color_scheme"];
$shop_id = $_POST["shop_id"];
$paymentMethod = $_POST["payment_method"];

$sql = "INSERT INTO print_request(type,paper_quality,size,quantity,color_scheme,phone_number,design,shop_id,payment_method) VALUES('$selectedService','$paperQuality','$sizeOfProduct','$quantity','$colorScheme','$phone_number','$fileName', '$shop_id', '$paymentMethod')";

if ($conn->query($sql) == true) {
    //Get last inserted record id
    $last_id = $conn->insert_id;
    $response = [
        "success" => true,
        "message" => "Print request saved",
        "id" => $last_id,
    ];

} else {
    $response = [
        "success" => false,
        "message" => "Data saving error at server",
    ];
}

echo json_encode($response);

$conn->close();

function base64_to_jpeg($base64_string, $output_file)
{
    // open the output file for writing
    $ifp = fopen($output_file, 'wb');

    $data = explode(',', $base64_string);
    if (sizeof($data) >= 2) {
        fwrite($ifp, base64_decode($data[1]));
    }
    if (sizeof($data) >= 1) {
        fwrite($ifp, base64_decode($data[0]));
    }
    fclose($ifp);

}