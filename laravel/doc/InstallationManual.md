{{{ TOC }}}

{{{ DOCSTART }}}

{{{ STARTCONTENT }}}

# Installation Manual

## What you need
* The server side PHP Code
* The node Js Application for updating your database.
* A web server with php and node.js installed

## Preparation

### Install composer globally
Composer is a package manager for PHP.

``
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
``

Look here for further information:
[Composer package manager](https://getcomposer.org/doc/00-intro.md)

### Have a running web server
Check if your server is running. Create a user and a group for the server. Set up a SSH and / or FTP connection.

## Step 1: Put the Application code on your server
Copy the "laravel" folder inside your webfolder. And point your webserver to /laravel/public.

Go to your command line tool and type in:
`` 
$ cd laravel
$ composer update
``

## Step 2: Migrate the database
Please migrate the supplied "database.sql" into your database. You could use phpMyAdmin for this job.
![phpMyAdmin import database](http://broking.club/img/doc/phpMyadminImportSql.png)

## Step 3: Configure your brokingclub
Add a **.env.staging.php** to the laravel folder.

```
<?php

return array(
    'DB_HOST'     => 'localhost',
    'DB_DATABASE' => 'YOURDBNAME',
    'DB_USERNAME' => 'YOURUSER',
    'DB_PASSWORD' => 'YOURPASSWORD',

);
```

## Step 4: Run
Go inside your laravel folder and run this command just to be shure:
```
php artisan dump-autoload
```

Now you should be able to use the broking.club.

## Known Problems:

### Utime failed:
If you get the touch(): Utime failed: Permission denied in… run this command in your shell:
```
sudo chmod 755 /bin/touch
```

### No Error, just empty pages
If you don’t get nice PHP Errors and just a “Whoops, looks like something went wrong.” go to config/app and set the debug value to true.

### Error in exception handler
If your webpage doesnt show up and just displays “Error in exception handler.” or “services.json failed to open stream“,  you should give rights to your storage folder and your laravel application should not be under root (use www-data!):
```
chmod -R 775 app/storage
sudo find app/storage -type d -exec chmod 777 {} \;
sudo find app/storage -type f -exec chmod 777 {} \;
```


{{{ ENDCONTENT }}}

{{{ DOCEND }}}