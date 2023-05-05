<?php
require_once "./../../includes/global.php";
include_once '../main.php';
include_once './../../includes/connect.php';
?>
<!-- Page php here -->
<?php

$sql = "SELECT easypaisa_number, jazzcash_number FROM shops where id='$shop_id';";
$result = mysqli_query($conn, $sql);
$shop = mysqli_fetch_assoc($result);
$easypaisa_number = $shop["easypaisa_number"];
$jazzcash_number = $shop["jazzcash_number"];

$bank_sql = "SELECT * FROM bank_details WHERE shop_id='{$shop_id}'";
$bank_result = mysqli_query($conn, $bank_sql);
$bank_data = mysqli_fetch_assoc($bank_result);
if ($bank_data) {
    $account_title = $bank_data["account_title"];
    $account_number = $bank_data["account_number"];
    $bank_name = $bank_data["bank_name"];
} else {
    $account_title = "";
    $account_number = "";
    $bank_name = "";
}

if (isset($_POST['update-payment-details']) && $_POST['update-payment-details']) {
    $previous_url = $_SERVER['HTTP_REFERER'];
    $post_easypaisa_number = $_POST["easypaisa_number"] ? $_POST["easypaisa_number"] : null;
    $post_jazzcash_number = $_POST["jazzcash_number"] ? $_POST["jazzcash_number"] : null;
    $post_account_title = $_POST["bank_account_title"] ? $_POST["bank_account_title"] : null;
    $post_account_number = $_POST["bank_account_number"] ? $_POST["bank_account_number"] : null;
    $post_bank_name = $_POST["bank_account_name"] ? $_POST["bank_account_name"] : null;

    if ($post_account_title && $post_account_number && $post_bank_name) {
        //Insert into or update database
        if ($bank_data) {
            $bank_post_sql = "UPDATE FROM bank_details SET account_title='{$post_account_title}', account_number='{$post_account_number}', bank_name='{$post_bank_name}' WHERE shop_id='{$shop_id}';";
        } else {
            $bank_post_sql = "INSERT INTO bank_details (account_title, shop_id, account_number,bank_name) VALUES('{$post_account_title}', '{$shop_id}', '{$post_account_number}', '{$post_bank_name}');";
        }
    } else {
        //Delete from database
        $bank_post_sql = "DELETE FROM bank_details WHERE shop_id='{$shop_id}';";
    }
    $bank_post_result = mysqli_query($conn, $bank_post_sql);

    $easy_jazz_post_sql = "UPDATE shops SET easypaisa_number='{$post_easypaisa_number}', jazzcash_number='{$post_jazzcash_number}' WHERE id='{$shop_id}'";
    $easy_jazz_post_result = mysqli_query($conn, $easy_jazz_post_sql);

    if (mysqli_errno($conn) == 0) {
        $_SESSION["success"] = "Payment details updated successfully";
        header("location: .");
        exit();
    } else {
        echo "<script>alert('Error updating the payment details. Error: " . mysqli_error($conn) . "'); window.location.href='{$previous_url}' </script>";
        exit();
    }
}


?>

<?php include_once '../top.php' ?>

<main class="content">
    <style>
    .bank-account-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        grid-gap: 1rem;
        margin-top: 20px;
        max-width: 500px;
        align-items: center;
    }
    </style>
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Payment</strong> Methods</h1>
        <form method="post">
            <div class="form-group">
                <label for="easypaise-input"><b>Easypaisa</b></label>
                <div class="d-flex gap-4 mt-2 mb-4">
                    <input type="text" value="<?= $easypaisa_number ?>" name="easypaisa_number" id="easypaisa_number" />
                </div>
            </div>
            <div class="form-group">
                <label for="jazzcash-input"><b>JazzCash</b></label>
                <div class="d-flex gap-4 mt-2 mb-4">
                    <input type="text" value="<?= $jazzcash_number ?>" name="jazzcash_number" id="jazzcash_number" />
                </div>
            </div>
            <div class="form-group">
                <label for="bank-input"><b>Bank Account</b></label>
                <div class="bank-account-grid">
                    <label for="bank_account_title">Bank Account Title</label>
                    <input type="text" value="<?= $account_title ?>" name="bank_account_title"
                        id="bank_account_title" />
                    <label for="bank_account_number">Bank Account Number</label>
                    <input type="text" value="<?= $account_number ?>" name="bank_account_number"
                        id="bank_account_number" />
                    <label for="bank_account_name">Bank Name</label>
                    <input type="text" value="<?= $bank_name ?>" name="bank_account_name" id="bank_account_name" />
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-center" style="max-width: 500px">
                <button name="update-payment-details" value="true" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</main>

<?php include_once '../footer.php' ?>

<!-- Scripts here -->

<?php include_once './../down.php' ?>