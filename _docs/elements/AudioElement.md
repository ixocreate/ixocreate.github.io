---
layout: default
title: AudioElement
sidebar: header
category: elements
---
## AudioElement

```php

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Media\Type\AudioType;

final class AudioElement extends AbstractSingleElement
{
    public function type(): string
    {
        return AudioType::class;
    }

    public function inputType(): string
    {
        return 'audio';
    }

    public static function serviceName(): string
    {
        return 'audio';
    }
}


```