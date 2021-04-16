<!-- V0LT - About Bubble -->
<?php

include "./products.php"; // Include the product database
include "./config.php"; // Include the configuration script
include "./authentication.php"; // Include the authentication system

$storeArray = unserialize(file_get_contents('./storedatabase.txt')); // Load the store database (Who owns what, and their transaction IDs)

$selected = 0; // Placeholder variable used to keep track of what color we are currently on while cycling through them.
?>
<!DOCTYPE html>
<html lang="en" style="background:<?php echo $background_gradient_bottom; ?>;">
    <head>
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Bubble - About</title>

	    <link rel="stylesheet" href="/bubble/assets/css/Projects-Clean.css">
	    <link rel="stylesheet" href="/bubble/assets/bootstrap/css/bootstrap.min.css">
        <?php include "./analytics.php"; ?>

	</head>

	<body style="color:#111111;">
		<div class="projects-clean" style="background:linear-gradient(0deg, <?php echo $background_gradient_bottom; ?>, <?php echo $background_gradient_top; ?>);color:#111111;">
		    <div class="container" style="padding-top:100px;">
	 	        <main>
                    <a class="btn btn-light" role="button" href="index.php" style="margin:8px;padding:9px;background-color:#888888;border-color:#333333;border-radius:10px;">Back</a>
				    <div class="intro">
				        <h2 class="text-center" style="color:#dddddd">About Bubble</h2>
				        <p class="text-center" style="padding-bottom:54px;color:#dddddd;">Learn more about Bubble, the platform that powers this store!</p>
				    </div>

                    <div style="text-align:center;">
                        <img src="/bubble/assets/img/bubblelogosmall.svg" alt="Bubble logo" style="height:300px;margin:10px;">
                    </div>

				    <div style="text-align:center;font-weight:lighter;font-size:20px;margin-bottom:70px;margin-top:100px;">
                        <p style="color:#dddddd;">If you want to sell digital content online, there's plenty of options out there. However, if you want to sell digital content online without violating your users' privacy in the process, you'll have a much harder time finding a suitable program. That's why I created Bubble.</p>
                        <p style="color:#dddddd;">My name is Conner, and I'm the developer behind <a href="https://v0lttech.com/" style="color:inherit;text-decoration:underline;">V0LT</a> the platform that created Bubble. When I wanted to allow donors to my site to recieve perks, I found that it was extremely difficult to sell products online without relying on Stripe, PayPal, Square, or other proprietary platforms. Using cryptocurrency was a very promising option, but I still couldn't find any platforms or programs that would allow me to sell digital content without violating the privacy of my users. Bubble is designed to be the freedom respecting, open source alternative to these proprietary platforms. When you use Bubble, both as a user and as a store owner, you can feel confident knowing that your personal information isn't being collected or sent across the internet.</p>
                        <p style="color:#dddddd;">While Bubble was developed by V0LT, the site that it is hosted on isn't necessarily a V0LT hosted, or even endorsed website. Since Bubble is completely open source and self hosted, anyone can use it and modify it to fit their needs. Therefore, you should still be cautious when making purchases through Bubble, and make sure you trust who you're buying from.</p>
                        <p style="color:#dddddd;font-size:25px;margin-top:50px;margin-bottom:200px;">If you're interested in using Bubble for your own store, check out <a href="https://v0lttech.com/bubble.php" style="color:white;text-decoration:underline;">it's official page</a> on the V0LT website.</p>
                    </div>
	            </main>
            </div>
        </div>
    </body>
</html>
