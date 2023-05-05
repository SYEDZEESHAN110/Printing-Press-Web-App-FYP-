<?php
require_once "./../includes/connect.php";
$sql = "SELECT id, name, email, gender, phone_number, shop_name, shop_city, shop_address, shop_lat, shop_lon, easypaisa_number, jazzcash_number FROM shops;";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

//bank details
$bank_sql = "SELECT * FROM bank_details;";
$bankResult = mysqli_query($conn, $bank_sql);
$bank_records = mysqli_fetch_all($bankResult, MYSQLI_ASSOC);

$all_shops = array();

foreach ($data as $shop) {
    $my_shop = array();
    foreach ($shop as $key => $val) {
        $my_shop[$key] = $val;
    }
    $account_title = "";
    $account_number = "";
    $bank_name = "";
    $shop_id = $shop["id"];
    $shop_bank_record = array_filter($bank_records, fn ($bank_record) => $bank_record["shop_id"] == $shop_id);
    if ($shop_bank_record && is_array($shop_bank_record) && sizeof($shop_bank_record) > 0) {
        $shop_bank_record = $shop_bank_record[0];
        $account_title = $shop_bank_record["account_title"];
        $account_number = $shop_bank_record["account_number"];
        $bank_name = $shop_bank_record["bank_name"];
    }
    $my_shop["account_title"] = $account_title;
    $my_shop["account_number"] = $account_number;
    $my_shop["bank_name"] = $bank_name;
    array_push($all_shops, $my_shop);
}
echo json_encode($all_shops);