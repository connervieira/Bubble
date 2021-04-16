<?php
// This demo creates a new BCH address from your xPub to be used as a 1-time payment address.
// It then prints the address along with a QR code containing the payiment URI.

include '../cashp.php'; // uncomment this if you are not using Composer

use Ekliptor\CashP\BlockchainApi\AbstractBlockchainApi;
use Ekliptor\CashP\BlockchainApi\Http\BasicHttpAgent;
use Ekliptor\CashP\CashP;
use Ekliptor\CashP\CashpOptions;


// ----- Configuration Start -----

$xPub = "xpub6DTct4SqeT6v9fGM7H5yVEJwdBdxqxAFZMCgAtdCSNSB97psxjoemhWk2XQMdC8gMUFiYaWxZbo5PJctvQfqJRwkBAwBWeBzcUC7vTS4k9U"; // This value is sensitive information and should not be shared. However, in the event that it is leaked, the wallet funds are still safe, but the wallet will need to be regenerated to prevent a malicious user from predicting the next generated values.

$amount = 0.0001;

$paymentID = 1; // Increment this and store it (in database) to generate unique addresses

$qrCodeFile = "./example-qr.png"; // Placeholder to be replaced with the QR code generated later

// ----- End Configuration -----


// setup library
$cashpOptions = new CashpOptions();
$cashpOptions->httpAgent = new BasicHttpAgent(function (string $subject, $error, $data = null) {
	// immplementing logger functions is optional. If omitted, all errors will be printed to stdOut
	echo "HTTP error: " . $subject;
});
$cashp = new CashP($cashpOptions);
AbstractBlockchainApi::setLogger(function (string $subject, $error, $data = null) {
	echo "BCH API error: " . $subject;
});

// Now you can use the API (mutliple calls possible)
$address = $cashp->getBlockchain()->createNewAddress($xPub, $paymentID);

@unlink($qrCodeFile); // Ensure it doesn't exist for this example
$cashp->generateQrCodeForAddress($qrCodeFile, $address->cashAddress, $amount);
echo '<img src="example-qr.png" alt="qr-code">' . "\n";
echo "<p>Amount: " . $amount . "</p>";


// Check the address balance (inlcuding TX)
$addressUpdated = $cashp->getBlockchain()->getAddressDetails($address->cashAddress);

echo $address->cashAddress . "<br>";

// Check the number of confirmations (of the 1st transaction)
if (count($addressUpdated->transactions) !== 0) {
	//echo "Confirmations: " . $cashp->getBlockchain()->getConfirmationCount($addressUpdated->transactions[0]) . "\n";
}

if ($cashp->getBlockchain()->getConfirmationCount($addressUpdated->transactions[0]) >= 5) {
    echo "Confirmed";
}
?>
