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
if (!is_writable("./storedatabase.txt")) {
    echo "<p style='margin:15%;color:red;'>Error: The store database file (storedatabase.txt) is not writable to Apache/PHP! You may want to contact customer support to make the store owner aware of this issue: <a href='mailto:";
    echo $support_email;
    echo "'>";
    echo $support_email;
    echo "</a></p>";
}

if ($username == "testuser") {
    echo "<p style='margin:15%;color:yellow;'>Notice: The current username is set to 'testuser'. This is the username of the the user Bubble comes built in with for sake of testing. If you're seeing this on a production instance of Bubble, it's highly likely that the developer forgot to set up their authentication system in 'bubble/store/authentication.php' You may want to contact customer support to make the store owner aware of this issue: <a href='mailto:";
    echo $support_email;
    echo "'>";
    echo $support_email;
    echo "</a></p>";
}

if ($support_email == "support@server.com") {
    echo "<p style='margin:15%;color:yellow;'>Notice: The support email defined in the configuration section is still set to the default email, " . $support_email . ". This means that you won't be able to contact the owner of this store. This email should be changed before this store is published.</p>";
}
?>
