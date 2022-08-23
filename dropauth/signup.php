<!DOCTYPE html>

<html lang="en">
    <head>
        <title>DropAuth - Sign Up</title>
        <link href="./stylesheets/styles.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        include("./utils.php"); // Include the script containing various useful utilities that may be needed.

        $account_database = load_database("./accountDatabase.txt"); // Load the account database using the function defined in utils.php

        session_start(); // Start a PHP session.
        if (isset($_SESSION['loggedin'])) { // Check to see if the user is already signed in.
            echo "<p class='error'>You're already signed in to DropAuth as " . $_SESSION["username"] . "!</p>";

        } else if (variable_exists($username)) { // Check to see if the user has entered a username.
            if (variable_exists($password1)) { // Check to see if the user has enter a password.
                if (variable_exists($password2)) { // Check to see if the user has filled out the password confirmation.
                    if ($password1 == $password2) { // Check to see if the password and the password confirmation match.
                        if (!isset($account_database[$username])) { // Make sure the selected username doesn't already exist in the account database.
                            $account_database[$username]["password"] = password_hash($password1, PASSWORD_DEFAULT); // Add the username and password to the database.
                            file_put_contents('./accountDatabase.txt', serialize($account_database)); // Save the database to the disk.

                            echo "<p class='success'>You've successfully created a DropAuth account! Please log in to continue.</p>
                            <br>
                            <a class='button' href='./signin.php'>Sign In</a>";
                        } else {
                            echo "<p class='error'>There is already an account with your desired username. Please choose a different username. If you are trying to sign in to an existing account, please use the 'Sign In' page.</p>
                            <br>
                            <a class='button' href='./signup.php'>Back</a>
                            <a class='button' href='./signin.php'>Sign In</a>";
                        }
                    } else {
                        echo "<p class='error'>The password confirmation and password don't match. This means you've probably made a typo. Please make sure that your password and password confirmation match.</p>
                        <br>
                        <a class='button' href='./signup.php'>Back</a>";
                    }
                } else {
                    echo "<p class='error'>You've entered a username and password, but you didn't fill out the password confirmation box. Please repeat your password in the 'Password Confirmation' field to ensure you've typed it correctly.</p>
                    <br>
                    <a class='button' href='./signup.php'>Back</a>";
                }
            } else {
                echo "<p class='error'>You've entered a username but not a password! Please provide a password you'd like to use to log in to your DropAuth account.</p>
                <br>
                <a class='button' href='./signup.php'>Back</a>";
            }
        } else {
            echo '
            <div style="text-align:left;"><a class="button" href="./signin.php">Sign In</a></div>
            <h1>Sign Up</h1>
            <h3>Sign up for a DropAuth account!</h3>
            <form method="POST">
                <input placeholder="Username" name="username"><br><br>
                <input placeholder="Password" name="password1" type="password"><br><br>
                <input placeholder="Password Confirmation" name="password2" type="password"><br><br>
                <input type="submit">
            </form>';
        }
        ?>
    </body>
</html>
