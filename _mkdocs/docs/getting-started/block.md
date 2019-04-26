# Introduction
A block selft-contained certain type of content and representation of this content. A block defines which information
an editor has or can provide and displays them respectively.

# Example Block
A basic block (with a title and WYSIWYG Editor formatted content) might look like this:

```php
declare(strict_types=1);

namespace App\Block;

use Ixocreate\Cms\Block\BlockInterface;
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\SchemaInterface;
use Ixocreate\Schema\Elements\HtmlElement;
use Ixocreate\Schema\Elements\TextElement;
use Ixocreate\Schema\Schema;

class TextBlock implements BlockInterface
{
    public function template(): string
    {
        return 'block::text';
    }

    public function label(): string
    {
        return 'Text';
    }

    public static function serviceName(): string
    {
        return 'text';
    }

    public function receiveSchema(BuilderInterface $builder, array $options = []): SchemaInterface
    {
        return (new Schema())->withElements([
            $builder->create(TextElement::class, 'title')
                ->withLabel('Title'),
            $builder->create(HtmlElement::class, 'text')
                ->withLabel('Text')
                ->withRequired(true)
        ]);
    }
}

```
