<?php

// This is the product database. It will automatically be loaded by pages that need to read what products you've created.


if (file_exists("./config.php")) { // Find 'config.php' and import it
    include("./config.php");
} else if (file_exists("../config.php")) {
    include("../config.php");
} else if (file_exists("../store/config.php")) {
    include("../store/config.php");
} else {
    echo "<p style='margin:15%;color:red;'>Error: The configuration file (bubble/store/config.php) couldn't be located! This probably isn't a problem with your configuration, and is a bug with Bubble itself. you may want to contact V0LT over this issue: <a href='mailto:cvieira@v0lttech.com'>cvieira@v0lttech.com</a></p>";
    exit();
}

if (file_exists("./productsdatabase.txt")) { // Find 'productdatabase.txt' and load it from disk
    $productsArray = unserialize(file_get_contents('./productsdatabase.txt'));
} else if (file_exists("../productsdatabase.txt")) {
    $productsArray = unserialize(file_get_contents('../productsdatabase.txt'));
} else if (file_exists("../store/productsdatabase.txt")) {
    $productsArray = unserialize(file_get_contents('../store/productsdatabase.txt'));
} else {
    echo "<p style='margin:15%;color:red;'>Error: The product database (bubble/store/productdatabase.txt) couldn't be located! This probably isn't a problem with your configuration, and is a bug with Bubble itself. you may want to contact V0LT over this issue: <a href='mailto:cvieira@v0lttech.com'>cvieira@v0lttech.com</a></p>";
    exit();
}
?>
