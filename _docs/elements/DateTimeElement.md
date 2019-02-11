---
layout: default
title: DateTimeElement
sidebar: header
category: elements
---
## DateTimeElement

```php

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\CommonTypes\Entity\DateTimeType;

final class DateTimeElement extends AbstractSingleElement
{
    public function inputType(): string
    {
        return 'datetime';
    }

    public function type(): string
    {
        return DateTimeType::class;
    }

    public static function serviceName(): string
    {
        return 'datetime';
    }
}

```