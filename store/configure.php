<!-- V0LT - Bubble -->
<?php

include "./authentication.php"; // Include the authentication system

$storeArray = unserialize(file_get_contents('./storedatabase.txt')); // Load the store database (Who owns what, and their transaction IDs)
$productArray = unserialize(file_get_contents('./productsdatabase.txt')); // Load the store database (Who owns what, and their transaction IDs)

$selected = 0; // Placeholder variable used to keep track of what color we are currently on while cycling through them.

if (file_exists("./config.php")) { // Find 'config.php' and import it
    include("./config.php");
} else if (file_exists("../config.php")) {
    include("../config.php");
} else { // If the configuration script can't be found, throw an error and stop loading the page.
    echo "<p style='margin:15%;color:red;'>Error: The configuration file (bubble/store/config.php) couldn't be located! This probably isn't a problem with your configuration, and is a bug with Bubble itself. You may want to contact V0LT over this issue: <a href='mailto:cvieira@v0lttech.com'>mailto:cvieira@v0lttech.com</a></p>";
    exit();
}

if ($username != $admin_account) { // Check to make sure the current user is an admin before loading the page.
    echo "<p>Error: You are not authorized to be here! If you do actually have permission to edit products, please ensure you are signed in with the correct account, as specified by <b>\$admin_account</b> in <b>bubble/store/config.php</b></p>"; // Display an error message to the user.
    exit(); // Quit loading the page.
}
?>
<!DOCTYPE html>
<html lang="en" style="background:<?php echo $background_gradient_bottom; ?>;">
    <head>
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Bubble - Configure</title>

	    <link rel="stylesheet" href="/bubble/assets/css/Projects-Clean.css">
	    <link rel="stylesheet" href="/bubble/assets/bootstrap/css/bootstrap.min.css">
        <?php include "./analytics.php"; ?>

	</head>


	<body style="color:#111111;">
		<div class="projects-clean" style="background:linear-gradient(0deg, <?php echo $background_gradient_bottom; ?>, <?php echo $background_gradient_top; ?>);color:#111111;">
		    <div class="container" style="padding-top:100px;">
	 	        <main>
    			    <div class="row projects" style="padding-left:5%;padding-right:5%;">
                        <a class="btn btn-light" role="button" href="index.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Back</a></div>
                        <?php
                            // Check to see if the form as been submitted by checking to see if "store_id" exists in the post data.
                            if ($_POST["store_id"] != null and $_POST["store_id"] != "") {
                                $configurationArray[$store_id]["store_title"] = htmlspecialchars($_POST["store_title"], ENT_QUOTES); $store_title = htmlspecialchars($_POST["store_title"], ENT_QUOTES);
                                $configurationArray[$store_id]["store_description"] = htmlspecialchars($_POST["store_description"], ENT_QUOTES); $store_description = htmlspecialchars($_POST["store_description"], ENT_QUOTES);
                                $configurationArray[$store_id]["store_tagline"] = htmlspecialchars($_POST["store_tagline"], ENT_QUOTES); $store_tagline = htmlspecialchars($_POST["store_tagline"], ENT_QUOTES);
                                if ($_POST["display_about_page"] == "on") { $configurationArray[$store_id]["display_about_page"] = true; $display_about_page = true; } else { $configurationArray[$store_id]["display_about_page"] = false; $display_about_page = false; }
                                if ($_POST["currency_conversion"] == "on") { $configurationArray[$store_id]["currency_conversion"] = true; $currency_conversion = true; } else { $configurationArray[$store_id]["currency_conversion"] = false; $currency_conversion = false; }
                                if ($_POST["display_bubble_logo"] == "on") { $configurationArray[$store_id]["display_bubble_logo"] = true; $display_bubble_logo = true; } else { $configurationArray[$store_id]["display_bubble_logo"] = false; $display_bubble_logo = false; }
                                $configurationArray[$store_id]["display_bitcoincash_accepted_icon"] = $_POST["display_bitcoincash_accepted_icon"]; $display_bitcoincash_accepted_icon = $_POST["display_bitcoincash_accepted_icon"];
                                $configurationArray[$store_id]["background_gradient_top"] = $_POST["background_gradient_top"]; $background_gradient_top = $_POST["background_gradient_top"];
                                $configurationArray[$store_id]["background_gradient_bottom"] = $_POST["background_gradient_bottom"]; $background_gradient_bottom = $_POST["background_gradient_bottom"];
                                $configurationArray[$store_id]["product_tile_border_radius"] = $_POST["product_tile_border_radius"]; $product_tile_border_radius = $_POST["product_tile_border_radius"];
                                $configurationArray[$store_id]["xPub"] = $_POST["xPub"]; $xPub = $_POST["xPub"];
                                $configurationArray[$store_id]["required_confirmations"] = $_POST["required_confirmations"]; $required_confirmations = $_POST["required_confirmations"];
                                if ($_POST["display_username"] == "on") { $configurationArray[$store_id]["display_username"] = true; $display_username = true; } else { $configurationArray[$store_id]["display_username"] = false; $display_username = false; }
                                $configurationArray[$store_id]["disclaimers"] = htmlspecialchars($_POST["disclaimers"], ENT_QUOTES); $disclaimers = htmlspecialchars($_POST["disclaimers"], ENT_QUOTES);
                                $configurationArray[$store_id]["login_page"] = $_POST["login_page"]; $login_page = $_POST["login_page"];
                                $configurationArray[$store_id]["support_email"] = $_POST["support_email"]; $support_email = $_POST["support_email"];
                                $configurationArray[$store_id]["v0lt_credit"] = $_POST["v0lt_credit"]; $v0lt_credit = $_POST["v0lt_credit"];
                                if ($_POST["allow_tools"] == "on") { $configurationArray[$store_id]["allow_tools"] = true; $allow_tools = true; } else { $configurationArray[$store_id]["allow_tools"] = false; $allow_tools = false; }
                                $configurationArray[$store_id]["admin_account"] = $_POST["admin_account"]; $admin_account = $_POST["admin_account"];

                                file_put_contents('./configurationdatabase.txt', serialize($configurationArray)); // Write array changes to disk
                                echo "<p style='font-size:40px;color:#aaffaa;text-align:center;width:100%;margin-bottom:100px;'>Successfully updated Bubble configuration</p>";
                            }




                            // Display a form that the user can use to edit configuration settings.
                            echo "<form style='width:100%;text-align:center;color:white;' method='POST'>";
                            echo "    <p style='font-size:30px;color:inherit;'>Store Page</p>";
                            echo "    <label for='store_title'>Store ID: </label><input type='text' name='store_id' style='color:gray;' value='" . $store_id . "' readonly><br>"; // This field doesn't effect anything, and is simply present to show the user their current store ID. If they use inspect element to change this, it will effect nothing when the form is submitted.
                            echo "    <label for='store_title'>Store Title: </label><input type='text' name='store_title' value='" . $store_title . "'><br>";
                            echo "    <label for='store_description'>Store Description: </label><input type='text' name='store_description' value='" . $store_description . "'><br>";
                            echo "    <label for='store_tagline'>Store Tagline: </label><input type='text' name='store_tagline' value='" . $store_tagline . "'><br>";
                            if ($display_about_page == true) { echo "<label for='display_about_page'>Display About Page: </label><input type='checkbox' name='display_about_page' checked><br>"; } else { echo "<label for='display_about_page'>Display About Page: </label><input type='checkbox' name='display_about_page'><br>"; }
                            if ($currency_conversion == true) { echo "<label for='currency_conversion'>Currency Conversion Link: </label><input type='checkbox' name='currency_conversion' checked><br>"; } else { echo "<label for='currency_conversion'>Currency Conversion Link: </label><input type='checkbox' name='currency_conversion'><br>"; }

                            echo "    <hr>";
                            echo "    <p style='font-size:30px;color:inherit;'>Theme Settings</p>";
                            if ($display_bubble_logo == true) { echo "<label for='display_bubble_logo'>Display Bubble Logo: </label><input type='checkbox' name='display_bubble_logo' checked><br>"; } else { echo "<label for='display_bubble_logo'>Display Bubble Logo: </label><input type='checkbox' name='display_bubble_logo'><br>"; }
                            echo "    <label for='display_bitcoincash_accepted_icon'>'BitcoinCash Accepted' Icon Level: <input type='number' step='1' min='0' max='3' name='display_bitcoincash_accepted_icon' value='" . $display_bitcoincash_accepted_icon . "'><br>";
                            echo "    <label for='background_gradient_top'>Background Gradient Top: <input type='text' maxlength='7' name='background_gradient_top' value='" . $background_gradient_top . "'><br>";
                            echo "    <label for='background_gradient_bottom'>Background Gradient Bottom: <input type='text' maxlength='7' name='background_gradient_bottom' value='" . $background_gradient_bottom . "'><br>";
                            echo "    <label for='product_tile_border_radius'>Product Tile Border Radius: <input type='number' min='0' max='1000' name='product_tile_border_radius' value='" . $product_tile_border_radius . "'><br>";

                            echo "    <hr>";
                            echo "    <p style='font-size:30px;color:inherit;'>Purchase Page</p>";
                            echo "    <label for='xPub'>Extended Public Key: </label><input type='text' name='xPub' value='" . $xPub . "'><br>";
                            echo "    <label for='required_confirmations'>Required Confirmations: <input type='number' step='1' min='0' max='100' name='required_confirmations' value='" . $required_confirmations . "'><br>";
                            if ($display_username == true) { echo "<label for='display_username'>Display Username: </label><input type='checkbox' name='display_username' checked><br>"; } else { echo "<label for='display_username'>Display Username: </label><input type='checkbox' name='display_username'><br>"; }
                            echo "    <label for='disclaimers'>Purchase Disclaimers: </label><input type='text' name='disclaimers' value='" . htmlspecialchars($disclaimers) . "' maxlength='2000'><br>";

                            echo "    <hr>";
                            echo "    <p style='font-size:30px;color:inherit;'>All Pages</p>";
                            echo "    <label for='login_page'>Login Page: </label><input type='text' name='login_page' value='" . $login_page . "'><br>";
                            echo "    <label for='support_email'>Support Email: </label><input type='text' name='support_email' value='" . $support_email . "'><br>";
                            echo "    <label for='v0lt_credit'>'V0LT Credit' Level: <input type='number' step='1' min='1' max='3' name='v0lt_credit' value='" . $v0lt_credit . "'><br>";
                            if ($allow_tools == true) { echo "<label for='allow_tools'>Allow Tools: <input type='checkbox' name='allow_tools' checked><br>"; } else { echo "<label for='allow_tools'>Allow Tools: <input type='checkbox' name='allow_tools'><br>"; }
                            echo "    <label for='admin_account'>Admin Account Username: </label><input type='text' name='admin_account' value='" . $admin_account . "'><br>";
                            echo "    <br><br><br><input type='submit' value='Update Configuration'>";

                            echo "</form>";
                        ?>
                    </div>
                    <?php
                    // Display credits to V0LT depending on the current Bubble configuration.
                    if ($v0lt_credit == 2) {
                        echo '<p class="description" style="font-size:15px;color:#cccccc;margin-top:30px;margin-bottom:100px;text-align:center;"><a href="https://v0lttech.com" style="text-decoration:underline;color:inherit;">Bubble - Made By V0LT</p>';
                    } else if ($v0lt_credit == 3) {
                        echo '<div style="position:fixed;right:0;bottom:0;margin-right:10px;margin-bottom:10px;padding-left:5px;padding-right:5px;border-radius:5px;background:rgba(0, 0, 0, 0.75);"><p style="margin-bottom:7px;margin-top:7px;"><a href="https://v0lttech.com/" style="text-decoration:underline;color:white;">Bubble - Made by V0LT</a></p></div>';
                    }
                    ?>
                </main>
            </div>
        </div>
    </body>
</html>
