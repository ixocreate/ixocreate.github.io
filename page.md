---
layout: default
title: PageType
sidebar: header
---
<h2 class="green"> {{"PageType"}}</h2>

Now create a file at /ixocreate/src/App/PageType with name HomePageType.php and fill the code:

```php
<?php
declare(strict_types=1);

namespace App\PageType;

use Ixocreate\Cms\PageType\PageTypeInterface;
use Ixocreate\Contract\Schema\SchemaInterface;
use Ixocreate\Schema\Builder;
use Ixocreate\Schema\Elements\BlockContainerElement;
use Ixocreate\Schema\Elements\GroupElement;
use Ixocreate\Schema\Elements\ImageElement;
use Ixocreate\Schema\Elements\TabbedGroupElement;
use Ixocreate\Schema\Elements\TextareaElement;
use Ixocreate\Schema\Elements\TextElement;
use Ixocreate\Schema\Schema;

class HomePageType implements PageTypeInterface
{

    public static function serviceName(): string
    {
        return 'home';
    }

    public function label(): string
    {
        return 'Home';
    }

    public function routing(): string
    {
        return '';
    }

    public function handle(): ?string
    {
        return 'home';
    }

    public function isRoot(): ?bool
    {
        return true;
    }

    public function allowedChildren(): ?array
    {
        return [];
    }

    public function middleware(): ?array
    {
        return [];
    }

    public function layout(): string
    {
        return 'page::home';
    }

    public function terminal(): bool
    {
        return false;
    }

    public function receiveSchema(Builder $builder, array $options = []): SchemaInterface
    {
        $schema = new Schema();
        return $schema->withAddedElement(
            $builder->create(TabbedGroupElement::class, 'tabs')
                ->withAddedElement(
                    $builder->create(GroupElement::class, 'hero')
                        ->withLabel("Hero")
                        ->withAddedElement(
                            $builder->create(TextElement::class, 'heroTitle')
                                ->withLabel("Hero Title")
                                ->withRequired(false)
                        )
                        ->withAddedElement(
                            $builder->create(TextareaElement::class, 'heroText')
                                ->withLabel("Hero Text")
                                ->withRequired(false)
                        )
                        ->withAddedElement(
                            $builder->create(ImageElement::class, 'heroImage')
                                ->withLabel("Hero Image")
                                ->withRequired(false)
                        )
                )
                ->withAddedElement(
                    $builder->create(GroupElement::class, 'content')
                        ->withLabel("Content")
                        ->withAddedElement(
                            $builder->create(BlockContainerElement::class, 'content')
                                ->withLabel("Content")
                                ->withBlocks([
                                    'textImage'
                                ])
                        )
                )
        );
    }
}
```

The next step is to create a file at /ixocreate/templates/page/ with the name home.phtml and fill with the code:

```php
<?= $pageContent->content; ?>
```

For the images on your website you need an imagedefinition you can create with the follow command in the terminal

```bash
$ ./ixocreate media:generate-imageDefinition image
```

Next step is to edit the imagedefinition at ixolit/src/App/Media/ImageDefinition/Image.php change the high from null to 150.

Now you can login on #admin and can create a new site with a TextImageBlock.

At the moment we don't have a layout let's do it. <a class="green" href="layout.html">Layout</a>
