---
layout: default
title: TabbedGroupElement
sidebar: header
category: elements
---
## TabbedGroupeElement

```php

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\CommonTypes\Entity\SchemaType;
use Ixocreate\Contract\Schema\ElementInterface;
use Ixocreate\Contract\Schema\SchemaInterface;
use Ixocreate\Contract\Schema\StructuralGroupingInterface;

final class TabbedGroupElement extends AbstractGroup implements StructuralGroupingInterface
{
    /**
     * @return string
     */
    public function type(): string
    {
        return SchemaType::class;
    }

    /**
     * @return string
     */
    public function inputType(): string
    {
        return 'tabbedGroup';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'tabbedGroup';
    }

    /**
     * @param ElementInterface $element
     * @throws \Exception
     * @return SchemaInterface
     */
    public function withAddedElement(ElementInterface $element): SchemaInterface
    {
        if (!($element instanceof GroupElement)) {
            throw new \Exception("Element must be a GroupElement");
        }
        return parent::withAddedElement($element);
    }
}

```