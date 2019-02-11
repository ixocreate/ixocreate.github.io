---
layout: default
title: MediaElement
sidebar: header
category: elements
---
## MediaElement

```php

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Media\Type\MediaType;

final class MediaElement extends AbstractSingleElement
{
    public function type(): string
    {
        return MediaType::class;
    }

    public function inputType(): string
    {
        return 'media';
    }

    public static function serviceName(): string
    {
        return 'media';
    }
}

```