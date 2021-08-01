<!-- V0LT - Bubble -->
<?php

include "../store/products.php"; // Include the product database
include "../store/config.php"; // Include the configuration script
include "../store/authentication.php"; // Include the authentication system

$ordersArray = unserialize(file_get_contents('./ordersdatabase.txt')); // Load the orders database

$selected = 0; // Placeholder variable used to keep track of what color we are currently on while cycling through them on the product tiles.
?>
<!DOCTYPE html>
<html lang="en" style="background:<?php echo $background_gradient_bottom; ?>;">
    <head>
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Bubble - Order</title>

	    <link rel="stylesheet" href="/bubble/assets/css/Projects-Clean.css">
	    <link rel="stylesheet" href="/bubble/assets/bootstrap/css/bootstrap.min.css">
	</head>

	<body style="color:#111111;">
		<div class="projects-clean" style="background:linear-gradient(0deg, <?php echo $background_gradient_bottom; ?>, <?php echo $background_gradient_top; ?>);color:#111111;">
		    <div class="container" style="padding-top:100px;">
	 	        <main>
                    <a class="btn btn-light" role="button" href="index.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Back</a>
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
                            Point-Of-Sale Console - Order
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

                            $order_number = $_POST["order_number"];
                            $ordersArray[$store_id][$order_number]
                            

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
