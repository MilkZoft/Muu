¿What is MuuCMS?
------------------------
MuuCMS is a free and open source Content Management System (CMS) platform powered by ZanPHP Framework. You can develop any kain of application such as blog, gallery, forums, surveys, pages, links, users, videos, Twitter and Facebook applications integration, etc.

Server Requirements
-------------------------
    PHP 5.1.X or higher
    Databases supported: MySQL, MySQLi, MsSQL, Oracle, PostgreSQL and SQLite 

Credits
-------------------------
MuuCMS was developed by Carlos Santana (CEO of MilkZoft). MuuCMS was developed in 2009, but was until November 2011 that took the decision to release as free software.
Currently developing MuuCMS is maintained by the development team and contributors of MilkZoft community.
Is achieved by implementing best practices to develop applications faster and with higher quality. 

Installation
-------------------------
To start working with MuuCMS, the first necessary step is to download it. Get MuuCMS is easy, simply download it from: https://github.com/MilkZoft/MuuCMS or git clone with the command:

git clone git@github.com:MilkZoft/MuuCMS.git

The next step is to set a constants of 2 configuration files. These files are located at: /www/config

The first file to modify is the /www/config/config.constants.php which should change the following constants, and then import the SQL file in your PHPMyAdmin:

    _domain: serves to specify the domain that our site will have.
    _modRewrite: toggles the stylization of URLs (TRUE or FALSE).
    _webURL: URL allows you to configure the general site will useful to load images, scripts, etc.
    _webCharacters: allows to show the HTML with or without format (TRUE or FALSE).
    _defaultApplication: allows to configure the default web application
    _webState: toggles the access to the website (Active or Inactive)
    _webLanguage: configure the default language of the website 

The second file to configure is /www/config/config.database.php in the following constants:

    _dbController: allows us to specify the database driver to use.
    _dbHost: allows us to configure the host where the database server (usually localhost).
    _dbUser: the user to connect to the database.
    _dbPwd: password to connect to the database.
    _dbName: the name of the database to which we will connect.
    _dbPort: database port.
    _dbPfx: the prefix our tables have. 

Once these steps, we have MuuCMS ready to work, just a matter of starting to create applications. 