<?php
// Start a PHP session and check to see if the user is already logged in.
session_start();
if (isset($_SESSION['loggedin'])) { // See if the "loggedin" variable is currently set in this session
    echo "<p>Error: You are already logged in!</p>"; // Alert the user that they are already signed in.
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bubble - Authentication Example (Login Page)</title>
    </head>

    <body style="background:#444444">
        <main>
            <div style="background:linear-gradient(0deg, #444444, #121212);">
                <a class="btn btn-primary" role="button" href="signup.php" style="margin:13px;margin-bottom:0px;background:#222222;border-color:#666666">Sign Up</a>
                <a class="btn btn-primary" role="button" href="/" style="margin:13px;margin-bottom:0px;background:#222222;border-color:#666666">Back</a>
                <h1 style="color:rgb(255,255,255);text-align:center;font-size:4rem;padding-top:35px;font-weight:lighter">V0LT Account Login</h1>

                    <form action="authenticate.php" method="post" style="margin-top:100px;margin-bottom:100px;width:500px;max-width:75%;background:#222222;">
                        <h2 class="sr-only">Login Form</h2>
                        <div class="illustration" style="color:black;"><i class="icon ion-ios-locked-outline"></i></div>
                        <div class="form-group"><input class="form-control" aria-label="Username" type="text" name="username" placeholder="Username"></div>
                        <div class="form-group"><input class="form-control" aria-label="Password" type="password" name="password" placeholder="Password"></div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit" style="background-color:#111111;border-color:#666666;border:solid;border-width:1px;">Log In</button>
                        </div>
                    <a href="mailto:cvieira@v0lttech.com">
                        <h1 style="font-size:0.75rem;text-align:center;color:white;">If you can't sign in, or you forgot your password, contact support by clicking here.</h1>
                    </a>
                </form>
            </div>
        </main>
    </body>
</html>
