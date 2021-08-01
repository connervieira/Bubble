<?php
include '../phpqrcode/qrlib.php'; // Import QR code generator library

$code_data = $_GET["code_data"];

// Generate QR code for this payment
if (class_exists('QRcode')) {
    QRcode::png($code_data);
} else {
    echo 'class is not loaded properly';
}
?>
