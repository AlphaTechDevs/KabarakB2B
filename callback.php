<?php
// Include your database connection file
include 'connect.php';

echo '<a href="../../">Home<br /></a>';

$content = file_get_contents('php://input'); // Receives the JSON Result from Safaricom
$res = json_decode($content, true); // Convert the JSON to an array

$dataToLog = array(
    date("Y-m-d H:i:s"), // Date and time
    " MerchantRequestID: " . $res['Body']['stkCallback']['MerchantRequestID'],
    " CheckoutRequestID: " . $res['Body']['stkCallback']['CheckoutRequestID'],
    " ResultCode: " . $res['Body']['stkCallback']['ResultCode'],
    " ResultDesc: " . $res['Body']['stkCallback']['ResultDesc'],
    " MpesaReceiptNumber: " . $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'],
);

$data = implode(" - ", $dataToLog);
$data .= PHP_EOL;
file_put_contents('mpesastk_log.txt', $data, FILE_APPEND); // Create a txt file and log the results to our log file

// Saves the result to the database
try {
    $stmt = $conx->query("SELECT * FROM mpesastk ORDER BY mpesastk_id DESC LIMIT 1");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $mpesastk_id = $row['mpesastk_id'];
        $app_id = $row['mpesastk_appid'];
        $ResultCode = $res['Body']['stkCallback']['ResultCode'];
        $ResultDesc = $res['Body']['stkCallback']['ResultDesc'];
        $MpesaReceiptNumber = $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];

        if ($res['Body']['stkCallback']['ResultCode'] == '1032') { // if transaction canceled
            $sql = $conx->prepare("UPDATE mpesastk SET mpesastk_status = '0',ResultCode = ?, ResultDesc = ?, MpesaReceiptNumber = ? WHERE mpesastk_id = ?");
            $rs = $sql->execute([$ResultCode, $ResultDesc, $MpesaReceiptNumber, $mpesastk_id]);
        } else { // if transaction was paid
            $sql = $conx->prepare("UPDATE mpesastk SET mpesastk_status = '1',ResultCode = ?, ResultDesc = ?, MpesaReceiptNumber = ? WHERE mpesastk_id = ?");
            $rs = $sql->execute([$ResultCode, $ResultDesc, $MpesaReceiptNumber, $mpesastk_id]);
        }

        if ($rs) {
            file_put_contents('error_log.txt', "Records Inserted", FILE_APPEND);
        } else {
            file_put_contents('error_log.txt', "Failed to insert Records", FILE_APPEND);
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
