<!DOCTYPE html>
<html style="background:#000000;" lang="en">
    <head>
        <title>Bubble - Purchase Product</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/bubble/files/fonts/lato/latofonts.css">
	    <link rel="stylesheet" href="/bubble/assets/css/Projects-Clean.css">
        <?php include "./analytics.php"; ?>

        <style>
        p { font-family:LatoWeb; }
        ol { font-family:LatoWeb; }
        h1 { font-family:LatoWebBold; }
        h3 { font-family:LatoWeb; }
        a { color:white;text-decoration:underline;font-family:LatoWeb; }
        </style>
    </head>
    <body style="color:#ffffff;text-align:center;padding:5%;background:inherit;">
        <div style="text-align:left;">
            <a class="btn btn-light" role="button" href="/bubble/store/index.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Back</a>
        </div>
        <?php


        include '../cashp/cashp.php'; // BitcoinCash library
        include './authentication.php'; // Bubble authentication system
        include './config.php'; // Bubble configuration file
        include './products.php'; // Bubble product's list

        if ($panic_switch == true) { // Check if the panic switch is active
            echo "<p style='margin:15%;'>The owner of this store has temporarily disabled it. This might mean something has gone wrong, or the server is being maintained. Please check back later. If you have any questions, contact customer support at <a style='color:white;text-decoration:underline;' href='";
            echo $support_email;
            echo "'>";
            echo $support_email;
            echo "</a></p>";
                                        
            exit(); // Stop loading the rest of the page.
        }

        include './failsafe.php';

        if ($username == "" || $username == null) { // Redirect the user to the login page if they are not signed in.
            header("Location: " . $login_page);
        }

        use Ekliptor\CashP\BlockchainApi\AbstractBlockchainApi;
        use Ekliptor\CashP\BlockchainApi\Http\BasicHttpAgent;
        use Ekliptor\CashP\CashP;
        use Ekliptor\CashP\CashpOptions;

        $productToPurchase = $_GET["product"]; // Determine the product the user would like to purchase based on it's product ID in the URL.

        // Check to make sure there is actually a product with the selected product ID.
        if (array_key_exists($productToPurchase, $productsArray[$store_id]) == false) {
            echo "<p>Error: The product selected doesn't exist!</p>";
            echo "<a href='mailto:" . $support_email . "'>Contact Support</a>";
            exit();
        }

        $amount = $productsArray[$store_id][$productToPurchase]["price"]; // Determine the price of the selected product.


        // Load the store database
        $storeArray = unserialize(file_get_contents('./storedatabase.txt'));

        if ($storeArray[$username][$store_id][$productToPurchase]["txid"]) { // Check to see if this user already has a transaction ID associated with this product.
            $paymentID = (int)$storeArray[$username][$store_id][$productToPurchase]["txid"]; // Load this user's transaction ID for the selected product from the store database.
            $alreadyPurchased = (bool)$storeArray[$username][$store_id][$productToPurchase]["purchased"]; // Load the purchase status from the store database to determine if the user has already purchased this product or not.
        } else {
            $paymentID = rand(1000000, 9999999); // Generate a random transaction ID
            $storeArray[$username][$store_id][$productToPurchase]["txid"] = $paymentID; // Store the generated transaction ID in the store database
            file_put_contents('./storedatabase.txt', serialize($storeArray)); // Write array changes to disk
        }


        // Set up BitcoinCash library
        $cashpOptions = new CashpOptions();
        $cashpOptions->httpAgent = new BasicHttpAgent(function (string $subject, $error, $data = null) {
            echo "HTTP error: " . $subject;
        });
        $cashp = new CashP($cashpOptions);
        AbstractBlockchainApi::setLogger(function (string $subject, $error, $data = null) {
            echo "BCH API error: " . $subject;
        });

        // Generate BitcoinCash address based on the user's transaction ID. This will cause the address to be the same for a given user and product combination even when the page is reloaded.
        $address = $cashp->getBlockchain()->createNewAddress($xPub, $paymentID);

        $plain_address = str_replace("bitcoincash:", "", $address->cashAddress);


        // Display the main webpage content
        echo "
        <h1>Disclaimers</h1>
        <p>";

        echo $disclaimers; // Show the disclaimers as defined in the Bubble configuration.

        echo "</p>

        <hr>

        <h1>Instructions</h1>
        <ol style='text-align:left;'>
            <li>Open your BitcoinCash wallet.</li>
            <li>Scan the QR code below.</li>
            <li>Verify that the auto-filled values look right.</li>
            <li>Press send!</li>
            <li>Wait for the transaction to verify. Feel free to close the window while you wait.</li>
            <li>Come back in a few minutes and re-open/refresh the page.</li>
            <li>If you see 'Confirmed' under 'Payment Status', your product has been added to your account!</li>
            <li>If instead your see 'Verifying', don't worry! Sometimes it takes longer for the transaction to confirm. Just check back later!</li>
        </ol>

        <hr>
        ";


        echo "<h1>Automatic Payment</h1>";
        echo "<h3>The following QR code should automatically set the address and amount.</h3>";
        echo '<img src="/bubble/store/qrgenerate.php?address=' . $plain_address .'&amount=' . $amount . '" alt="Payment QR code">' . "\n";

        echo "<hr>";

        echo "<h1>Payment Information</h1>";
        echo "<h3>Alternatively, you can make a payment manually using the information from the summary below.</h3>
        <p>You should also use this information to verify that the values automatically filled out by the QR code above are correct.</p>";
        echo "<div style='text-align:left;padding:5%;'>";
        echo "<p><b>Price:</b> " . $amount . " BCH</p>";
        echo "<p><b>Address:</b> " . $address->cashAddress . "</p>";
        echo "<p><b>Purchase ID:</b> " . $paymentID . "</p>";
        echo "<p><b>Product Name:</b> " . $productsArray[$store_id][$productToPurchase]["name"] . "</p>";
        echo "<p><b>Current User:</b> " . $username . "</p>";
        echo "</div>";


        // Check the address balance (inlcuding TX)
        $addressUpdated = $cashp->getBlockchain()->getAddressDetails($address->cashAddress);

        echo "<hr>";
        echo "<h1>Payment Status</h1>";


        // Check the number of confirmations of the 1st transaction to this address.
        if (count($addressUpdated->transactions) !== 0) { // Check if any transactions exist.
            if ((int)$cashp->getBlockchain()->getConfirmationCount($addressUpdated->transactions[0]) >= $required_confirmations) { // Check the confirmations on the most recent transaction to this address.
                if ((float)$addressUpdated->balance >= (float)$productsArray[$store_id][$productToPurchase]["price"]) { // Check the balance of the wallet to make sure it is above the required price.
                    echo "<p><b>Confirmed</b><br><br>You should now be able to access your purchased product on the Store page! Now is also a good time to view and save your receipt <a href='receipt.php?product=" . $productToPurchase . "'>here</a>.</p>";
                    $storeArray[$username][$store_id][$productToPurchase]["purchased"] = true; // The user has successfully purchased this product, so indicate this in the database.
                    file_put_contents('./storedatabase.txt', serialize($storeArray)); // Write array changes to disk.
                } else {
                    echo "<p><b>Insufficient Funds</b><br><br>The transaction was detected and confirmed, but the balance is too low. This product costs <b>" . (string)$productsArray[$store_id][$productToPurchase]["price"] . "</b>, but the wallet value balance is only <b>" . $addressUpdated->balance . "</b>. You can either send more funds, or contact customer support here: <a href='mailto:";
                    echo $support_email;
                    echo "'>";
                    echo $support_email;
                    echo "</a>. Please be aware that if you choose to send more funds, you will continue to see this error until the new payment confirms. You will not see the 'Verifying' message.</p>";
                }
            } else if ($cashp->getBlockchain()->getConfirmationCount($addressUpdated->transactions[0]) < $required_confirmations) {
                echo "<p><b>Verifying</b><br><br> Transaction was detected, but is not yet confirmed. For security reasons, ";
                echo $required_confirmations;
                echo " confirmations are necessary to verify the transaction. This could take several minutes. Feel free to close the webpage and check back later.</p>";
            }
        } else {
            echo "<p><b>Not Detected</b><br><br>No transaction detected. If you've just initiated the transaction, it might take a minute for it to be detected. In a few seconds, refresh the webpage.</p>"; // No transactions were detected. Display a message explaining this to the user.
        }
        ?>
    </body>
</html>
