---
layout: default
title: BlockType
sidebar: header
---
<h2 class="green"> {{"BlockType"}}</h2>


The Ixocreate Framework work with PageTypes and they need BlockTypes. Let's see how they work together.
First we will create a BlockType:
Create a new file at /ixocreate/src/App/Block with name TextImageBlock.php and fill the code:

```php
<?php
declare(strict_types=1);
    
namespace App\Block;
    
use Ixocreate\Cms\Block\BlockInterface;
use Ixocreate\Contract\Schema\SchemaInterface;
use Ixocreate\Schema\Builder;
use Ixocreate\Schema\Elements\HtmlElement;
use Ixocreate\Schema\Elements\ImageElement;
use Ixocreate\Schema\Elements\SelectElement;
use Ixocreate\Schema\Elements\TextElement;
use Ixocreate\Schema\Schema;
    
class TextImageBlock implements BlockInterface
{
        
    public function template(): string
    {
        return 'block::text-image';
    }
        
    public function label(): string
    {
        return "TextImage";
    }
        
    public static function serviceName(): string
    {
        return 'textImage';
    }
        
    public function receiveSchema(Builder $builder, array $options = []): SchemaInterface
    {
        $schema = new Schema();
        $schema = $schema
            ->withAddedElement(
    $builder->create(HtmlElement::class, 'text')
    ->withLabel("Text")
    )
    ->withAddedElement(
    $builder->create(SelectElement::class, 'imagePosition')
    ->withLabel("Image Position")
    ->withOptions(array(
    'left' => 'Left',
    'right' => 'Right',
    ))
    ->withRequired(true)
    )
        
    ->withAddedElement(
    $builder->create(ImageElement::class, 'image')
    ->withLabel("Image")
    )
    ->withAddedElement(
    $builder->create(TextElement::class, 'caption')->withLabel("Caption")
    );
    return $schema;
    }
}
```

Next create a new file at /ixocreate/templates/block with name text-image.phtml and fill the code:

```php
<section>
        <div class="row align-items-center justify-content-between">
            <?php if (!empty($image)): ?>
            <div class=" order-first <?= ($imagePosition == 'left') ? 'order-md-last' : 'order-md-first text-left text-md-right' ?>">
                <?php endif; ?>
                <div class="wysiwyg-content">
                    <?= $text ?>
                </div>
                <?php if (!empty($image)): ?>
            </div>
            <div class=" order-last <?= ($imagePosition == 'left') ? 'order-md-first' : 'order-md-last' ?>">
                <div class="image-container image-rounded">
                    <img src="<?= $image->getUrl('image') ?>" class="img-fluid d-block mx-auto">
                </div>
                <?php if (!empty($caption)): ?>
                    <div class="text-right text-muted text-sm image-caption">
                        <?= $caption ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        </div>
</section>
```