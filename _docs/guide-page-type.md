---
layout: default
title: PageType
sidebar: header
category: guides
order: 2
---
## PageType
### ServiceName
```php
    public static function serviceName(): string
    {
        // TODO: Implement serviceName() method.
    }
```
The serviceName returned the ixocreate intern name.
### Label
```php
    public function label(): string
    {
        // TODO: Implement label() method.
    }
```
The label returned the name of the pageType.
### Routing
```php
    public function routing(): string
    {
        // TODO: Implement routing() method.
    }
```
The routing returned the URL from the pagetype usually /${SLUG}.
### Handle
```php
    public function handle(): ?string
    {
        // TODO: Implement handle() method.
    }
```

### IsRoot
```php
    public function isRoot(): ?bool
    {
        // TODO: Implement isRoot() method.
    }
```
If you don't want to see the PageType in the Sitemap return false else true.
### AllowedChildren
```php
    public function allowedChildren(): ?array
    {
        // TODO: Implement allowedChildren() method.
    }
```
Here you can add the possible children from the page.
### Middleware
```php
    public function middleware(): ?array
    {
        // TODO: Implement middleware() method.
    }
```

### Layout
```php
    public function layout(): string
    {
        // TODO: Implement layout() method.
    }
```

### Terminal
```php
    public function terminal(): bool
    {
        // TODO: Implement terminal() method.
    }
```

### ReceiveSchema
```php
    pulic function receiveSchema(Builder $builder, array $options = []): SchemaInterface
    {
        // TODO: Implement receiveSchema() method.
    }
```