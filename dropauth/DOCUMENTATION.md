# Documentation

To implement DropAuth into your web service, simply follow these steps.

1. Download the entirety of the DropAuth source code.
2. Copy the folder containing the source code to a location accessible to your web server.
    - Example: /var/www/html/dropauth/
3. Include `authentication.php` on all pages where you want users to have to sign in.
    - Example: `<?php $force_login_redirect = true; include("./dropauth/authentication.php"); ?>`
4. Determine whether or not you want users on each page to be redirected to the login page by changing `$force_login_redirect` to `true` or `false`.
4. Users who open pages with the `authentication.php` script will be automatically redirected to the Sign In page if `$force_login_redirect` is set to `true`. However, you can manually redirect users to the following pages:
    - Sign In: dropauth/signin.php
    - Sign Up: dropauth/signup.php
    - Sign Out: dropauth/signout.php
