<!-- V0LT - Authenticate -->
<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    $username = $_SESSION['username'];
    echo "<p>Error: You are already signed in!</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>V0LT - Authenticate</title>
    </head>

    <body style="background:#191919;padding:30%;padding-top:10%;">
        <?php
        $accountsArray = unserialize(file_get_contents('/var/www/html/accountsArray.txt')); // Load the Accounts Database

        $username = $_POST["username"]; // Prepare the username variable
        $password = $_POST["password"]; // Prepare the password variable

        foreach (array_reverse($accountsArray) as $accountsArrayEntry) {
            if ($accountsArrayEntry[1] == $username) {
                if (password_verify($password, $accountsArrayEntry[2])) {
                    session_start();
                    $_SESSION['loggedin'] = 1;
                    $_SESSION['username'] = $username;

                    echo "<h1 data-bs-hover-animate='pulse' style='color:white;'>Logged in</h1>";
                    echo "<a style='color:white;text-decoration:underline;' href='/'><h5 data-bs-hover-animate='pulse'>Back to V0LT</h5></a>";
                    exit();
                } else {
                    echo "<h1 data-bs-hover-animate='pulse' style='color:white;'>Incorrect password</h1>";
                    echo "<a style='color:white;text-decoration:underline;' href='login.php'><h5 data-bs-hover-animate='pulse'>Back to login</h5></a>";
                    exit();
                }
            }
        }
        ?>
    </body>
</html>
