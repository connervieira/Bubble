<?php

function successful_purchase($productid, $action) { // This is the code that runs when the user has purchased a product and tries to download it. You should modify this function with the code that allows the user to access their purchase. This could involve redirect them to a download page, or supplying them with a download key.
    // The ID of the product the user would like to access is stored in '$productid'. The action information you've defined in 'products.php' is supplied with the '$action' variable.
    // Please note that at this point, neither the storedatabase or product database are defined. If you'd like to access information stored in either of them, you should make sure that they are loaded before trying to pull information from them.
    echo "<h1>Product '" . $productid .  "' purchased!</h1>";
}



function not_purchased() { // This is the code that runs when the user tries to download a product that they have not purchased.
    echo "<h1>Product has not yet been purchased!</h1>";
}
?>

<!DOCTYPE html>
<html style="background:#000000;" lang="en">
    <head>
        <title>Bubble - Product Download</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/bubble/files/fonts/lato/latofonts.css">
        <?php include "./analytics.php"; ?>

        <style>
            p { font-family:LatoWeb; }
            h1 { font-family:LatoWebBold; }
            h3 { font-family:LatoWeb; }
            a { color:white;text-decoration:underline;font-family:LatoWeb; }
            body { color:#ffffff;text-align:center;padding:5%;background:inherit; }
        </style>
    </head>
    <body>

        <?php
        include './authentication.php';
        include './config.php';

        if ($panic_switch == true) { // Check if the panic switch is active
            echo "<p style='color:inherit;'>The owner of this store has temporarily disabled it. This might mean something has gone wrong, or the server is being maintained. Please check back later. If you have any questions, contact customer support at <a style='color:white;text-decoration:underline;' href='";
            echo $support_email;
            echo "'>";
            echo $support_email;
            echo "</a></p>";
                                
            exit(); // Stop loading the rest of the page.
        }

        if ($username == "" || $username == null) { // Redirect the user to the login page if they are not signed in.
            header("Location " . $login_page);
        }

        $productToDownload = $_GET["product"]; // Get the product the user is trying to access from the URL.


        $storeArray = unserialize(file_get_contents('./storedatabase.txt')); // Load the store database
        if ((bool)$storeArray[$username][$store_id][$productToDownload]["purchased"] == true) {
            successful_purchase($productToDownload, $storeArray[$username][$store_id][$productToDownload]["action"]);
        } else {
            not_purchased();
        }

        ?>
    </body>
</html>
