<?php
// This is the authentication system that Bubble uses. For testing purposes, by default Bubble will always make the username 'testuser'. However, you'll need to replace this with a system that assigns the '$username' variable to a value unique to a particular user, like their username or ID number.

$username = "testuser";



// Below is a short example of what this process may look like if you were to use PHP sessions to log your users in.

/*
session_start();
if (isset($_SESSION['loggedin'])) {
    $username = $_SESSION['username'];
}
*/

?>
