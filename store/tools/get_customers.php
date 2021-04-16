<?php
include("../products.php");
include("../config.php");

if ($allow_tools == false) {
    exit();
}

$storeArray = unserialize(file_get_contents('../storedatabase.txt')); // Load the store database

$potential_customers = Array(); // This is a placeholder array that will store users who have opened the purchase page for a product, but didn't complete a purchase.
$paying_customers = Array(); // This is a placeholder array that will store users who have opened the purchase page for a product and completed a purchase.


foreach ($storeArray as $key1 => $element1) { // Iterate through every username in the store database. '$key1' is the username string itself, and '$element1' the array associated with that username.
    $user_is_paying_customer = false; // This is a placeholder variable that is assigned to 'false' before checking each username. It will be changed to 'true' if a successful purchase is found for this user.
    foreach ($element1[$store_id] as $element2) { // Iterate through each product that the user has loaded the 'Purchase' page for.
        if ($element2["purchased"] == true) { // See if the user has purchsed this product.
            $user_is_paying_customer = true; // Indicate that the user is a paying customer.
        }
    }
    if ($user_is_paying_customer == true) { // If a user is a paying customer, add them to the '$paying_customer' array.
        array_push($paying_customers, $key1);
    } else { // If the user is not a paying customer, add them to the '$potential_customers' array.
        array_push($potential_customers, $key1);
    }
}

echo "<h1>Customers</h1>";
echo "<h3>Paying Customers</h3>";
echo "<p>These are customers who have made a successful purchase from your Bubble store.</p>";
echo "<ul>";
foreach ($paying_customers as $element) { // List all paying customers.
    echo "<li>" . $element . "</li>";
}
echo "</ul>";

echo "<h3>Potential Customers</h3>";
echo "<p>These are customers who have opened the 'Purchase' page for a product, but didn't successfully complete a purchase.</p>";
echo "<ul>";
foreach ($potential_customers as $element) { // List all potential customers.
    echo "<li>" . $element . "</li>";
}
echo "</ul>";
?>
