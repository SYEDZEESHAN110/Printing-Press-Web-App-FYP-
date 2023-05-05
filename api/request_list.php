<?php
try {
    require_once "./helpers/rest_request.php";
    require_once "./../includes/connect.php";

    $ids = $_POST["data"] ?? [];

    if ($ids && !is_array($ids)) {
        $ids = json_decode($ids);
    }

    if ($ids && is_array($ids)) {
        $idsString = "";
        for ($i = 0; $i < sizeof($ids); $i++) {
            $idsString .= $ids[$i];
            if ($i < sizeof($ids) - 1) {
                $idsString .= ", ";
            }
        }

        $sql = "SELECT * FROM print_request WHERE id IN ($idsString);";
        $result = mysqli_query($conn, $sql);

        $mainData = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data = array();
            $costSql = "SELECT * FROM extra_cost;";
            $costResult = mysqli_query($conn, $costSql);
            $costRow = mysqli_fetch_assoc($costResult);

            $shop_id = $row["shop_id"];
            $shopSql = "SELECT * FROM shops where id= '$shop_id'";
            $shopResult = mysqli_query($conn, $shopSql);
            $shopRow = mysqli_fetch_assoc($shopResult);

            $data["id"] = $row["id"];
            $data["size"] = $row["size"];
            $data["quantity"] = $row["quantity"];
            $data["paper_quality"] = $row["paper_quality"];
            $data["color_scheme"] = $row["color_scheme"];
            if (strtolower($row["color_scheme"]) === "rbg") {
                $data["cost"] = $row["quantity"] * $costRow["RBG"];
            } else if (strtolower($row["color_scheme"]) === "cmyk") {
                $data["cost"] = $row["quantity"] * $costRow["CMYK"];
            } else {
                $data["cost"] = $row["quantity"] * $costRow["grayscale"];
            }
            $data["phone_number"] = $row["phone_number"];
            $data["design"] = $row["design"];
            $data["is_done"] = $row["is_done"] ? "Done" : "Pending";
            $data["shop_name"] = $shopRow['name'];
            $data["shop_contact"] = $shopRow['phone_number'];

            array_push($mainData, $data);
        }

        $response = [
            "success" => true,
            "data" => $mainData,
        ];

        echo json_encode($response);
    } else {
        $response = [
            "success" => false,
            "message" => "No request present",
        ];
        echo json_encode($response);
    }
} catch (Exception $e) {
    $response = [
        "success" => false,
        "message" => $e->getMessage(),
    ];
    echo json_encode($response);
}