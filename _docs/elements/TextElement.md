---
layout: default
title: TextElement
sidebar: header
category: elements
---
## TextElement

```php

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Contract\Type\TypeInterface;

final class TextElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_STRING;
    }

    public function inputType(): string
    {
        return 'text';
    }

    public static function serviceName(): string
    {
        return 'text';
    }
}


```