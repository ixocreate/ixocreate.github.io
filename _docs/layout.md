---
layout: default
title: Layout
sidebar: header
category: getting started
order: 5
---

<h2 class="green"> {{"Layout "}}</h2>

For the layout create a new file at /ixocreate/templates/layout with name layout.phtml and fill the code:

```php
<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title><?= $pageContent->name ?></title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md">
            <main>
                <?= $this->section('content'); ?>
            </main>
        </div>
    </div>
</div>
</body>
</html>
```

and edit the file /ixolit/templates/page/home.phtml to 
```php
<?php $this->layout('layout::layout') ?>

<?= $pageContent->content; ?>
```

Now you have made your first page with ixocreate.