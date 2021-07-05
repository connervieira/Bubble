<?php

// Are you looking for the configuration section for Bubble? This file is no longer used for configuration. Instead, you should sign up for an account on your Bubble instance with the username "admin", and navigate to "bubble/store/configuration.php" in your browser. This will bring you to a page that will allow you to edit your Bubble instance's configuration information.

// This script is now responsible for loading configuration information from a file saved to your disk, at bubble/store/configurationdatabase.txt




$panic_switch = false; // This setting disables all of Bubble's pages. This is useful if something goes very wrong, and you need to quickly stop people from making purchases. It should be noted that this does not stop users from sending BitcoinCash to your address. It only prevents your Bubble instance and all of it's webpages from loading.

$store_id = "store1"; // This is the ID if your store. This is never seen by the user and should be left as the default value of 'store1'. You should only change this if you are prepared to make extensive changes to Bubble and it's payment system.




$configurationArray = unserialize(file_get_contents('./configurationdatabase.txt')); // Load the configuration database from disk.

// Functional settings
$currency_conversion = $configurationArray[$store_id]["currency_conversion"]; // This setting determines whether or not clicking the price of a product in BCH will redirect to a DuckDuckGo page that converts the price in BCH to USD automatically.
$store_title = $configurationArray[$store_id]["store_title"]; // This is the title of your store, which will be displayed at the top of the main store page. This should be something concise and clean, but there are no technical limits that prevent it from being longer.
$store_tagline = $configurationArray[$store_id]["store_tagline"]; // This is the short tagline that appears below your store title on the main store page.
$store_description = $configurationArray[$store_id]["store_description"]; // This setting defines the description text that will be shown on the main Store page
$display_about_page = $configurationArray[$store_id]["display_about_page"]; // This setting defines whether or not the button to open the About page will be shown on the store page. It is highly suggested that you leave this enabled, since it provides more information about Bubble, and clarifies that your store and V0LT are two distinct entities that don't necessarily endorse each other.

// Theme settings
$display_bubble_logo = $configurationArray[$store_id]["display_bubble_logo"]; // This determines whether the Bubble logo will be displayed beside the store title on the main store page.
$display_bitcoincash_accepted_icon = $configurationArray[$store_id]["display_bitcoincash_accepted_icon"]; // This setting determines whether or not the "BitcoinCash Accepted Here" icon will be shown on the Store page. This can be set to 3, 2 or 1. A setting of 3 will display the whole 'BitcoinCash Accepted Here' icon. A setting of 2 will cause only the BitcoinCash logo to appear. A setting of 0 will cause nothing to be displayed.
$background_gradient_top = $configurationArray[$store_id]["background_gradient_top"]; // This is the color of the top of the background gradient on the main store page.
$background_gradient_bottom = $configurationArray[$store_id]["background_gradient_bottom"]; // This is the color of the bottom of the background gradient on the main store page.
$product_tile_colors = array("#202020", "#232323", "#262626", "#292929", "#2c2c2c", "#2f2f2f"); // Define colors to be cycled through sequentially as backgrounds to each of the product tiles on the main store page.
$product_tile_border_radius = $configurationArray[$store_id]["product_tile_border_radius"]; // This value determines how many pixels will be rounded off each corner of the product tiles on the main store page.



// ----- Purchase Page -----
$xPub = $configurationArray[$store_id]["xPub"]; // This is the 'Extended Public Key' of your BitcoinCash wallet. It should be noted that not all wallet programs can use this type of key. If your wallet doesn't have an Extended Public Key, try creating a new wallet using ElectronCash. The only thing this key can do is generate new wallet addresses. For sake of security, this value should be kept private to prevent an attacker from being able to predict wallet addresses and potentially confuse the system. However, if it does get leaked, the funds in the wallet are still safe. This is not the same as the wallet's private key.
$required_confirmations = $configurationArray[$store_id]["required_confirmations"]; // This is how many confirmations need to occur before the user recieves their product. 5 is generally considered a secure amount, but if you are selling more expensive products, you may want to increase this value. Contrarily, you can get away with 1 or 2 if you are selling low value products. Using 0 confirmations isn't advised, but should be possible.
$display_username = $configurationArray[$store_id]["display_username"]; // This determines whether or not the current user's username will be shown in the 'Manual Payment' section of the Purchase page. This makes it easy for the user to make sure that their purchase is going to be linked to the correct account.
$disclaimers = $configurationArray[$store_id]["disclaimers"]; // This defines what disclaimers will be shown to the user on the 'Purchase' page. This should include your refund policy, how you handle dispute, and any other information the user should know before making a purchase.
$login_page = $configurationArray[$store_id]["login_page"]; // This is the URL for your service's login page. This is the URL that users of your store will be redirected to if they try to access the Purchase page without being signed in.



// ----- All Pages -----
$support_email = $configurationArray[$store_id]["support_email"]; // This value defines the support email that users can contact if they need help. This email will be provided to users when they experience any number of errors and may want to contact support to work out their issue.
$v0lt_credit = $configurationArray[$store_id]["v0lt_credit"]; // This value determines how much credit your store gives to V0LT, the developer of Bubble. This can either be 3, 2, or 1, with 3 being the most credit, and 1 being no credit. On setting 3, a small floating box with the words "Bubble - Made By V0LT" will appear on the main store page. On setting 2, the message "Bubble - Made By V0LT" will appear as a static HTML element at the bottom of the main store page. On setting 1, the only credit to V0LT will appear in the 'About' page, where users can learn more about Bubble.
$allow_tools = $configurationArray[$store_id]["allow_tools"]; // Bubble comes with some built in admin/developer tools, located in 'bubble/store/tools'. These are nice for admins to use, but post a significant security and privacy risk if they are active while the Bubble instance is publicly accessible. Anyone with the URL can load a tool and use its functionality. Tools should be disabled for normal usage.
$admin_account = $configurationArray[$store_id]["admin_account"]; // This string should be set to the username of the administrator account on this Bubble instance. This is the account that can modify products using the web GUI.




?>
