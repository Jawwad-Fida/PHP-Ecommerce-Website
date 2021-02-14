# PHP Project 2 - Ecommerce Website (using PHP PDO)
## Created by: - Mohammed Jawwadul Islam

### [Linkedin](https://www.linkedin.com/in/jawwadfida/) , [Facebook](https://www.facebook.com/Jawwad.Fida/) 
### Year of Completion: - 2020



## Installation Details
      After downloading project: - 
      1)Install PHPMAILER by running : - composer require phpmailer/phpmailer (in project folder) (Refer to github link below in Credits)
      2)Install PHP dotenv by running: - composer require vlucas/phpdotenv (in project folder) (Refer to github link below in Credits)
      3)Create account in [Mailtrap](https://mailtrap.io/) and get your account credentials from there
      4)Set up the database as well as tables - see Database.txt for details
      5)Register a user and then change user_role to Admin in order to view Admin Privileges
      6)For Payment Gateway --> SSLCOMMERZ was used (Largest payment gateway in Bangladesh) (Refer to github link below in Credits). Payment Gateway has credentials.    
      7)Look for .env.example files to see what credentials to set up, and then create .env files in those directories. 
      8)All major PHP codes are in (includes folder) -> functions.php, functions2.php 
       

## PROJECT DETAILS 
    
    
### Tables used (MySql Database)
      1)Categories
      2)Products
      3)Users
      4)Orders
      5)Receipt
      6)Product Report
      7)Slides
      8)Comments

    
### Home Page
      1)Home page shows list of all products available in the ecommerce website (with Pagination) 
      2)Categories are to the right. Click on a category to see products based on that particular category.
      3)Customer has an option to view the full list of details of a certain item.
      4)Contact, Registration and Login Page.
      5)Checkout page and Cart are only available to Customers once they are logged in. Control Panel is only available to Admin.
      6)Reviews of a particular item.


### Control Panel (Admin)
      1)Transaction Panel - viewing all orders
      2)Viewing Products - including editing and deleting
      3)Add Products
      4)Categories - including adding,editing and deleting
      5)All Users - including adding,editing and deleting
      6)Slides and Thumbnails


### API's and Composer packages: -
      phpmailer package and mailtrap API - smtp fake testing server
      PHP dotenv package - protecting credentials online (creating .env file)
      
      
## Credits

### 1) Boostrap template from [Start Boostrap](https://startbootstrap.com/) used - for home page, shop page and admin panel 

Start Bootstrap was created by and is maintained by [David Miller](https://twitter.com/davidmillerskt)

Start Bootstrap is based on the [Bootstrap](http://getbootstrap.com/) framework created by [Mark Otto](https://twitter.com/mdo) and [Jacob Thorton](https://twitter.com/fat).

### 2) PHPMailer

PHPMailer resources are provided by [SmartMessages](https://info.smartmessages.net/)

 * https://github.com/PHPMailer/PHPMailer
 
### 3) PHP dotenv 

PHP dotenv was created by [Vance Lucas](https://github.com/vlucas) and [Graham Campbell](https://twitter.com/GrahamJCampbell)

 * https://github.com/vlucas/phpdotenv
 
### 4) Real Time Notifications using [Pusher](https://github.com/pusher)

### 5) [SSLCOMMERZ](https://www.sslcommerz.com/) payment gateway. Click here for [Github](https://github.com/sslcommerz) profile

### 6) Images taken from [Unsplash](https://unsplash.com/)

## Screenshots

![1]<img src="https://user-images.githubusercontent.com/64092765/107878898-db4e7500-6eff-11eb-83c4-29bed4b7fe7e.png" width="200px">
![2](https://user-images.githubusercontent.com/64092765/107878942-22d50100-6f00-11eb-9263-62ea1e41f056.png)
![3](https://user-images.githubusercontent.com/64092765/107878961-4c8e2800-6f00-11eb-9de4-121cc3532ddc.png)
    
