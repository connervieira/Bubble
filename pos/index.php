<!-- V0LT - Bubble -->
<?php

include "../store/products.php"; // Include the product database
include "../store/config.php"; // Include the configuration script
include "../store/authentication.php"; // Include the authentication system

$storeArray = unserialize(file_get_contents('../store/storedatabase.txt')); // Load the store database (Who owns what, and their transaction IDs)

$selected = 0; // Placeholder variable used to keep track of what color we are currently on while cycling through them on the product tiles.
?>
<!DOCTYPE html>
<html lang="en" style="background:<?php echo $background_gradient_bottom; ?>;">
    <head>
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Bubble - Point Of Sale</title>

	    <link rel="stylesheet" href="/bubble/assets/css/Projects-Clean.css">
	    <link rel="stylesheet" href="/bubble/assets/bootstrap/css/bootstrap.min.css">
	</head>

	<body style="color:#111111;">
		<div class="projects-clean" style="background:linear-gradient(0deg, <?php echo $background_gradient_bottom; ?>, <?php echo $background_gradient_top; ?>);color:#111111;">
		    <div class="container" style="padding-top:100px;">
	 	        <main>
                    <a class="btn btn-light" role="button" href="../store/index.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Back</a>
                    <a class="btn btn-light" role="button" href="order.php" style="margin:8px;padding:9px;background-color:#222222;border-color:#333333;border-radius:10px;color:white;">Order</a>
                    <?php
                    // Only allow the current user to continue if they are signed in as an administrator. 
                    if ($username !== $admin_account) {
                        echo "<br><br><p style='color:black;text-align:center;'>Error: You are not authorized to be here! If you do actually have permission to use the point-of-sale console, please ensure you are signed in with the correct account.</p>"; // Display an error message to the user.
                        exit(); // Quit loading the page.
                    }
                    ?>
				    <div class="intro">
				        <h2 class="text-center" style="color:#dddddd">
                            <img src="/bubble/assets/img/bubblelogosmall.svg" alt="Bubble logo" style="height:50px;margin-right:20px;">
                            Point-Of-Sale Console
                        </h2>
				    </div>



    			    <div class="row projects" style="padding-left:5%;padding-right:5%;">
                        <?php
                            if ($panic_switch == true) {
                                echo "<p style='color:inherit;'>The owner of this store has temporarily disabled it. This might mean something has gone wrong, or the server is being maintained. Please check back later. If you have any questions, contact customer support at <a style='color:white;text-decoration:underline;' href='";
                                echo $support_email;
                                echo "'>";
                                echo $support_email;
                                echo "</a></p>";
                                
                                exit(); // Stop loading the rest of the page.
                            }

                            // Display all products based on information from the product database.
                            $number_of_products_displayed = 0; // Define a variable to be used to count how many products are displayed.
	                        foreach ($productsArray[$store_id] as $key => $element) {
                                if ($element["enabled"] == true and $element["inperson"] == true) { // Only display products that are enabled and marked as in-person products.
                                    $number_of_products_displayed++; // Increment the counter of how many products are displayed.
    			    			    echo '<div class="col-sm-6 col-lg-4 item" style="background-color:';
	    			    		    echo $product_tile_colors[$selected]; $selected++; if ($selected >= count($product_tile_colors)) { $selected = 0; } 
		    			    	    echo ';margin:0;border-radius:';
                                    echo $product_tile_border_radius;
                                    echo 'px">';
                                
                                    if ($element["alt"] == "") {
                                        echo '<img class="img-fluid" style="max-height:250px;" style="max-height:250px;" src="' . $element["icon"] . '" alt="' . $element["name"] .' icon">'; // Display this product's icon with automatically generated alt text.
                                    } else {
                                        echo '<img class="img-fluid" style="max-height:250px;" style="max-height:250px;" src="' . $element["icon"] . '" alt="' . $element["alt"] .'">'; // Display this product's icon with automatically generated alt text.
                                    }
                                    echo '<h3 class="name" style="color:#ffffff;">' . $element["name"]. '</h3>'; // Display this product's name
    
                                    if ($currency_conversion == true) {
                                        echo '<h2 style="padding:0px;margin-top:10px;margin-bottom:20px;font-size:1rem;color:#ffff;"><a href="https://duckduckgo.com/?q=' . $element["price"] . '+BCH+to+USD&ia=cryptocurrency" style="text-decoration:underline;color:white;">' . $element["price"] . ' BCH</a></h2>'; // Display this product's price
                                    } else {
                                        echo '<h2 style="padding:0px;margin-top:10px;margin-bottom:20px;font-size:1rem;color:#ffff;">' . $element["price"] . ' BCH</h2>'; // Display this product's price
                                    }
                                    echo '<img src="./qrgenerate.php?code_data=' . $key . '" alt="Product QR code">' . "\n";
                                    if ($element["link"] != null and $element["link"] != "") { // Only show the 'More Info' button if a link exists for this product. Otherwise, show nothing at all.
                                        echo '<a class="btn btn-primary" role="button" href="' . $element["link"] . '" style="background-color:#444444;border-color:#eeeeee">More Info</a>'; // Provide a link to more information about this product.
                                    }
                                    echo '<br><br>';

	    	    		            echo '<p class="description" style="padding-bottom:30px;color:#ffffff;">' . $element["description"] . '</p>'; // Display this product's description.
	        				        echo "</div>";
    		    		    	}
                            }
                            

                            if ($number_of_products_displayed == 0) {
                                echo "<p style='color:white;text-align:center;'>It looks like you currently don't have any products marked as in-person. The point-of-sale console is used to sell products that customers purchase in person at a physical location.</p>";
                            }
                        ?>
                    </div>
                    <?php
                    if ($v0lt_credit == 2) {
                        echo '<p class="description" style="font-size:15px;color:#cccccc;margin-top:30px;margin-bottom:100px;text-align:center;"><a href="https://v0lttech.com" style="text-decoration:underline;color:inherit;">Bubble - Made By V0LT</p>';
                    }
                    if ($v0lt_credit == 3) {
                        echo '<div style="position:fixed;right:0;bottom:0;margin-right:10px;margin-bottom:10px;padding-left:5px;padding-right:5px;border-radius:5px;background:rgba(0, 0, 0, 0.75);"><p style="margin-bottom:7px;margin-top:7px;"><a href="https://v0lttech.com/" style="text-decoration:underline;color:white;">Bubble - Made by V0LT</a></p></div>';
                    }
                    ?>
	            </main>
            </div>
        </div>
    </body>
</html>
