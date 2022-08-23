<?php
session_start(); // Start a PHP session.
if (isset($_SESSION['loggedin'])) { // Check to see if the user is already signed in.
    $username = $_SESSION["username"];
}
?>
