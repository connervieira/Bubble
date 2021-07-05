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
	    <title>Bubble - Edit Products</title>

	    <link rel="stylesheet" href="/bubble/assets/css/Projects-Clean.css">
	    <link rel="stylesheet" href="/bubble/assets/bootstrap/css/bootstrap.min.css">
        <?php include "./analytics.php"; ?>

	</head>

	<body style="color:#111111;">
		<div class="projects-clean" style="background:linear-gradient(0deg, <?php echo $background_gradient_bottom; ?>, <?php echo $background_gradient_top; ?>);color:#111111;">
		    <div class="container" style="padding-top:100px;">
	 	        <main>
    			    <div class="row projects" style="padding-left:5%;padding-right:5%;">
                        <?php
                            if ($_GET["producttodelete"] != null and $_GET["producttodelete"] != "") { // If the user has pressed the delete button on a product...
                                if ($_GET["confirmed"] == true) { // Only delete the product if they have pressed the "confirm" button.
                                    unset($productArray[$store_id][$_GET["producttodelete"]]); // Remove the selected product ID from the product database.
                                    file_put_contents('./productsdatabase.txt', serialize($productArray)); // Write array changes to disk.
                                    echo '<div style="width:100%;text-align:center;"><h3 style="color:white;">Product deleted!</h3><br>';
                                    echo '<a class="btn btn-light" role="button" href="editproducts.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Back</a></div>';
                                } else { // If they haven't yet pressed the confirm button, then display it alongside a "cancel" button.
                                    echo '<div style="width:100%;text-align:center;"><h3 style="color:white;">Are you sure you\'d like to delete this product? (' . $_GET["producttodelete"] . ')</h3><br><a class="btn btn-light" role="button" href="editproducts.php?producttodelete=' . $_GET["producttodelete"] . '&confirmed=true" style="margin:8px;padding:9px;background-color:#ffaaaa;border-color:#333333;border-radius:10px;">Confirm</a>';
                                    echo '<a class="btn btn-light" role="button" href="editproducts.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Cancel</a></div>';
                                }
                            } else if ($_POST["productid"] == null or $_POST["productid"] == "") { // Check to see if POST data exists from the user editing or creating a product. If it doesn't exist, then show all of the existing products, as well as an "Add New Product" section.
                                echo "
                                <a class='btn btn-light' role='button' href='index.php' style='margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;'>Back</a>
                                <div style='width:100%;text-align:center;'>
                                    <h3 style='color:white;'>Add New Product</h3>
                                    <form style='color:white;' method='POST'>
                                        Product ID: <input type='text' name='productid' required><br>
                                        Product Name: <input type='text' name='name' required><br>
                                        Price (BCH): <input type='number' name='price' step='0.0001' required><br>
                                        Description: <input type='text' name='description' required><br>
                                        Product Webpage: <input type='text' name='link'><br>
                                        Icon Link: <input type='text' name='icon' required><br>
                                        Icon Alt Text: <input type='text' name='alt'><br>
                                        Action Information: <input type='text' name='action'><br>
                                        Enabled: <input type='checkbox' name='enabled' checked><br>
                                        <input type='submit' value='Create New Product'>
                                    </form>
                                    <br><hr><br>
                                    <h3 style='color:white;'>Edit Existing Products</h3>
                                </div>
                                ";

                                // Display all products based on information from the product database.
                                foreach ($productArray[$store_id] as $key => $element) {
                                    echo '<div style="background-color:';
                                    echo $product_tile_colors[$selected]; $selected++; if ($selected >= count($product_tile_colors)) { $selected = 0; } 
                                    echo ';margin:0;border-radius:';
                                    echo $product_tile_border_radius;
                                    echo 'px;padding:20px;width:100%;text-align:center;margin-bottom:20px;">';
                                
                                    if ($element["alt"] == "") {
                                        echo '<img class="img-fluid" style="max-height:250px;" style="max-height:250px;" src="' . $element["icon"] . '" alt="' . $element["name"] .' icon">'; // Display this product's icon with automatically generated alt text.
                                    } else {
                                        echo '<img class="img-fluid" style="max-height:250px;" style="max-height:250px;" src="' . $element["icon"] . '" alt="' . $element["alt"] .'">'; // Display this product's icon with automatically generated alt text.
                                    }
                                    echo "<form style='color:white;' method='POST'>";
                                    echo "Product ID: <input type='text' name='productid' value='" . $key . "' style='color:gray;' readonly><br>";
                                    echo "Name: <input type='text' name='name' value='" . $element['name'] . "' required><br>";
                                    echo "Price (BCH): <input type='number' name='price' step='0.0001' value='" . $element['price'] . "' required><br>";
                                    echo "Description: <input type='text' name='description' value='" . $element['description'] . "' required><br>";
                                    echo "Product Webpage: <input type='text' name='link' value='" . $element['link'] . "'><br>";
                                    echo "Icon Link: <input type='text' name='icon' value='" . $element['icon'] . "' required><br>";
                                    echo "Icon Alt Text: <input type='text' name='alt' value='" . $element['alt'] . "'><br>";
                                    echo "Action Information: <input type='text' name='action' value='" . $element['action'] . "'><br>";
                                    if ($element['enabled'] == true) {
                                        echo "Enabled: <input type='checkbox' name='enabled' checked><br>";
                                    } else {
                                        echo "Enabled: <input type='checkbox' name='enabled'><br>";
                                    }
                                    echo "<br><br><input class='btn btn-light' role='button' type='submit' value='Update Product'>";
                                    echo '<br><a class="btn btn-light" role="button" href="editproducts.php?producttodelete=' . $key  . '"style="margin:8px;padding:9px;background-color:#ffaaaa;border-color:#333333;border-radius:10px;">Delete Product</a>';
                                    echo "</form>";

                                    echo "</div>";
                                }
                            } else if ($_POST["productid"] != null and $_POST["productid"] != "") { // If post data exists, then take the information submitted by the user and use it to add/modify a product in the database.
                                $productid = $_POST["productid"];
                                $name = $_POST["name"];
                                $price = $_POST["price"];
                                $description = $_POST["description"];
                                $link = $_POST["link"];
                                $icon = $_POST["icon"];
                                $alt = $_POST["alt"];
                                $action = $_POST["action"];
                                $enabled = $_POST["enabled"];

                                $productArray[$store_id][$productid]["name"] = $name;
                                $productArray[$store_id][$productid]["price"] = $price;
                                $productArray[$store_id][$productid]["description"] = $description;
                                $productArray[$store_id][$productid]["link"] = $link;
                                $productArray[$store_id][$productid]["icon"] = $icon;
                                $productArray[$store_id][$productid]["alt"] = $alt;
                                $productArray[$store_id][$productid]["action"] = $action;

                                if ($enabled == "on") {
                                    $productArray[$store_id][$productid]["enabled"] = true;
                                } else {
                                    $productArray[$store_id][$productid]["enabled"] = false;
                                }

                                file_put_contents('./productsdatabase.txt', serialize($productArray)); // Write array changes to disk
                                echo "<div style='text-align:center;width:100%;'>";
                                echo "<p style='color:white;'>Successfully updated '" . $productid . "'!</p>";
                                echo '<br><a class="btn btn-light" role="button" href="editproducts.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Back</a>';
                                echo "</div>";
                            }
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
