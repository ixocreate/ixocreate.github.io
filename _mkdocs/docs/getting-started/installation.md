#Server Requirements

To create a new IXOCREATE application make sure you have Composer installed on your machine and you are using 
PHP 7.1 or newer.

* PHP >= 7.1
* MySQL >= 5.7
* Webserver (Apache, NGNIX)
* PDO PHP Extension
* INTL PHP Extension
* JSON PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* BCMath PHP Extension

#Installing
Create a new project by running this command in your terminal:

```bash
$ composer create-project ixocreate/ixocreate <project_name>
$ cd <project_name>
```

The directory `data` should be writable by your web server.

# Web server configuration
You should configure your web server's `document_root` to be the `public` directory. 
The index.php in this directory serves as entering point for all HTTP requests.

## Via PHP's internal web server
One way to develop your IXOCREATE application is to use PHP's internal web server. 
```bash
cd public
php -S localhost:8000
```

## Via Apache
The minimum configuration to get your application running under Apache is:
```
Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]

```

## Via Nginx
The minimum configuration to get your application running under Nginx is:
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

# Project setup
```bash
$ php ixocreate setup
```
The setup console command will guide you through the basic settings needed to run the application.

```bash
$ php ixocreate publish:run migration
$ php ixocreate migration:migrate
$ php ixocreate admin:create-user <your_email> admin
```
