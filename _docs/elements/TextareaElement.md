---
layout: default
title: TextareaElement
sidebar: header
category: elements
---
## TextareaElement

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

final class TextareaElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_STRING;
    }

    public function inputType(): string
    {
        return 'textarea';
    }

    public static function serviceName(): string
    {
        return 'textarea';
    }
}


```