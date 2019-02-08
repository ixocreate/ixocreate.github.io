---
layout: default
title: BlockType
sidebar: header
category: guides
order: 1
---
## BlockType

With BlockTypes you can add new content things on your PageType for example Images, text, links.

Each BlockType consists of four functions.

### Template

```php
    public function template(): string
    {
        // TODO: Implement template() method.
    }
```
The template returned the name of the html site from the block usually a file in the directory /ixocreate/templates/block with the name of the block.

### Label

```php
    public function label(): string
    {
        // TODO: Implement label() method.
    }
```
The label returned the name of the blockType.

### ServiceName

```php
    public static function serviceName(): string
    {
        // TODO: Implement serviceName() method.
    }
```
The serviceName returned the ixocreate intern name.

### ReceiveSchema

```php
    public function receiveSchema(Builder $builder, array $options = []): SchemaInterface
    {
        // TODO: Implement receiveSchema() method.
    }
```
The receiveSchema returned the structure of the elements. 