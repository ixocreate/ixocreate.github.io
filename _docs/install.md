---
layout: default
title: Install & Setting up Icocreate
sidebar: header
category: getting started
order: 2
---
## Install

For install Ixocreate you need PHP 7.1 or higher and have composer installed.



Create your new project by running:
```console
$ composer create-project -s dev ixocreate/ixocreate
```
After install your project you have to change the permission to executable from the Ixocreate console application.
Go to the ixocreate folder
```console
$ cd ixocreate
```
Use the follow command:
```console
$ chmod u+x ixocreate
```
    
Now you can use the ixocreate console application by using:
```console
$ ./ixocreate <command>
```

## Create the configs
Next create the project configs in ixocreate/config/local/ by create the files:

1.project-uri.config.php
```php
<?php
return [
    'mainUrl' => 'http://YOUR.URL',
    'possibleUrls' => [],
];
```
2.media.config.php
```php
<?php
return [
        'uri' => '/media',
    ];    
```

3.asset.config.php
```php
<?php
return [
    'url' => ['assets']
];
```
For the database config you can use the command:

```console
$ ./ixocreate config:generate database
```

After generate your configs you have to fill your database -name, -user, password, -host, -driver and -charset in the database.config.php
file and fill in project-uri.config your correct Url.

## Creating mediafolders & migrations
Next create the folder ixocreate/data/media/


Now you have to create two symlinks from the public folder with the follow command:
```console
$ ln -s ../resources/assets
$ ln -s ../data/media
```

From now you can use the ixocreate console application by run the follow lines:

```console
$ ./ixocreate publish:run
$ ./ixocreate migration:migrate

```

## Create Admin

```console
$ ./ixocreate admin:create-user <e-mail> admin
```

You get a generated password and you can login at URL/admin#
