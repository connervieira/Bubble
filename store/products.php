<?php

// This is the product database. It will automatically be loaded by the Store page and Purchase page, so you'll only need to make changes once.


// name - The human-readable name of a product.
// price - The static price of a product in BitcoinCash. This value *does not* fluctuate with the conversion rates of BitcoinCash to USD.
// description - This is a description of the product to be shown on the Store page.
// icon - This is the icon that will be Shown on the store page. This can be a locally hosted image, or an image from a third party. This value will be supplied as the 'src' of the image.
// alt - This is the alt text of the product's icon. If this value is left empty, the alt text will default to 'Product Name icon', with Product Name being replaced with the 'name' value described above.
// link - This is a link to a webpage with more information about this product. This value will be supplied as the 'href' of an <a> tag.
// action - This is a very open ended variable, and is intended to be used by developers working on the 'bubble/store/download.php' page. Really anything you want can be stored in this variable. For example, you may use this variable to store the download URL of the product, or maybe a private key used to generate license keys. This variable isn't really required, but it may come in useful if you'd like to keep your 'bubble/store/download.php' file organized.
// enabled - This value determines whether or not the product will appear on the Store page. If you'd like to temporarily disable a product on the Store page, set this to false. Please note that this does not prevent users from purchasing this product outright. It only stops it from appearing on the store page. If a user knows the product ID an manually enters it in the Purchase page URL, they can still purchase a disabled product.



if (file_exists("./config.php")) { // Find 'config.php' and import it
    include("./config.php");
} else if (file_exists("../config.php")) {
    include("../config.php");
} else {
    echo "<p style='margin:15%;color:red;'>Error: The configuration file (bubble/store/config.php) couldn't be located! This probably isn't a problem with your configuration, and is a bug with Bubble itself. You may want to contact V0LT over this issue: <a href='mailto:cvieira@v0lttech.com'>mailto:cvieira@v0lttech.com</a></p>";
    exit();
}

$productsArray = unserialize(file_get_contents('./productsdatabase.txt'));

/*
// Product 1
$productsArray[$store_id]["product1ID"]["name"] = "Product 1 Name";
$productsArray[$store_id]["product1ID"]["price"] = 0.0001;
$productsArray[$store_id]["product1ID"]["description"] = "This is a description of Product 1.";
$productsArray[$store_id]["product1ID"]["icon"] = "/bubble/assets/img/icons/icon1.svg";
$productsArray[$store_id]["product1ID"]["alt"] = "Product 1 icon alt text";
$productsArray[$store_id]["product1ID"]["link"] = "/product1.html";
$productsArray[$store_id]["product1ID"]["action"] = "ActionInformation";
$productsArray[$store_id]["product1ID"]["enabled"] = true;

// Product 2
$productsArray[$store_id]["product2ID"]["name"] = "Product 2 Name";
$productsArray[$store_id]["product2ID"]["price"] = 0.01;
$productsArray[$store_id]["product2ID"]["description"] = "This is a description of Product 2.";
$productsArray[$store_id]["product2ID"]["icon"] = "/bubble/assets/img/icons/icon2.svg";
$productsArray[$store_id]["product2ID"]["alt"] = "Product 2 icon alt text";
$productsArray[$store_id]["product2ID"]["link"] = "/product2.html";
$productsArray[$store_id]["product2ID"]["action"] = "ActionInformation";
$productsArray[$store_id]["product2ID"]["enabled"] = true;

// Product 3
$productsArray[$store_id]["product3ID"]["name"] = "Product 3 Name";
$productsArray[$store_id]["product3ID"]["price"] = 0.01;
$productsArray[$store_id]["product3ID"]["description"] = "This is a description of Product 3.";
$productsArray[$store_id]["product3ID"]["icon"] = "/bubble/assets/img/icons/icon3.svg";
$productsArray[$store_id]["product3ID"]["alt"] = "Product 3 icon alt text";
$productsArray[$store_id]["product3ID"]["link"] = "/product3.html";
$productsArray[$store_id]["product3ID"]["action"] = "ActionInformation";
$productsArray[$store_id]["product3ID"]["enabled"] = true;
*/

file_put_contents('./productsdatabase.txt', serialize($productsArray)); // Write array changes to disk
?>
