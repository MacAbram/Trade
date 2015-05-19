Test Project
=======================

Introduction
------------
This is the test project.

Installation
------------            
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `create-project` command:

    curl -s https://getcomposer.org/installer | php --
    php composer.phar create-project -sdev --repository-url="https://packages.zendframework.com" zendframework/skeleton-application path/to/install

Alternately, clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git clone git://github.com/zendframework/ZendSkeletonApplication.git
    cd ZendSkeletonApplication
    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

Another alternative for downloading the project is to grab it via `curl`, and
then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/zendframework/ZendSkeletonApplication/tarball/master | tar xz --strip-components=1

You would then invoke `composer` to install dependencies per the previous
example.

Project Intallation
--------------------
The recommended way to get a working copy of this project is to download the GIT repository from
https://github.com/MacAbram/Trade

Once you have Zend Framework Skeleton Application installed, just extract the files to that folder.

Web Server Setup
----------------

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
    	ServerName trade.localhost
    	DocumentRoot C:/xampp/vhosts/trade/public
    	SetEnv APPLICATION_ENV "development"
    	ErrorLog "C:/xampp/vhosts/_logs/trade_error.log"
    	CustomLog C:/xampp/vhosts/_logs/trade_access.log common
    
    		<Directory "C:/xampp/vhosts/trade/public/">
    		DirectoryIndex index.php
    		Options -Indexes +FollowSymLinks +MultiViews
    		AllowOverride All
    		Order Allow,Deny
    		Allow from all
    		Require all granted
    	</Directory>
    </VirtualHost>

Database setup
--------------

Set up the 'trade' database on your local server and execute the following query
to create the table:
    CREATE TABLE `transactions` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `string` text,
      `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      KEY `id` (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8

Running the project
-------------------

### Data consumption

The recommended way to run the project is using the Postman plugin for Chrome. 
This plugin will allow you to set the application-json content type and send data
via POST in the JSON format.

In Postman you need to set up the following headers:
Content-Type: application/json

To send data to the API, enter the following URL:
http://trade.localhost/consume
and select the POST method

Below the headers, select 'raw' and paste the JSON string to POST.
Click 'Send'.

The data will be stored in the database.

### Data view

To display all transactions, go to 
http://trade.localhost




