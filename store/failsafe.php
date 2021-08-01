<?php

include './config.php';
include './authentication.php';

if (strlen($xPub) <= 10) {
    echo "<p style='margin:15%;color:red;'>Error: The owner of this store hasn't properly configured their Master Public Key. Without it, Bubble can't generate the wallet addresses required to accept payment! You may want to contact customer support to make the store owner aware of this issue: <a href='mailto:";
    echo $support_email;
    echo "'>";
    echo $support_email;
    echo "</a></p>";
    exit();
}

if (!is_writable("./storedatabase.txt") and !is_writable("../storedatabase.txt") and !is_writable("../store/storedatabase.txt")) {
    echo "<p style='margin:15%;color:red;'>Error: The store database file (storedatabase.txt) is not writable to Apache/PHP! You may want to contact customer support to make the store owner aware of this issue: <a href='mailto:";
    echo $support_email;
    echo "'>";
    echo $support_email;
    echo "</a></p>";
}

if (!is_writable("./productsdatabase.txt") and !is_writable("../productsdatabase.txt") and !is_writable("../store/productsdatabase.txt")) {
    echo "<p style='margin:15%;color:red;'>Error: The product database file (productdatabase.txt) is not writable to Apache/PHP! You may want to contact customer support to make the store owner aware of this issue: <a href='mailto:";
    echo $support_email;
    echo "'>";
    echo $support_email;
    echo "</a></p>";
}

if (!is_writable("./configurationdatabase.txt") and !is_writable("../configurationdatabase.txt") and !is_writable("../store/configurationdatabase.txt")) {
    echo "<p style='margin:15%;color:red;'>Error: The configuration database file (configurationdatabase.txt) is not writable to Apache/PHP! You may want to contact customer support to make the store owner aware of this issue: <a href='mailto:";
    echo $support_email;
    echo "'>";
    echo $support_email;
    echo "</a></p>";
}

$authenticationArray = unserialize(file_get_contents('../dropauth/accountDatabase.txt'));
if (isset($authenticationArray[$admin_account]) == false) {
    echo "<p style='margin:15%;color:yellow;'>Notice: The current admin account set in the configuration is named '" . $admin_account . "'. However, no such account exists in the authentication database. This means that anyone can sign up for an account with this name, and have full control over this Bubble instance. If you are the owner of this Bubble instance, you should sign up for an account with this name so that you can access admin controls and prevent others from being able to take over.</p>";
}


if ($support_email == "support@server.com") {
    echo "<p style='margin:15%;color:yellow;'>Notice: The support email defined in the configuration section is still set to the default email, " . $support_email . ". This means that you won't be able to contact the owner of this store. This email should be changed before this store is published.</p>";
}
?>
