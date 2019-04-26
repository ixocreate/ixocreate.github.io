# Introduction
The schema is the bridge between the visual interface and internal types. It defines and structures elements.

# Form Schema

## Audio

```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\AudioElement;

/** @var BuilderInterface $builder */
$builder->create(AudioElement::class, 'name')
    ->withLabel("Title")
    ->withDescription("Description")
    ->withRequired(true)
    ->withDisabled(false)
```

## Block

```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\BlockContainerElement;

/** @var BuilderInterface $builder */
$builder->create(BlockContainerElement::class, 'name')
    ->withBlocks(['block1', 'block2'])
    ->withLimit(1);
```

## Checkbox

```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\CheckboxElement;

/** @var BuilderInterface $builder */
$builder->create(CheckboxElement::class, 'name')
    ->withLabel("Title")
    ->withDescription("Description")
    ->withRequired(true)
    ->withDisabled(false)
```

## Collection

```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\CollectionElement;
use Ixocreate\Schema\Elements\ImageElement;
use Ixocreate\Schema\Elements\TextElement;

/** @var BuilderInterface $builder */
$builder->create(CollectionElement::class, 'name')
    ->addCollectionElement(
        'repeatable1',
        'Repeatable1',
        (new Schema())
            ->withAddedElement(
                $builder->create(ImageElement::class, 'image')
                        ->withLabel('Image')
            )
            ->withAddedElement(
                $builder->create(TextElement::class, 'text')
                    ->withLabel('Text')
            )
    )
    ->addCollectionElement(
            'repeatable2',
            'Repeatable2',
            (new Schema())
                ->withAddedElement(
                    $builder->create(TextElement::class, 'text')
                        ->withLabel('Text')
               )
    );
```

## Color
```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\ColorElement;

/** @var BuilderInterface $builder */
$builder->create(ColorElement::class, 'name')
    ->withLabel("Title")
    ->withDescription("Description")
    ->withRequired(true)
    ->withDisabled(false)
```

## Date
```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\DateElement;

/** @var BuilderInterface $builder */
$builder->create(DateElement::class, 'name')
    ->withLabel("Title")
    ->withDescription("Description")
    ->withRequired(true)
    ->withDisabled(false)
```

## DateTime
```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\DateTimeElement;

/** @var BuilderInterface $builder */
$builder->create(DateTimeElement::class, 'name')
    ->withLabel("Title")
    ->withDescription("Description")
    ->withRequired(true)
    ->withDisabled(false)
```

## Document
```php
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\Elements\DocumentElement;

/** @var BuilderInterface $builder */
$builder->create(DocumentElement::class, 'name')
    ->withLabel("Title")
    ->withDescription("Description")
    ->withRequired(true)
    ->withDisabled(false)
```

## Group

## Html

## Image

## Link

## Map

## Media

## Multicheckbox

## Multiselect

## Number

## Price

## Radio

## Schema

## Section

## Select

## Tabbed Groups

## Textarea

## Text

## Video

## YouTube

# List Schema

## Checkbox

## Date

## DateTime

## Media

## Select

## Text
