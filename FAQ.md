# Frequently Asked Questions

This document contains the answers to frequently asked questions concerning Bubble.


### Is Bubble a payment processor or a store?

It's kind of a mix between the two. It's got all the infrastructure you need to set up a store, but it's modular enough to be adapted to other uses, just like a standalone payment processor.


### What happens when the customer doesn't send enough BCH to complete the transaction?

In the event that a user doesn't send the correct amount for a purchase, they will see a message saying 'Insufficient Funds' after the transaction is confirmed. They will be given the option to send additional funds or contact customer support.


### Is it possible to receive refunds for purchases made through Bubble?

Not really. There is nothing stopping the store owner from sending the BCH a user made a purchase with back to the user, but there is no system to do this automatically or through Bubble.


### Does Bubble need to be hosted at the default Apache location? (/var/www/html/)

Theoretically, no. The only moderately important fact is that the 'bubble' folder be at the root of the web server directory. If it's not, then the style sheets won't be loaded properly (though the website should still be fully functional). However, it should be noted that Bubble has only been tested at /var/www/html/, and bugs are highly likely. If you encounter one, you're encouraged to contact V0LT using the information at <https://v0lttech.com/contact.php> so I can fix the issue!


### Does Bubble have an authentication/account system built in?

It does. Bubble uses DropAuth, a 'drag and drop' authentication system for PHP. However, you are encouraged to replace this system using the `bubble/store/authentication.php` script so that Bubble works more continuously with your existing site account system (if you have one).


### Does Bubble have an analytics system built in?

Since Bubble is designed first and foremost with privacy and freedom in mind, Bubble only has very limited analytics system built in. Tools located in the `bubble/store/tools/` folder allow you to get basic analytic information about your store. However, if you need more in-depth analytics, the `bubble/store/analytics.php` script allows you to embed your own analytics system into each page.


### I have a question or suggestion regarding Bubble. Where do I go?

If you've got a comment or question related to Bubble, you're encouraged to get in touch with V0LT at <https://v0lttech.com/contact.php>!


### Do the prices in Bubble automatically fluctate based on BCH to USD conversion rates?

They do not. I currently don't know any way to implement a feature like this that wouldn't require contacting external, proprietary services. To preserve the freedom, privacy, and transparency of Bubble, I've chosen to keep prices as static BCH values.


### What can you sell on Bubble?

Since Bubble is very open a modular, theoretically, you can see anything you want! However, Bubble is designed around the assumption that it's users will be distributing digital content like photos, videos, audio, software, and documents, since these are easy to distribute automatically. If you're willing to sit down and spend some time modifying the 'download' system at `bubble/store/download.php`, it's not impossible to use Bubble to distribute physical products as well!


### Can Bubble give me the contact information of my customers?

Since Bubble just uses your existing account system, information in it's databases can be cross referenced with your main website's user account information. By making some modifications to `bubble/store/tools/get_customers.php`, it shouldn't be too complicated to cross reference the usernames in Bubble's database with your main account information system in order to get customer contact information.


### I don't have the technical skills and/or equipment to self host Bubble. Is there a hosting provider I can go to to create a Bubble instance?

At V0LT, I offer paid services to setting up a Bubble instance. However, this service currently does not including hosting, so you'll either need to purchase your own server, or rent one from a VPS service. If this interests you, you are encouraged to get in touch with V0LT to work out details and ask any questions you may have!
