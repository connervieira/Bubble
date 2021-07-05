# Bubble

Version 1.1 

A simple BitcoinCash store written for PHP.

---


## Warning

While I've made every effort I can to ensure Bubble is stable and secure, I'm not perfect. V0LT is not responsible for any damages or losses incurred through any failures caused by Bubble. I designed Bubble to sell small fund raising products around $10. If your products are significantly more expensive than a few dollars, it is highly recommended you audit the code yourself before using Bubble in a production environment. 


## Description

Bubble is a self hosted digital content store designed around BitcoinCash. Bubble handles all of the store management and transactions for you so you can focus on producing your content. Bubble works great for all types of digital content, regardless of whether you create music, videos, books, programs, or all of them! With some modification, Bubble could also work for physical products, though it wasn't designed with this use in mind.

If you've been looking for a way to sell your digital media without violating the privacy of your users, Bubble might just be for you!


## Features

### Open Source

Bubble and all of it's dependencies are completely open source, allowing you to study and audit the code yourself.

### Self Hosted

Bubble doesn't require you use any third party services. Everything you need to automatically accept payments is hosted on your own server!

### Private

Bubble is designed to be as privacy respecting as possible for both users and you as an admin! There are no trackers or privacy invasive functionality built in.

### Modern

Bubble is designed in a clean and modern aesthetic.

### Mobile Friendly

Bubble is designed to be visually appealing on both large desktop screens, and small mobile devices.

### JavaScript Free

Bubble doesn't require JavaScript and is fully functional without it.

### Well Documented

All of the source code for Bubble is well documented and easy to understand.

### Lightweight

Bubble doesn't contain bulky raster images or other elements that could slow down web-page loading. Bubble loads quickly and efficiently without compromising on aesthetics.

### Convenient

Bubble is designed with convenience and easy of use in mind. Settings and configuration values are kept in centralized files where they can be cleanly laid out.

### Highly Configurable

Bubble's configuration system allows plenty of customization without ever modifying the source code of any pages. You can change the background colors of pages, the border radius of product tiles, and plenty more!

### Accessible

Out of the box, Bubble is easily accessible to those with visual impairments, and is fully accessibility compliant.

### Simple

With Bubble, you'll spend less time explaining to users how to make cryptocurrency payments, and more time working on your projects! Bubble describes in easy to understand terms how to purchase products, and your users are worked through the entire process step by step.

### Failsafe

Configuring payment processors and store applications can be stressful, knowing that one missed step can lead to catastrophic failure down the road. While you should still do everything you can to configure everything properly, Bubble is designed to fail safely. In other words, if something is misconfigured, Bubble was alert your user of the problem, prompt them to contact you, and halt the transaction before any damage can be done.


## User Experience

This is how your Bubble store would look to a user!

1. When your users open your Bubble store, they'll be greeted with a visually appealing, modern store-front listing all of your products in an organized, easy to understand layout.
![Screenshot of main store interface](./screenshots/1.png)
2. After seeing a product that interests them, they may press the 'More Info' button, to be brought to a page describing the product in better detail.
3. If they decide to make a purchase, all they have to do is press the 'Purchase' button!
4. They'll be brought to a page where they will be prompted to scan a QR code with their BitcoinCash wallet. Simply scanning the QR code will cause all of the transaction information, including the address and price, to be automatically filled out. They simply press 'Send' in their wallet and the verification process begins!
![Screenshot of payment interface](./screenshots/2.png)
5. At this point, the user can close the page and come back at any time. Once the transaction is approved, the product they purchased will appear in their account!



## Installation and Setup

To download and install to your webserver, use the following instructions. Please note that you should prevent users from accessing your website while configuring and setting up Bubble for security reasons. For sake of testing, you may want to leave your web server up on LAN, and simply block it's port on your router.

### Installation

This installation process assumes you are using a Raspberry Pi or another Debian based GNU/Linux distribution. However, the general steps will be the same across other platforms.

1. Install Apache if you haven't already
    - Example: `sudo apt install apache2`
2. Install PHP if you haven't already
    - Example: `sudo apt install php7.4`
3. If the PHP Apache module doesn't automatically get enabled, enable it.
    - Example: `sudo a2enmod php7.4`
4. Install modules required by Bubble's QR code library.
    - Example: `sudo apt-get install php7.4-gd`
5. Restart Apache.
    - Example: `sudo apache2ctl restart`
6. Copy or download Bubble to the root of your webserver.
    - Example: `mv ~/Downloads/bubble /var/www/html/`
7. If successful, you should be able to access Bubble (with placeholder settings) by going to <http://localhost/bubble/store/> (Substituting `localhost` with a server IP address if you're working on a remote server)

### Configuration

1. Ensure the DropAuth folder at `bubble/dropauth` is writable to PHP. Alternatively, replace the DropAuth authentication in `bubble/store/authentication.php` with your own authentication system.
    - `sudo chmod 777 bubble/dropauth/` will accomplish this, but will also allow other programs to write to the DropAuth folder.
2. Make sure that the store database (`store/storedatabase.txt`), product database (`store/productsdatabase.txt`), and configuration database (`store/configurationdatabase.txt`) are all writable. In other words, you should run `sudo chmod 777 storedatabase.txt; sudo chmod 777 productsdatabase.txt; sudo chmod 777 configurationdatabase.txt` to ensure they can be written to by the PHP scripts. However, keep in mind that these commands will set permissions that allow any program to write to these databases, so ensure that you trust the system you are working with.
    - If you open the Purchase page for a given product, and the `Purchase ID` changes every time you refresh the page, this is most likely the issue. It is critical that the `Purchase ID` remains the same every time the page is loaded for a given user and product. This is what ensures the user can close the webpage and come back later and still have their transaction approved.
3. Make sure that the store database (`store/storedatabase.txt`), products database (`store/productsdatabase.txt`), and authentication database (`dropauth/accountDatabase.txt`) only contain `a:0:{}`, and nothing else. This is what an empty serialized array should look like. If the file is empty, or contains other characters, Bubble may not be able to write to it properly.
4. Sign up for an account on your Bubble instance with the username 'admin'. This is the default admin account username.
5. After signing into your admin account, open the main page of your Bubble instance, and click the "Configuration" button at the top of the page to be brought to 'bubble/store/configure.php'. From here, you'll be able to configure your Bubble instance. The following settings should be changed. Other setting changes are optional.
    - `Store Title`
    - `Store Tagline`
    - `Store Description`
    - `Extended Public Key`
    - `Login Page`
    - `Disclaimers`
    - `Support Email`
6. Configure the products you want to display in your Bubble store. Sign up for an account on your Bubble store's DropAuth page using the same username that you specified as your `$admin_account` earlier. After logging in to this account, you should see a button on the main Bubble store page titled 'Edit Products'. You can click this button to open a page that allows you to create, edit, and delete products.
7. Determine what you want to happen when someone tries to access a product they've successfully purchased. To do this, edit `store/download.php` and edit the code accordingly. You'll find the functions that run when someone tries to download a product they've purchased at the very top of the script. For example, you might insert a short script that redirects the user to a download page, or shows them a product key they can use to access their download.
8. Optionally, add your analytics system to `bubble/store/analytics.php`. This could be as simple as an `echo` statement containing the code required to load a script, or as complicated as creating your own in-house analytics system. It should be clarified that `analytics.php` itself offers no analytical functions. It's simply there to allow you to easily use analytics with Bubble. This script is run inside the `<head>` tag of all Bubble pages that a user would access, so it's the perfect place to add a script import, like in the following example:
    - `echo '<script async defer data-domain="server.com" src="/js/analyticsscript.js"></script>';`

### Testing

A good first step in testing would be to load <http://localhost/bubble/store/failsafe.php>. This should indicate any glaring issues. If you don't see anything, then no issues were found. However, this **does not** mean for certain that everything is working. This script just runs some basic checks to detect common configuration problems.

Bubble should now be fully functional. However, it's highly suggested that you test everything from start to finish to make sure that it all works how you are expecting it to. To do this, you may want to temporarily modify one of your products to make it extremely inexpensive (A few cents or so). Then, run through the system from start to finish to see if you successfully get your product.

Provided that everything works as expected, you can revert the price back to normal, and proceed with the setup!

### Deploying

At this point, you should be safe to deploy your Bubble instance. This step depends on your server configuration, but so long as you have a basic understanding of networking, you should have no problems here. Simply port forward your web server, or otherwise expose it to the internet so anyone can access it.
