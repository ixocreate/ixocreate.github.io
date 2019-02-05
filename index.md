---
layout: default
title: Install
sidebar: header
---
<h2 class="green"> {{"Install & Setting up Ixocreate "}}</h2>

For install Ixocreate you need PHP 7.1 or higher and have composer installed.



Create your new project by running:
```console
$ composer create-project -s dev ixocreate/ixocreate
```
After install your project you have to change the permission to executable from the Ixocreate console application.

Use the follow command:
```console
$ chmod u+x ixocreate
```
    
Now you can use the ixocreate console application by using:
```console
$ ./ixocreate <command>
```
Next create the project configs in ixocreate/config/local/ by create the files:
<ol>
    <li>project-uri.config.php</li>
    <li>media.config.php</li>
    <li>asset.config.php</li>
</ol>
For the database config you can use the command:

```console
$ ./ixocreate config:generate database
```

After generate your configs you have to fill your database -name, -user, password, -host, -driver and -charset in the database.config.php
file and fill in project-uri.config your correct Url.


Next create the folder ixocreate/data/media/


Now you have to create two symlinks from the public folder to
<ol>
    <li>/resources/assets/</li>
    <li>/data/media/</li>
</ol>


From now you can use the ixocreate console application by run the follow lines:

```console
$ ./ixocreate publish:run
$ ./ixocreate migration:migrate
$ ./ixocreate admin:create-user <e-mail> admin
```

You get a generated password and you can login at URL/admin#