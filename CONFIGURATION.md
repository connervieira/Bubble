# Configuration

This document explains all of the configuration settings built into Bubble.


## Standard Settings

Standard settings are settings intended to be changed by the user. In other words, these are settings that can be changed using the Configuration page on Bubble.

- Store Title
    - This is simply the title of the Bubble store. This is the title shown on the main Bubble store page.
- Store Description
    - This is a short description of your Bubble store. This can contain information about what you sell, what your business stands for, and anything else you want your customers to know! This information shows up on the main store page.
- Store Tagline
    - This is a short tagline for your Bubble store. It is shown underneath the store title on the main store page.
- Display About Page
    - This setting determines whether or not a button leading to an "About Bubble" page is shown on the main store page. This about page describes Bubble and what it is to anyone using your store.
- Currency Conversion Link
    - This setting determines whether or not your customers can click the price of a product in BCH to be taken to a DuckDuckGo page showing that price's current USD conversion rate. This makes it easy for customers to convert your prices into USD. However, enabling this means your store is not longer 100% self contained, but this likely won't bother most people.
- Display Bubble Logo
    - This setting determines whether or not the Bubble logo is shown on the main store page. This can make your store more immediately recognizable to customers familiar with Bubble, but may clash with your website's theme.
- 'BitcoinCash Accepted' Icon Level
    - This setting determines the prominance of the 'BitcoinCash Accepted Here' badge on the main store page, and can be set to the number 0, 1, 2, or 3. If you want a larger, more prominent icon, select 3. If you want no icon at all, select 0. If you still want an icon, but don't want something extremely prominent, then select 2.
- Background Gradient Top
    - This setting is a HEX color code that determines the color of the top of the background on the main store page. It should be set to a HEX color code, starting with a '#' sign, followed by six characters.
- Background Gradient Bottom
    - This setting is a HEX color code that determines the color of the bottom of the background on the main store page. It should be set to a HEX color code, starting with a '#' sign, followed by six characters.
- Product Tile Border Radius
    - This setting determines how rounded off the corners of the product tiles on the store page are. Higher numbers will round the corners off more, while lower numbers will make the corners sharper.
- Extended Public Key
    - This setting should be set to your BitcoinCash wallet's 'Public Extended Key'. This is a key that can be used to generate new recieving addresses, but can not be used to spend money in your wallet. You should try to keep this private, but if it gets leaked, a malicious actor will not have access to your funds.
- Required Confirmations
    - This setting determines how many transaction confirmations are required on the blockchain before a user is allowed to access a product they've purchased. Higher numbers are more secure, but will take longer to approve. A setting of '5', is generally considered highly secure. '2' is safe for most transactions. You can also set this to '0' to require no confirmations at all and will approve transactions as soon as they are detected. However, this is highly insecure, and you should use it with caution.
- Display Username
    - This setting determines whether or not the customer will be shown their username on the Purchase page. This makes it easy for the customer to ensure that they are signed in with the correct account. However, you may want to disable this if you have your own custom way of identifying users.
- Purchase Disclaimers
    - This setting can be used to define disclaimers about purchases that your customers should know. This will be shown to customers on the Purchase page, and should include information like your refund policy.
- Login Page
    - This setting determines where users will be redirected if they need to sign in. By default, this is set to the DropAuth login page, but if you implement a custom authentication system, you'll want to change this to match your custom login page.
- Support Email
    - This is the customer support email that will be given to customers if they encounter an issue with your Bubble instance or need assistance for some other reason.
- V0LT Credit Level
    - This setting determines how much credit you'd like to give to V0LT, the developer of Bubble. It can be any number 1 through 3, with higher numbers causing Bubble to display more prominent credit to V0LT, and a setting of '1' causing no credit to be shown at all.
- Allow Tools
    - This setting determines whether or not the admin tools located in `bubble/store/tools/` are active. This setting should be disable while your server is publically accessible. However, when your server isn't accessible over the internet, these tools can be used to get useful information from your Bubble instance.
- Admin Account
    - The admin account is the account that is allowed to change configuration information and products. Any account with the username determined by this setting will have full administrative access over the Bubble instance.

## Concealed Settings

Concealed settings are settings that can be changed by editing `bubble/store/config.php`, but aren't necessarily intended to be modified.

- Panic Switch
    - The panic switch, when set to 'true', will attempt to disable every single customer-accessible page on Bubble. This is useful if something goes catestrophically wrong while making modifications to Bubble, and you need to quickly prevent customers from making purchases. It should be made clear that this does not stop customers who have already loaded pages from making payments. It simply stops new pages from being loaded.
- Store ID
    - This setting determines the ID of your store. This value is never shown to users, and should never be changed during normal usage. Modifying this setting is extremely likely to cause the underlying Bubble system to break itself. Currently, this setting is a placeholder for future features that may be added to Bubble.
