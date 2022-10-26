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

### Version 2.0

- Replaced the default authentication system with DropAuth, a drop in authentication system.
    - It remains easy for this system to be replaced with an existing authentication system.
- Replaced the product database system with a file based system that allows for better extensibility.
    - Added the ability to edit existing products with a web based GUI.
    - Added the ability to create new products with a web based GUI.
    - Added the ability to delete existing products with a web based GUI.
- Replaced the Bubble configuration system with a file based system that allows for better extensibility.
    - Created a web based GUI to edit configuration information.
    - Removed the "Panic Button" setting from the GUI.
- Added some additional configuration values to products
    - Subscription: A true/false value that determines whether or not a product will be treated as a subscription, where users have to renew with additional payments to maintain access to the product.
    - Subscription Term: A value that determines how many days a subscription terms. In other words, the subscription term is how many days will pass before the customer will need to renew the product.
    - In Person: This value determines whether or not a product is a product that will be sold in person using the new point-of-sale console built into Bubble. When this value is true, the product will not show up in the online store front in Bubble, and will only be accessible during in-person purchases to cashiers operating the point-of-sale console.
- Added a 'Point Of Sale' mode to Bubble that allows for the sale of items in person.
    - Added an interface that allows an admin to create, edit, and manage orders on a basic level.
- Added a built in download function to the download page.
