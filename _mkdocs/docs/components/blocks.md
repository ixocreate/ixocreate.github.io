# Introduction
A block is an instance of a certain type of content and are usually used as SchemaElement inside a PageType. 
Blocks provide their own schema and template - therefor they are reusable. 

In practice a developer provides a set of blocks like ordinary text, slideshows, galleries, contact forms etc. The editor
can add them to the page as often he wants in any order he wants.

```php
namespace Ixocreate\Cms\Block;

use Ixocreate\Schema\SchemaReceiverInterface;
use Ixocreate\ServiceManager\NamedServiceInterface;

interface BlockInterface extends NamedServiceInterface, SchemaReceiverInterface
{
    public function template(): string;

    public function label(): string;

    /**
     * inherited from NamedServiceInterface
     */
    public static function serviceName(): string;
    
    /**
     * inherited from SchemaReceiverInterface
     */
    public function receiveSchema(BuilderInterface $builder, array $options = []): SchemaInterface;
}
```

## NameExpressionInterface
On pages with several blocks added it might be useful to provide the editor extra help. With the `NameExpressionInterface`
it is possible to name an instance of a block. This is possible with a static string or a placeholder. Placeholders declared
with `%` for example `%title%`.

```php
namespace Ixocreate\Cms\Block;

interface NameExpressionInterface
{
    public function nameExpression(): string;
}
```
