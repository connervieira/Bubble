# Changelog


### Version 1.0

- Core features
	- Payment processing
	- Configuration system
	- Product database system


### Version 1.1

- Added failsafe system that attempts to detect errors in the system configuration and warn the developer of them. This way, the Bubble store owner is less likely to accidentally misconfigure Bubble before releasing it.
    - Check to see if the xPub key has been defined.
    - Check to see if the store database `bubble/store/storedatabase.txt` is writable to PHP.
    - Check to see if the username is still set to the default 'testuser'.
    - Check to see if the configured support email is still the default 'support@server.com'
- Updated the authentication system to allow signed-out viewers to view the store, and only cause them to be redirected to the login page once they try to make a purchase.
    - Added a variable in `bubble/store/config.php` to set the URL for the login page.
- Added a `tools` system to `bubble/store/tools/`.
    - 'Get Customers' tool added: `get_customers.php`
        - Lists paying and non-paying customers in HTML.
    - 'Get Products' tool added: `get_products.php`
        - Lists a summary of all products in the product database (regardless of whether they are enabled)
- Recreated the QR code generation system from scratch in order to provide a more stable, easily configurable system.
    - QR codes for a given purchase will no longer change every time the page is reloaded.
    - QR codes are no longer saved to disk unnecessarily.
        - This also means that no permission changes need to be made for the QR code system to work.
    - QR code generation errors are now much safe.
        - In the event of an error, the most likely outcome is that no QR code will appear, when previously an inaccurate QR code would be displayed.
- Added a system that generates receipts that include all the information a user is likely to need in order to prove a purchase was completed.
    - Receipts can be viewed from the purchase page after a successful purchase, or from the main store page.
- Added `analytics.php` script to `bubble/store/` as a way for developers to import their analytics system automatically into all of the Bubble pages a user would access. This script is loaded in the `<head>` tag of all user pages, so it can be used to import analytics scripts, or run an in house analytics system. By default, this script is empty.
- Added a short example of what `bubble/store/authentication.php` should look like in the comments of the script.
- Added `FAQ.md` document that contains some frequently asked questions and their answers.
