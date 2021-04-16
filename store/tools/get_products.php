<?php
include("../products.php");
include("../config.php");

if ($allow_tools == false) {
    exit();
}

echo "<h1>Products Summary</h1>";

foreach ($productsArray[$store_id] as $key => $element1) { // Iterate through every product in the database.
    echo "<hr>";
    echo "<p>Name: " . $element1["name"] . "</p>";
    echo "<ul>";
    echo "<li>Price: " . $element1["price"] . "</li>";
    echo "<li>Description: " . $element1["description"] . "</li>";
    echo "</ul>";
}
?>
