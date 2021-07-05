<!-- V0LT - Bubble -->
<?php

include "./products.php"; // Include the product database
include "./config.php"; // Include the configuration script
include "./authentication.php"; // Include the authentication system

$storeArray = unserialize(file_get_contents('./storedatabase.txt')); // Load the store database (Who owns what, and their transaction IDs)

$selected = 0; // Placeholder variable used to keep track of what color we are currently on while cycling through them on the product tiles.
?>
<!DOCTYPE html>
<html lang="en" style="background:<?php echo $background_gradient_bottom; ?>;">
    <head>
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Bubble - Store</title>

	    <link rel="stylesheet" href="/bubble/assets/css/Projects-Clean.css">
	    <link rel="stylesheet" href="/bubble/assets/bootstrap/css/bootstrap.min.css">
        <?php include "./analytics.php"; ?>

	</head>

	<body style="color:#111111;">
		<div class="projects-clean" style="background:linear-gradient(0deg, <?php echo $background_gradient_bottom; ?>, <?php echo $background_gradient_top; ?>);color:#111111;">
		    <div class="container" style="padding-top:100px;">
	 	        <main>
                    <?php
                    // Depending on the current Bubble configuration, display a button to show an 'About' page.
                    if ($display_about_page == true) {
                        echo '<a class="btn btn-light" role="button" href="about.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">About</a>';
                    }

                    // Depending on whether a user is currently signed in, display either a "Sign In" or "Sign Out" button.
                    if ($username == "" || $username == null) {
                        echo '<a class="btn btn-light" role="button" href="../dropauth/signin.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Sign In</a>';
                    } else {
                        echo '<a class="btn btn-light" role="button" href="../dropauth/signout.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Sign Out</a>';
                    }

                    // Only show the admin control panel buttons if the current user is an admin user according to the current Bubble configuration.
                    if ($username == $admin_account) {
                        echo '<a class="btn btn-light" role="button" href="editproducts.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Edit Products</a>';
                        echo '<a class="btn btn-light" role="button" href="configure.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Configuration</a>';
                    }
                    ?>
				    <div class="intro">
				        <h2 class="text-center" style="color:#dddddd">
                            <?php if ($display_bubble_logo == true) { echo '<img src="/bubble/assets/img/bubblelogosmall.svg" alt="Bubble logo" style="height:50px;margin-right:20px;">'; } ?>
                            <?php echo $store_title; ?>
                        </h2>
				        <p class="text-center" style="padding-bottom:54px;color:#dddddd;"><?php echo $store_tagline; ?></p>
				    </div>


                    <?php
                    // Display "BitcoinCash Accepted" badge depending on the current Bubble configuration.
                    if ($display_bitcoincash_accepted_icon == 3) {
                        echo '
                        <div style="text-align:center;">
                            <img src="/bubble/assets/img/bitcoincashlarge.svg" alt="BitcoinCash accepted here" style="width:200px;margin:10px;">
                        </div>
                        ';
                    } else if ($display_bitcoincash_accepted_icon == 2) {
                        echo '
                        <div style="text-align:center;">
                            <img src="/bubble/assets/img/bitcoincashsmall.svg" alt="BitcoinCash logo" style="height:50px;margin:10px;">
                        </div>
                        ';
                    }
                    ?>
    
				    <hr>

				    <div style="text-align:center;font-weight:lighter;font-size:20px;margin-bottom:70px;">
                        <p style="color:#dddddd;"><?php echo $store_description; ?></p>
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
	                        foreach ($productsArray[$store_id] as $key => $element) {
                                if ($element["enabled"] == true) { // Only display this product if it is enabled in the product database.
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
                                    echo '<a class="btn btn-primary" role="button" href="' . $element["link"] . '" style="background-color:#444444;border-color:#eeeeee">More Info</a>'; // Provide a link to more information about this product.
                                    echo '<br><br>';


                                    // Check if the user has purchased this product, then adjust the Download and Purchase buttons accordingly.
                                    if ($storeArray[$username][$store_id][$key]["purchased"] == true) {
	    			                    echo '<a class="btn btn-primary" role="button" href="#" style="background-color:#222222;border-color:#777777;color:#777777;">Purchase</a>'; // The user has already purchased this product, so disable and gray out the 'Purchase' button.
                                        echo '<br><br>';
    		    		                echo '<a class="btn btn-primary" role="button" href="receipt.php?product=' . $key . '" style="background-color:#444444;border-color:#eeeeee">Receipt</a>'; // The user has already purchased this product, so enable the 'Receipt' button.
                                        echo '<br><br>';
    		    		                echo '<a class="btn btn-primary" role="button" href="download.php?product=' . $key . '" style="background-color:#444444;border-color:#eeeeee">Download</a>'; // The user has already purchased this product, so enable the 'Download' button.
                                    } else {
				                        echo '<a class="btn btn-primary" role="button" href="purchase.php?product=' . $key . '" style="background-color:#444444;border-color:#eeeeee">Purchase</a>'; // The user has not yet purchased this product, so enable the 'Purchase' button,
                                        echo '<br><br>';
    		    		                echo '<a class="btn btn-primary" role="button" href="#" style="background-color:#222222;border-color:#777777;color:#777777;">Receipt</a>'; // The user has not purchased this product, so disable and gray out the 'Receipt' button.
                                        echo '<br><br>';
	    			                    echo '<a class="btn btn-primary" role="button" href="#" style="background-color:#222222;border-color:#777777;color:#777777;">Download</a>'; // The user has not yet purchsaed this product, so disable and gray out the 'Download' button
                                        echo '<p class="description" style="font-size:15px;margin-top:0px;color:#999999;">Not purchased</p>';
                                    }
    
	    	    		            echo '<p class="description" style="padding-bottom:30px;color:#ffffff;">' . $element["description"] . '</p>'; // Display this product's description.
	        				        echo "</div>";
    		    		    	}
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
