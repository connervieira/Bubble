<!DOCTYPE html>

<html lang="en">
    <head>
        <title>DropAuth - Sign In</title>
        <link href="./stylesheets/styles.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $username = $_POST["username"]; // Get the username from the POST request (if it exists)
        $password = $_POST["password"]; // Get the password from the POST request (if it exists)

        include("./utils.php"); // Include the script containing various useful utilities that may be needed.

        $account_database = load_database("./accountDatabase.txt"); // Load the account database using the function defined in utils.php

        session_start(); // Start a PHP session.
        if (isset($_SESSION['loggedin'])) { // Check to see if the user is already signed in.
            echo "<p class='error'>You're already signed in to DropAuth as " . $_SESSION["username"] . "!</p>";

        } else if (variable_exists($username)) { // Check to see if the user has entered a username to log in to.
            if (variable_exists($password)) { // Check to see if the user has entered a password.
                if (isset($account_database[$username])) { // Check to see if the username entered by the user actually exists.
                    if (password_verify($password, $account_database[$username]["password"])) { // Verify that the password entered by the user matches the password on file in the account database.
                        session_start(); // Start a new PHP session.
                        $_SESSION['loggedin'] = 1; // Set the type of account signed in in the PHP session.
                        $_SESSION['username'] = $username; // Set the current username in the PHP session.
                        echo "<p class='success'>You've successfully signed into your DropAuth account!</p>
                        <br>
                        <a class='button' href='./account.php'>Continue To Account</a>";
                    } else {
                        echo "<p class='error'>The password you entered was incorrect. Please make sure you've entered the correct password.</p>
                        <a class='button' href='./signin.php'>Back</a>";
                    }
                } else {
                    echo "<p class='error'>The username you've entered doesn't seem to exists in the account database. Please make sure you've typed your username correctly. If you're trying to create a new account, please use the 'Sign Up' page.</p>
                    <a class='button' href='./signin.php'>Back</a>
                    <a class='button' href='./signup.php'>Sign Up</a>";
                }
            } else {
                echo "<p class='error'>Please enter a password before attempting to sign into your account!</p>
                <a class='button' href='./signin.php'>Back</a>";
            }

        } else {
            echo '
            <div style="text-align:left;"><a class="button" href="./signup.php">Sign Up</a></div>
            <h1>Sign In</h1>
            <h3>Sign in to your DropAuth account!</h3>
            <form method="POST">
                <input placeholder="Username" name="username"><br><br>
                <input placeholder="Password" name="password" type="password"><br><br>
                <input type="submit">
            </form>';
        }
        ?>
    </body>
</html>
