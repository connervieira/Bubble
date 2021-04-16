<?php
include '../phpqrcode/qrlib.php'; // Import QR code generator library

$address = $_GET["address"];
$amount = $_GET["amount"];

$code_data = "bitcoincash:" . $address . "?amount=" . $amount;


// Generate QR code for this payment
if (class_exists('QRcode')) {
    QRcode::png($code_data);
} else {
    echo 'class is not loaded properly';
}
?>
