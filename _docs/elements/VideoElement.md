---
layout: default
title: VideoElement
sidebar: header
category: elements
---
## VideoElement

```php

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

final class VideoElement extends AbstractSingleElement
{
    public function type(): string
    {
        return Video::class;
    }

    public function inputType(): string
    {
        return 'video';
    }

    public static function serviceName(): string
    {
        return 'video';
    }
}


```