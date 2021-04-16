<?php

$panic_switch = false; // This setting disables all of Bubble's pages. This is useful if something goes very wrong, and you need to quickly stop people from making purchases. It should be noted that this does not stop users from sending BitcoinCash to your address. It only prevents your Bubble instance and all of it's webpages from loading.

// ----- Store Page -----

// Functional settings
$currency_conversion = true; // This setting determines whether or not clicking the price of a product in BCH will redirect to a DuckDuckGo page that converts the price in BCH to USD automatically.
$store_title = "My Bubble Store"; // This is the title of your store, which will be displayed at the top of the main store page. This should be something concise and clean, but there are no technical limits that prevent it from being longer.
$store_tagline = "Purchase digital content with BitcoinCash!"; // This is the short tagline that appears below your store title on the main store page.
$store_description = "This is the store description! You are currently looking at an example store. This should be changed by the store owner to have their products and services instead!"; // This setting defines the description text that will be shown on the main Store page
$display_about_page = true; // This setting defines whether or not the button to open the About page will be shown on the store page. It is highly suggested that you leave this enabled, since it provides more information about Bubble, and clarifies that your store and V0LT are two distinct entities that don't necessarily endorse each other.

// Theme settings
$display_bubble_logo = true; // This determines whether the Bubble logo will be displayed beside the store title on the main store page.
$display_bitcoincash_accepted_icon = 3; // This setting determines whether or not the "BitcoinCash Accepted Here" icon will be shown on the Store page. This can be set to 3, 2 or 1. A setting of 3 will display the whole 'BitcoinCash Accepted Here' icon. A setting of 2 will cause only the BitcoinCash logo to appear. A setting of 0 will cause nothing to be displayed.
$background_gradient_top = "#333333"; // This is the color of the top of the background gradient on the main store page.
$background_gradient_bottom = "#888888"; // This is the color of the bottom of the background gradient on the main store page.
$product_tile_colors = array("#202020", "#232323", "#262626", "#292929", "#2c2c2c", "#2f2f2f"); // Define colors to be cycled through sequentially as backgrounds to each of the product tiles on the main store page.
$product_tile_border_radius = 15; // This value determines how many pixels will be rounded off each corner of the product tiles on the main store page.



// ----- Purchase Page -----
$xPub = ""; // This is the 'Extended Public Key' of your BitcoinCash wallet. It should be noted that not all wallet programs can use this type of key. If your wallet doesn't have an Extended Public Key, try creating a new wallet using ElectronCash. The only thing this key can do is generate new wallet addresses. For sake of security, this value should be kept private to prevent an attacker from being able to predict wallet addresses and potentially confuse the system. However, if it does get leaked, the funds in the wallet are still safe. This is not the same as the wallet's private key.
$required_confirmations = 2; // This is how many confirmations need to occur before the user recieves their product. 5 is generally considered a secure amount, but if you are selling more expensive products, you may want to increase this value. Contrarily, you can get away with 1 or 2 if you are selling low value products. Using 0 confirmations isn't advised, but should be possible.
$display_username = true; // This determines whether or not the current user's username will be shown in the 'Manual Payment' section of the Purchase page. This makes it easy for the user to make sure that their purchase is going to be linked to the correct account.
$disclaimers = "These are disclaimers that the store owner should have configured to warn you about! If you're seeing this, let them know to set up their disclaimers in the Bubble configuration!"; // This defines what disclaimers will be shown to the user on the 'Purchase' page. This should include your refund policy, how you handle dispute, and any other information the user should know before making a purchase.
$login_page = "/login.php"; // This is the URL for your service's login page. This is the URL that users of your store will be redirected to if they try to access the Purchase page without being signed in.



// ----- All Pages -----
$support_email = "support@server.com"; // This value defines the support email that users can contact if they need help. This email will be provided to users when they experience any number of errors and may want to contact support to work out their issue.
$v0lt_credit = 2; // This value determines how much credit your store gives to V0LT, the developer of Bubble. This can either be 3, 2, or 1, with 3 being the most credit, and 1 being no credit. On setting 3, a small floating box with the words "Bubble - Made By V0LT" will appear on the main store page. On setting 2, the message "Bubble - Made By V0LT" will appear as a static HTML element at the bottom of the main store page. On setting 1, the only credit to V0LT will appear in the 'About' page, where users can learn more about Bubble.
$allow_tools = false; // Bubble comes with some built in admin/developer tools, located in 'bubble/store/tools'. These are nice for admins to use, but post a significant security and privacy risk if they are active while the Bubble instance is publicly accessible. Anyone with the URL can load a tool and use its functionality. Tools should be disabled for normal usage.




// Please note: Under normal circumstances, developer settings should never be changed. Changing these settings will almost always cause Bubble to break.
// ----- Developer Settings -----

$store_id = "store1"; // This is the ID if your store. This is never seen by the user and should be left as the default value of 'store1'. You should only change this if you are prepared to make extensive changes to Bubble and it's payment system.
?>
